@extends('vendor.layouts.master')
@section('title')
{{ $settings->site_name }} || profile
@stop
@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>basic information</h4>

                                <form action="{{route('vendor.profile.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- image -->
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="wsus__dash_pro_img">
                                                <img src="{{asset(auth()->user()->image)?? asset('frontend/images/ts-2.jpg')}}" alt="img" class="img-fluid w-100">
                                                <input type="file" name="image">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-user-tie"></i>
                                                    <input id="name" name="name" type="text" value="{{auth()->user()->name}}" placeholder="Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fal fa-envelope-open"></i>
                                                    <input id="email" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                    <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                                    </div>
                                </form>

                                <!-- Update password -->
                                <form action="{{route('vendor.profile.password.update')}}" method="post">
                                    @csrf
                                    <div class="wsus__dash_pass_change mt-2">
                                        <div class="row">
                                            <h4>Update Password</h4>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-unlock-alt"></i>
                                                    <input type="password" name="current_password" placeholder="Current Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" name="password" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fas fa-lock-alt"></i>
                                                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <button class="common_btn" type="submit">upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
