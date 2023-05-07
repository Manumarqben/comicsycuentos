<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div x-data="form()">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name"
                            class="block mt-1 w-full {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name"
                            x-model.debounce.500ms="data.name.content"
                            @input="$refs.nameServerError.classList.add('hidden')" />
                    </div>
                    <div>
                        <x-input-error-client message="data.name.error"
                            x-show="!validName" />
                        <div x-ref="nameServerError">
                            <x-input-error for="name" />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email"
                            class="block mt-1 w-full {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            type="email" name="email" :value="old('email')"
                            required autocomplete="username"
                            x-model.debounce.500ms="data.email.content"
                            @input="$refs.emailServerError.classList.add('hidden')" />
                    </div>
                    <div>
                        <x-input-error-client message="data.email.error"
                            x-show="!validEmail" />
                        <div x-ref="emailServerError">
                            <x-input-error for="email" />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <x-label for="birthdate"
                            value="{{ __('Birthdate') }}" />
                        <x-input id="birthdate"
                            class="block mt-1 w-full {{ $errors->has('birthdate') ? 'is-invalid' : '' }}"
                            type="date" name="birthdate" :value="old('birthdate')"
                            x-model.debounce.500ms="data.birthdate.content"
                            @input="$refs.birthdateServerError.classList.add('hidden')" />
                    </div>
                    <div>
                        <x-input-error-client message="data.birthdate.error"
                            x-show="!validBirthdate" />
                        <div x-ref="birthdateServerError">
                            <x-input-error for="birthdate" />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password"
                            class="block mt-1 w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            type="password" name="password" required
                            autocomplete="new-password"
                            x-model.debounce.500ms="data.password.content"
                            @input="$refs.passwordServerError.classList.add('hidden')" />
                    </div>
                    <div>
                        <x-input-error-client message="data.password.error"
                            x-show="!validPassword" />
                        <div x-ref="passwordServerError">
                            <x-input-error for="password" />
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation"
                        value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation"
                        class="block mt-1 w-full" type="password"
                        name="password_confirmation" required
                        autocomplete="new-password"
                        x-model.debounce.500mx="data.passwordConfirmation.content" />
                    <div>
                        <x-input-error-client
                            message="data.passwordConfirmation.error"
                            x-show="!validPasswordConfirmation" />
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms"
                                    required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4" wire:loading.attr="disabled"
                        @click.prevent="submit" x-bind:disabled="!valid">
                        {{ __('Register') }}
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
                validName: true,
                validEmail: true,
                validBirthdate: true,
                validPassword: true,
                validPasswordConfirmation: true,

                get valid() {
                    return this.validName &&
                        this.validEmail &&
                        this.validBirthdate &&
                        this.validPassword &&
                        this.validPasswordConfirmation;
                },

                data: {
                    name: {
                        content: @js(old('name')),
                        rules: {
                            require: true,
                            max: 255,
                        },
                        error: '',
                    },
                    email: {
                        content: @js(old('email')),
                        rules: {
                            require: true,
                            max: 255,
                            email: true,
                        },
                        error: '',
                    },
                    birthdate: {
                        content: @js(old('birthdate')),
                        rules: {
                            date: true,
                        },
                        error: '',
                    },
                    password: {
                        content: '',
                        rules: {
                            require: true,
                            min: 8,
                        },
                        error: '',
                    },
                    passwordConfirmation: {
                        content: '',
                        rules: {
                            require: true,
                            equal: '',
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
                    this.$watch('data.name', value => {
                        this.validName = validation(value, 'name');
                    })
                    this.$watch('data.email', value => {
                        this.validEmail = validation(value, 'email');
                    })
                    this.$watch('data.birthdate', value => {
                        this.validBirthdate = validation(value,
                            'birthdate');
                    })
                    this.$watch('data.password', value => {
                        this.validPassword = validation(value, 'password');
                        if (this.data.passwordConfirmation.content != '') {
                            this.data.passwordConfirmation.rules.equal =
                                this.data.password.content;
                        }
                    })
                    this.$watch('data.passwordConfirmation', value => {
                        this.data.passwordConfirmation.rules.equal = this
                            .data.password.content;
                        this.validPasswordConfirmation = validation(value,
                            'password');
                    })
                },

                validateAllFields() {
                    this.validName = validation(this.data.name, 'name');
                    this.validEmail = validation(this.data.email, 'email');
                    this.validBirthdate = validation(this.data.birthdate,
                        'birthdate');
                    this.validPassword = validation(this.data.password, 'password');
                    this.validPasswordConfirmation = validation(
                        this.data.passwordConfirmation, 'password'
                    );
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
