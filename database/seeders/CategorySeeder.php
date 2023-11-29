<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
              'name'   => 'Electronics',
              'slug'   => 'electronics',
              'icon'   => 'fal fa-tshirt',
              'status' => '1',
            ],
            [
              'name'   => 'Mobile',
              'slug'   => 'mobile',
              'icon'   => 'far fa-camera',
              'status' => '1',
            ],
            [
              'name'   => 'Bike',
              'slug'   => 'bike',
              'icon'   => 'far fa-camera',
              'status' => '1',
            ],
        ]);
    }
}
