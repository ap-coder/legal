<?php

namespace App\Http\Controllers\Admin;

use App\ContentCategory;
use App\ContentTag;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::all()->pluck('name', 'id');

        $tags = ContentTag::all()->pluck('name', 'id');

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            $post->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
        }

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::all()->pluck('name', 'id');

        $tags = ContentTag::all()->pluck('name', 'id');

        $post->load('categories', 'tags');

        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            if (!$post->featured_image || $request->input('featured_image') !== $post->featured_image->file_name) {
                $post->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
            }
        } elseif ($post->featured_image) {
            $post->featured_image->delete();
        }

        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->load('categories', 'tags');

        return view('admin.posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostRequest $request)
    {
        Post::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
