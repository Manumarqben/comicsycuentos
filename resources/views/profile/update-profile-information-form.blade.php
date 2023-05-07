<div x-data="informationForm()" id="updateProfileInformationForm">
    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" wire:model="photo"
                        x-ref="photo"
                        x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <x-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}"
                            alt="{{ $this->user->name }}"
                            class="rounded-full h-20 w-20 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview"
                        style="display: none;">
                        <span
                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="mt-2 mr-2" type="button"
                        x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2"
                            wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif
            <!-- Name -->
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

            <!-- Birthdate -->
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

            <!-- Email -->
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

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2 dark:text-white">
                        {{ __('Your email address is unverified.') }}

                        <button type="button"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p v-show="verificationLinkSent"
                            class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

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
                        content: @entangle('state.name').defer,
                        rules: {
                            require: true,
                            max: 255,
                        },
                        error: '',
                    },
                    email: {
                        content: @entangle('state.email').defer,
                        rules: {
                            require: true,
                            max: 255,
                            email: true,
                        },
                        error: '',
                    },
                    birthdate: {
                        content: @entangle('state.birthdate').defer,
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
