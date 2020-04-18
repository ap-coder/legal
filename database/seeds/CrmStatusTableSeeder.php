<?php

use App\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [[
            'id'         => '1',
            'name'       => 'Lead',
            'created_at' => '2019-08-20 21:37:26',
            'updated_at' => '2019-08-20 21:37:26',
        ],
            [
                'id'         => '2',
                'name'       => 'Customer',
                'created_at' => '2019-08-20 21:37:26',
                'updated_at' => '2019-08-20 21:37:26',
            ],
            [
                'id'         => '3',
                'name'       => 'Partner',
                'created_at' => '2019-08-20 21:37:26',
                'updated_at' => '2019-08-20 21:37:26',
            ]];

        CrmStatus::insert($crmStatuses);
    }
}
