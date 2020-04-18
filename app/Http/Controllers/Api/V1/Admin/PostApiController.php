<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\Admin\PostResource;
use App\Post;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostResource(Post::with(['categories', 'tags'])->get());
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));

        if ($request->input('featured_image', false)) {
            $post->addMedia(storage_path('tmp/uploads/' . $request->input('featured_image')))->toMediaCollection('featured_image');
        }

        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostResource($post->load(['categories', 'tags']));
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

        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
