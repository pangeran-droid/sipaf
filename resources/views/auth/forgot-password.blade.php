@extends('layouts.guest')

@section('title', 'Lupa Kata Sandi - SIPAF')

@section('content')

<div class="auth-main relative">
    <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
        <div class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-[url('../images/authentication/img-auth-bg.jpg')] dark:bg-none dark:bg-themedark-bodybg">

            <div class="card sm:my-12 w-full max-w-[480px] shadow-none">
                <div class="card-body !p-10">

                    <div class="text-center mb-5">
                        <h4 class="font-medium mb-2">Lupa Kata Sandi?</h4>

                        <p class="text-muted">
                            Masukkan alamat email Anda dan kami akan mengirimkan link reset password.
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">
                                Alamat Email
                            </label>

                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ old('email') }}" required autofocus autocomplete="username" />

                            @error('email')
                                <div class="text-danger mt-1 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Button -->
                        <div class="mt-4">
                            <button
                                type="submit"
                                class="btn btn-primary w-full">
                                Tautan Reset Kata Sandi Email
                            </button>
                        </div>

                        <!-- Back Login -->
                        <div class="text-center mt-4">
                            <a
                                href="{{ route('login') }}"
                                class="text-primary-500">
                                Kembali ke Login
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
