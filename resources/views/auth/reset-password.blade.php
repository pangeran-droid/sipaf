@extends('layouts.guest')

@section('title', 'Reset Password - SIPAF')

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

                    <div class="text-center my-5">
                        <h4 class="font-medium mb-2">Reset Kata Sandi</h4>
                        <p class="text-muted">
                            Silakan masukkan kata sandi baru Anda.
                        </p>
                    </div>

                    <!-- Email Address -->
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Alamat Email"
                                value="{{ old('email', $request->email) }}"
                                required
                                autofocus
                                autocomplete="username">

                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password baru"
                                required
                                autocomplete="new-password">

                            @error('password')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Ulangi password baru"
                                required
                                autocomplete="new-password">

                            @error('password_confirmation')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Button -->
                        <div class="mt-4">
                            <button
                                type="submit"
                                class="btn btn-primary w-full">
                                Reset Kata Sandi
                            </button>
                        </div>
                    </form>

                    <!-- Back Login -->
                    <div class="text-center mt-4">
                        <a
                            href="{{ route('login') }}"
                            class="text-primary-500">
                            Kembali ke Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
