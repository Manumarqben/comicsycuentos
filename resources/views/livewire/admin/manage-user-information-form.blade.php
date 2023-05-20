<div x-data="informationForm()" id="updateProfileInformationForm">
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('User Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update a user profile information.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name"
                        class="mt-1 block w-full {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text" autocomplete="name"
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

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="birthdate" value="{{ __('Birthdate') }}" />
                    <x-input id="birthdate"
                        class="mt-1 block w-full {{ $errors->has('birthdate') ? 'is-invalid' : '' }}"
                        type="date" autocomplete="birthdate"
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

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email"
                        class="mt-1 block w-full {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="email" autocomplete="username"
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
        </x-slot>

        <x-slot name="actions">
            <x-button wire:loading.attr="disabled" wire:target="photo"
                @click.prevent="submit" x-bind:disabled="!valid">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @pushOnce('customScripts')
        <script src="{{ asset('js/validator.js') }}"></script>
    @endPushOnce
    <script>
        function informationForm() {
            return {
                validName: true,
                validEmail: true,
                validBirthdate: true,

                get valid() {
                    return this.validName &&
                        this.validEmail &&
                        this.validBirthdate;
                },

                data: {
                    name: {
                        content: @entangle('user.name').defer,
                        rules: {
                            require: true,
                            max: 255,
                        },
                        error: '',
                    },
                    email: {
                        content: @entangle('user.email').defer,
                        rules: {
                            require: true,
                            max: 255,
                            email: true,
                        },
                        error: '',
                    },
                    birthdate: {
                        content: @entangle('user.birthdate').defer,
                        rules: {
                            date: true,
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
                },

                validateAllFields() {
                    this.validName = validation(this.data.name, 'name');
                    this.validEmail = validation(this.data.email, 'email');
                    this.validBirthdate = validation(this.data.birthdate,
                        'birthdate');
                },

                submit() {
                    this.validateAllFields();
                    if (this.valid) {
                        this.$wire.updateProfileInformation().then(() => {
                            this.$refs.nameServerError.classList.remove(
                                'hidden');
                            this.$refs.emailServerError.classList.remove(
                                'hidden');
                            this.$refs.birthdateServerError.classList
                                .remove('hidden');
                            this.focusInError();
                        });
                    }
                },
            }
        }
    </script>
</div>
