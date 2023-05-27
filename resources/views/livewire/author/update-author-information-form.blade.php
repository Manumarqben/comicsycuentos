<div x-data="info()">
    <x-form-section submit="updateAuthorInformation">
        <x-slot name="title">
            {{ __('Author Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your author profile information.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <div id="preview" class="flex justify-center sm:mb-4">
                    <x-author-profile-photo :path="$this->profilePhotoPath"
                        alt="{{ $author->alias }}" />
                </div>
                <div class="overflow-hidden">
                    <x-label for="photo" value="{{ __('Author photo') }}" />
                    <input type="file" name="photo" id="photo"
                        wire:model="photo">
                    <x-input-error for="photo" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="alias" value="{{ __('Alias') }}" />
                    <x-input id="alias" type="text" autocomplete="alias"
                        class="mt-1 block w-full {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        x-model.debounce.500ms="data.alias.content"
                        @input="$refs.aliasServerError.classList.add('hidden')" />
                </div>
                <div>
                    <x-input-error-client message="data.alias.error"
                        x-show="!validAlias" />
                    <div x-ref="aliasServerError">
                        <x-input-error for="author.alias" />
                        @if (!$errors->has('author.alias'))
                            <x-input-error for="author.slug" />
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div>
                    <x-label for="biography" value="{{ __('Biography') }}" />
                    <x-textarea name="biography" id="biography"
                        class="mt-1 block w-full h-32  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        x-model.debounce.500ms="data.biography.content"
                        @input="$refs.biographyServerError.classList.add('hidden')">
                    </x-textarea>
                </div>
                <div>
                    <x-input-error-client message="data.biography.error"
                        x-show="!validBiography" />
                    <div x-ref="biographyServerError">
                        <x-input-error for="author.biography" />
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
    @once
        <script src="{{ asset('js/validator.js') }}"></script>
    @endonce
    <script>
        function info() {
            return {
                validAlias: true,
                validBiography: true,

                get valid() {
                    return this.validAlias &&
                        this.validBiography;
                },

                data: {
                    alias: {
                        content: @entangle('author.alias').defer,
                        rules: {
                            require: true,
                            max: 20,
                            min: 4,
                        },
                        error: '',
                    },
                    biography: {
                        content: @entangle('author.biography').defer,
                        rules: {
                            max: 255,
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
                    this.$watch('data.alias', value => {
                        this.validAlias = validation(value, 'alias');
                    })
                    this.$watch('data.biography', value => {
                        this.validBiography = validation(value,
                            'biography');
                    })
                },

                validateAllFields() {
                    this.validAlias = validation(this.data.alias, 'alias');
                    this.validBiography = validation(this.data.biography,
                        'biography');
                },

                submit() {
                    this.validateAllFields();
                    if (this.valid) {
                        this.$wire.updateAuthorInformation().then(() => {
                            this.$refs.aliasServerError.classList.remove(
                                'hidden');
                            this.$refs.biographyServerError.classList
                                .remove('hidden');
                            this.focusInError();
                        });
                    }
                },
            }
        }
    </script>
</div>
