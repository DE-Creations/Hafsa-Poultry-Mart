<x-guest-layout>
    @section('title', 'Login')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form action="{{ route('login') }}" method="POST" class="my-5">
        @csrf
        <div class="bg-white p-5 rounded-4">
            <div class="login-form">
                <a href="{{ route('dashboard') }}" class="mb-3 d-flex">
                    {{--  <img src="{{ asset('assets/images/logo-dark.svg') }}" class="img-fluid login-logo" alt="logo" />  --}}
                    <h2 class="fs-2 fw-semibold text-gray-500">Hafsa Poultry Mart</h2>
                </a>
                <h2 class="mt-4 mb-3 fs-3 fw-semibold">Login</h2>
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                    <x-text-input id="email" class="block mt-1 w-full h-50" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                    <x-text-input id="password" class="block mt-1 w-full h-50" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check ms-n3">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember') }}</span>
                        </label>
                        {{--  <input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
                        <label class="form-check-label" for="rememberPassword">Remember</label>  --}}
                    </div>
                </div>
                <div class="d-grid py-3 mt-3 gap-3">
                    <button type="submit" class="btn btn-lg btn-primary">
                        LOGIN
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
