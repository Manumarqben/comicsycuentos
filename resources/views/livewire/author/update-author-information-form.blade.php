<div x-data="info()">
    <x-form-section submit="updateAuthorInformation">
        <x-slot name="title">
            {{ __('Author Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your author profile information.') }}
        </x-slot>

        <x-slot name="form">
            @if ($errors->any())
                <div class="col-span-6 sm:col-span-4">
                    <x-input-error for="author.alias" />
                    @if (!$errors->has('author.alias'))
                        <x-input-error for="author.slug" />
                    @endif
                    <x-input-error for="author.biography" />
                </div>
            @endif

            <div class="col-span-6 sm:col-span-4">
                <div id="preview" class="flex justify-center sm:mb-4">
                    <x-author-profile-photo :path="$this->profilePhotoPath"
                        alt="{{ $author->alias }}" />
                </div>
                <div>
                    <x-label for="photo" value="{{ __('Author photo') }}" />
                    <input type="file" name="photo" id="photo"
                        wire:model="photo">
                    <x-input-error for="photo" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="alias" value="{{ __('Alias') }}" />
                <x-input id="alias" type="text" autocomplete="alias"
                    class="mt-1 block w-full"
                    x-model.debounce.500ms="data.alias.content" />
                <x-input-error-client message="data.alias.error" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="biography" value="{{ __('Biography') }}" />
                <textarea name="biography" id="biography"
                    class="mt-1 block w-full h-32 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    x-model.debounce.500ms="data.biography.content">
                </textarea>
                <x-input-error-client message="data.biography.error" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button wire:loading.attr="disabled" wire:target="photo"
                x-bind:disabled="!valid">
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

                init() {
                    this.$watch('data.alias', value => {
                        validation(value, 'alias');
                    })
                    this.$watch('data.biography', value => {
                        validation(value, 'biography');
                    })
                },

                get valid() {
                    return validation(this.data.alias) &&
                        validation(this.data.biography)
                }
            }
        }
    </script>
</div>
