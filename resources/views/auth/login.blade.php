@extends('layouts.guest')

@section('title', 'Login - SIPAF')

@section('content')

<div class="auth-main relative">
    <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
        <div class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-[url('../images/authentication/img-auth-bg.jpg')] dark:bg-none dark:bg-themedark-bodybg">
            <div class="card sm:my-12 w-full max-w-[480px] shadow-none">
                <div class="card-body !p-10">
                    <div class="text-center">
                        <a href="{{ route('home') }}"><img src="{{ asset('templates/backend/images/logo-dark.svg') }}" alt="img" class="mx-auto"/></a>
                        <div class="grid my-4">
                            {{-- <button type="button" class="btn mt-2 flex items-center justify-center gap-2 text-theme-bodycolor dark:text-themedark-bodycolor bg-theme-bodybg dark:bg-themedark-bodybg border border-theme-border dark:border-themedark-border hover:border-primary-500 dark:hover:border-primary-500">
                                <img src="{{ asset('templates/backend/images/authentication/google.svg') }}" alt="img" /> <span> Sign In with Google</span>
                            </button> --}}
                        </div>
                    </div>
                    {{-- <div class="relative my-5">
                        <div aria-hidden="true" class="absolute flex inset-0 items-center">
                            <div class="w-full border-t border-theme-border dark:border-themedark-border"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-4 bg-theme-cardbg dark:bg-themedark-cardbg">OR</span>
                        </div>
                    </div> --}}
                    <h4 class="text-center font-medium mb-4">Login dengan email Anda</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus autocomplete="username" >
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex mt-1 justify-between items-center flex-wrap">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" />
                                <label class="form-check-label text-muted" for="customCheckc1">Ingat saya?</label>
                            </div>
                            @if (Route::has('password.request'))
                                <h6 class="font-normal text-primary-500 mb-0">
                                    <a href="{{ route('password.request') }}">
                                        Lupa Kata Sandi?
                                    </a>
                                </h6>
                            @endif
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-full">Login</button>
                        </div>
                    </form>
                    {{-- @if (Route::has('register'))
                        <div class="flex justify-between items-end flex-wrap mt-4">
                            <h6 class="f-w-500 mb-0">
                                Don't have an Account?
                            </h6>
                            <a
                                href="{{ route('register') }}"
                                class="text-primary-500">
                                Create Account
                            </a>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
