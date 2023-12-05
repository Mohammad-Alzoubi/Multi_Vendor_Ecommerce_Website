<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner      = 'uploads/1343.jpg';
        $vendor->shop_name   = 'Admin Shop';
        $vendor->phone       = '12321312';
        $vendor->email       = 'admin@gmail.com';
        $vendor->address     = 'Jordan';
        $vendor->description = 'shop description';
        $vendor->user_id     = $user->id;
        $vendor->save();
    }
}
