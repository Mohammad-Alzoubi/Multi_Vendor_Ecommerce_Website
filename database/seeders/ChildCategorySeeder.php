<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('child_categories')->insert([
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name'   => 'Canon',
                'slug'   => 'canon',
                'status' => '1',
            ],
            [
                'category_id' => 1,
                'sub_category_id' => 1,
                'name'   => 'Nikon',
                'slug'   => 'nikon',
                'status' => '1',
            ]
        ]);

    }
}
