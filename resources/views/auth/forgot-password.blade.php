@extends('frontend.layouts.master')
@section('title')
{{ $settings->site_name }} || Forgot Password
@stop
@section('content')
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    @if(session('status'))
                        <p class="alert alert-success text-center">
                            {{session('status')}}
                        </p>
                    @endif
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>Forget password ?</h4>
                        <p>Enter the email address to register with <span>e-shop</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input id="email" type="email" name="email" value="{{old('email')}}" placeholder="Your Email" >
                                </div>
                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{route('login')}}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
