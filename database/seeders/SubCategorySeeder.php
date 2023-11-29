<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('sub_categories')->insert([
            [
                'category_id' => 1,
                'name'   => 'Camera',
                'slug'   => 'camera',
                'status' => '1',
            ],
            [
                'category_id' => 1,
                'name'   => 'Gaming Desktop',
                'slug'   => 'gaming Desktop',
                'status' => '1',
            ],
            [
                'category_id' => 1,
                'name'   => 'computer and Laptop',
                'slug'   => 'computer-and-Laptop',
                'status' => '1',
            ],
            [
                'category_id' => 2,
                'name'   => 'Samsung',
                'slug'   => 'samsung',
                'status' => '1',
            ],
            [
                'category_id' => 2,
                'name'   => 'Nokia',
                'slug'   => 'nokia',
                'status' => '1',
            ],
        ]);
    }
}
