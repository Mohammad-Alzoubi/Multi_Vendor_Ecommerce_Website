@extends('frontend.layouts.master')
@section('title')
{{ $settings->site_name }} || Reset Password
@stop
@section('content')

    <!-- BREADCRUMB START -->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Reset password</h4>
                        <ul>
                            <li><a href="{{route('login')}}">login</a></li>
                            <li><a href="#">Reset password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BREADCRUMB END -->


    <!-- CHANGE PASSWORD START -->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="wsus__change_password">
                            <h4>Reset password</h4>
                            <!-- Email Address -->
                            <div class="wsus__single_pass">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{old('email', $request->email)}}" >
                            </div>

                            <!-- Password -->
                            <div class="wsus__single_pass">
                                <label for="password">password</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password" >
                            </div>

                            <!-- Confirm Password -->
                            <div class="wsus__single_pass">
                                <label for="password_confirmation">confirm password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation">
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- CHANGE PASSWORD END -->


@stop
