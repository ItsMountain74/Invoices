@extends('Dashboard.layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('title')
    Log in
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='dashboard') }}"><img src="{{asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>Welcome back!</h2>
                                            <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <!-- Email Address -->
                                                <div>
                                                    <label for="email">Email</label>
                                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>

                                                <!-- Password -->
                                                <div class="mt-4">
                                                    <x-input-label for="password" :value="__('Password')" />

                                                    <x-text-input id="password" class="block mt-1 w-full"
                                                                  type="password"
                                                                  name="password"
                                                                  required autocomplete="current-password" />

                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>

                                                <!-- Remember Me -->
                                                <div class="block mt-4">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                                    </label>
                                                </div>

                                                <div class="flex items-center justify-end mt-4">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif

                                                    <x-primary-button class="ml-3">
                                                        {{ __('Log in') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                            <div class="main-signin-footer mt-5">
                                                <p><a href="">Forgot password?</a></p>
                                                <p>Don't have an account? <a href="{{ url('/register') }}">Create an Account</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
@endsection
