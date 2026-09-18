@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div class="auth-main relative">
    <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
        <div class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-[url('../images/authentication/img-auth-bg.jpg')] dark:bg-none dark:bg-themedark-bodybg">
            <div class="card sm:my-12 w-full max-w-[480px] shadow-none">
                <div class="card-body !p-10">

                    <div class="text-center mb-5">
                        <h4 class="font-medium mb-2">
                            Confirm Password
                        </h4>

                        <p class="text-muted">
                            This is a secure area of the application.
                            Please confirm your password before continuing.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password" autofocus />

                            @error('password')
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
                                Confirm
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
