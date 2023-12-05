<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'vendor@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner = 'images/vendor_1.jpg';
        $vendor->shop_name = 'Vendor Shop';
        $vendor->phone = '12321312';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Usa';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->status = 1;

        $vendor->save();
    }
}
