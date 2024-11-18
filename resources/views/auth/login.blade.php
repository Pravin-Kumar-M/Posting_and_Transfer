<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" />Email
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" />Password

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- captcha -->
        <div class="mt-4">
            @php
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            session(['captcha_answer' => $num1 + $num2]);
            @endphp
            <x-input-label for="captcha" class="block text-sm font-medium text-gray-700" />
            Enter the Captcha : What is {{ $num1 }} + {{ $num2 }}?

            <x-text-input id="captcha" type="text" name="captcha" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 flex justify-between items-center">
            <!-- remember me -->
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            <!-- forgot password -->
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>

        <div class="mt-4">
            {!! NoCaptcha::display() !!}
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>

        <div class="mt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>


        <!-- register -->
        <div class="text-center mt-4 flex items-center justify-center gap-2">
            @if(Route::has('register'))
            <x-input-label for="register-link" :value="__('Don\'t have an account yet?')" class="block text-sm font-medium text-gray-700 mr-2" />
            <a id="register-link" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Register') }}
            </a>
            @endif
        </div>

    </form>
</x-guest-layout>