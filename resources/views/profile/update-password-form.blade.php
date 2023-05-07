<div x-data="passwordForm()" id="updatePassword">
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password"
                    value="{{ __('Current Password') }}" />
                <x-input id="current_password" type="password"
                    class="mt-1 block w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.current_password"
                    autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="password" value="{{ __('New Password') }}" />
                    <x-input id="password" type="password"
                        class="mt-1 block w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        wire:model.defer="state.password"
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

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="password_confirmation"
                        value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" type="password"
                        class="mt-1 block w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        wire:model.defer="state.password_confirmation"
                        autocomplete="new-password"
                        x-model.debounce.500mx="data.passwordConfirmation.content" />
                </div>
                <div>
                    <x-input-error-client
                        message="data.passwordConfirmation.error"
                        x-show="!validPasswordConfirmation" />
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
    @pushOnce('customScripts')
        <script src="{{ asset('js/validator.js') }}"></script>
    @endPushOnce
    <script>
        function passwordForm() {
            return {
                validPassword: true,
                validPasswordConfirmation: true,

                get valid() {
                    return this.validPassword &&
                        this.validPasswordConfirmation;
                },

                data: {
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
                    this.validPassword = validation(this.data.password, 'password');
                    this.validPasswordConfirmation = validation(
                        this.data.passwordConfirmation, 'password'
                    );
                },

                submit() {
                    this.validateAllFields();
                    if (this.valid) {
                        this.$wire.updatePassword().then(() => {
                            this.$refs.passwordServerError.classList
                                .remove('hidden');
                            this.$refs.passwordConfirmationServerError
                                .classList.remove('hidden');
                            this.focusInError();
                        });
                    }
                },
            }
        }
    </script>
</div>
