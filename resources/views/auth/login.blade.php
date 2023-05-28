<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif
        <div x-data="form()">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email"
                            class="block mt-1 w-full {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username"
                            x-model.debounce.500ms="data.email.content" />
                    </div>
                    <div>
                        <x-input-error-client message="data.email.error"
                            x-show="!validEmail" />
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password"
                            class="block mt-1 w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            type="password" name="password" required
                            autocomplete="current-password"
                            x-model.debounce.500ms="data.password.content" />
                    </div>
                    <div>
                        <x-input-error-client message="data.password.error"
                            x-show="!validPassword" />
                    </div>
                </div>

                {{-- <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span
                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div> --}}

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-4" wire:loading.attr="disabled"
                        @click.prevent="submit" x-bind:disabled="!valid">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
    @pushOnce('customScripts')
        <script src="{{ asset('js/validator.js') }}"></script>
    @endPushOnce
    <script>
        function form() {
            return {
                validEmail: true,
                validPassword: true,

                get valid() {
                    return this.validEmail &&
                        this.validPassword;
                },

                data: {
                    email: {
                        content: @js(old('email')),
                        rules: {
                            require: true,
                            max: 255,
                            email: true,
                        },
                        error: '',
                    },
                    password: {
                        content: '',
                        rules: {
                            require: true,
                        },
                        error: '',
                    },
                },

                focusInError() {
                    let firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.focus();
                        firstError.scrollIntoView(false);
                    }
                },

                init() {
                    this.focusInError();
                    this.$watch('data.email', value => {
                        this.validEmail = validation(value, 'email');
                    })

                    this.$watch('data.password', value => {
                        this.validPassword = validation(value, 'password');
                    })
                },

                validateAllFields() {
                    this.validEmail = validation(this.data.email, 'email');
                    this.validPassword = validation(this.data.password, 'password');
                },

                submit() {
                    this.validateAllFields();
                    if (this.valid) {
                        document.querySelector('form').submit();
                    }
                },
            }
        }
    </script>
</x-app-layout>
