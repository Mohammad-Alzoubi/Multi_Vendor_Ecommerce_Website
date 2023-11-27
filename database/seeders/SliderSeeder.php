<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            [
                'banner'   => 'frontend/images/slider_1.jpg',
                'type'     => 'new arrivals',
                'title'    => 'men\'s fashion',
                'starting_price'     => '99',
                'btn_url'   => 'http://127.0.0.1:8000/admin/slider',
                'serial'    => '1',
                'status'    => '1',
            ],
            [
                'banner'   => 'frontend/images/slider_2.jpg',
                'type'     => 'new arrivals',
                'title'    => 'kid\'s fashion',
                'starting_price'     => '78',
                'btn_url'   => 'http://127.0.0.1:8000/admin/slider',
                'serial'    => '1',
                'status'    => '1',
            ],
            [
                'banner'   => 'frontend/images/slider_3.jpg',
                'type'     => 'new arrivals',
                'title'    => 'winter collection',
                'starting_price'     => '77',
                'btn_url'   => 'http://127.0.0.1:8000/admin/slider',
                'serial'    => '1',
                'status'    => '1',
            ],
        ]);

    }
}
