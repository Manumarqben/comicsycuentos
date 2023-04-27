<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Chapter form') }}
        </h2>
    </x-slot>
    <div class="container">
        <div x-data="form()">
            <x-form submit="submit">
                @slot('form')
                    <div class="col-span-6">
                        <div class="flex">
                            <div>
                                <x-label for="number">{{ __('Number') }}</x-label>
                                <x-input id="number" type="number" name="number"
                                    :value="old('chapter.number')" class="block w-20"
                                    x-model.debounce.500ms="data.number.content"
                                    @input="$refs.numberServerError.classList.add('hidden')" />
                            </div>
                            <div class="w-full">
                                <x-label for="title">Title</x-label>
                                <x-input id="title" type="text"
                                    name="title" :value="old('chapter.title')"
                                    class="block w-full"
                                    x-model.debounce.500ms="data.title.content"
                                    @input="$refs.titleServerError.classList.add('hidden')" />
                            </div>
                        </div>
                        <div>
                            <x-input-error-client message="data.number.error"
                                x-show="!validNumber" />
                            <div x-ref="numberServerError">
                                <x-input-error for="chapter.number" />
                            </div>
                            <x-input-error-client message="data.title.error"
                                x-show="!validTitle" />
                            <div x-ref="titleServerError">
                                <x-input-error for="chapter.title" />
                            </div>
                        </div>
                    </div>
                    <div id="content">
                        <div class="flex flex-row">
                            <x-button @click.prevent="contentType = 'text'"
                                x-bind:disabled="contentType == 'text'"
                                wire:loading.attr="disabled">
                                Text
                            </x-button>
                            <x-button @click.prevent="contentType = 'image'"
                                x-bind:disabled="contentType == 'image'"
                                wire:loading.attr="disabled">
                                Image
                            </x-button>
                        </div>
                        <div x-show="contentType == 'text'">
                            texto
                            {{-- * Parte encargada de crear contenido del capítulo cuando es texto --}}
                        </div>

                        <div x-show="contentType == 'image'">
                            imágenes
                            {{-- * Parte encargada de crear contenido del capítulo cuando son imágenes --}}
                        </div>

                    </div>
                @endslot

                @slot('actions')
                    <x-button wire:loading.attr="disabled" @click.prevent="submit"
                        x-bind:disabled="!valid">
                        {{ __('Submit') }}
                    </x-button>
                @endslot
            </x-form>

            @pushOnce('customScripts')
                <script src="{{ asset('js/validator.js') }}"></script>
                <script>
                    function form() {
                        return {
                            validNumber: true,
                            validTitle: true,

                            contentType: @entangle('contentType').defer,

                            data: {
                                number: {
                                    content: @entangle('chapter.number').defer,
                                    rules: {
                                        require: true,
                                        number: true,
                                        greaterThanOrEqual: 0,
                                    },
                                    error: '',
                                },
                                title: {
                                    content: @entangle('chapter.title').defer,
                                    rules: {
                                        require: true,
                                        max: 255,
                                    },
                                    error: '',
                                },
                            },

                            init() {
                                this.$watch('data.number', value => {
                                    this.validNumber = validation(value, 'number');
                                })
                                this.$watch('data.title', value => {
                                    this.validTitle = validation(value, 'title');
                                })
                            },

                            validateAllFields() {
                                this.validNumber = validation(this.data.number, 'number');
                                this.validTitle = validation(this.data.title, 'title');
                            },

                            get valid() {
                                return this.validNumber &&
                                    this.validTitle;
                            },

                            submit() {
                                this.validateAllFields();
                                if (this.valid) {
                                    this.$wire.submit().then(() => {
                                        this.$refs.numberServerError.classList
                                            .remove('hidden');
                                        this.$refs.titleServerError.classList
                                            .remove('hidden');
                                    });
                                }
                            },
                        }
                    }
                </script>
            @endPushOnce
        </div>
    </div>
</div>
