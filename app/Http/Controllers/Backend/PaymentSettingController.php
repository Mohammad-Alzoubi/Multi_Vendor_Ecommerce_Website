<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paypalSetting = PaypalSetting::first();
        $stripSetting = StripeSetting::first();
        return view('admin.payment-settings.index', compact('paypalSetting', 'stripSetting'));
    }
}
