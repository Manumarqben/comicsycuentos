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
                    <div class="col-span-6">
                        <div id="content-menu">
                            <div class="flex flex-row">
                                <x-button @click.prevent="setContentType('text')"
                                    x-bind:disabled="data.type.content == 'text'"
                                    wire:loading.attr="disabled">
                                    Text
                                </x-button>
                                <x-button @click.prevent="setContentType('image')"
                                    x-bind:disabled="data.type.content == 'image'"
                                    wire:loading.attr="disabled">
                                    Image
                                </x-button>
                            </div>
                            <x-input-error-client
                                message="'You need to select a valid content type.'"
                                x-show="!validType" />
                            <div x-ref="contentTypeServerError">
                                <x-input-error for="contentType" />
                            </div>
                        </div>
                        <div id="chapterContent">
                            @if ($contentType == 'text')
                                <div>
                                    text
                                    <x-input-error for="chapterText" />

                                    {{-- * Parte encargada de crear contenido del capítulo cuando es texto --}}
                                </div>
                            @endif
                            @if ($contentType == 'image')
                                <div>
                                    imágenes
                                    <x-input-error for="chapterImages" />

                                    {{-- * Parte encargada de crear contenido del capítulo cuando son imágenes --}}
                                </div>
                            @endif
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
            @endPushOnce
            <script>
                function form() {
                    return {
                        validNumber: true,
                        validTitle: true,
                        validType: true,
                        validContent: true,

                        get valid() {
                            return this.validNumber &&
                                this.validTitle &&
                                this.validType &&
                                this.validContent;
                        },

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
                            type: {
                                content: @entangle('contentType'),
                                rules: {
                                    require: true,
                                },
                                error: '',
                            },
                            text: {
                                content: @entangle('chapterText'),
                                rules: {
                                    require: true,
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
                            this.$watch('data.type', value => {
                                this.validType = validation(value, 'content type');
                            })
                        },

                        validateAllFields() {
                            this.validNumber = validation(this.data.number,
                                'number');
                            this.validTitle = validation(this.data.title, 'title');
                            this.validType = validation(this.data.type, 'type');
                        },

                        setContentType(value) {
                            this.data.type.content = value;
                            this.validContent = true;
                            this.$refs.contentTypeServerError.classList.add(
                                'hidden');
                        },

                        submit() {
                            this.validateAllFields();
                            if (this.valid) {
                                this.$wire.submit().then(() => {
                                    this.$refs.numberServerError.classList
                                        .remove('hidden');
                                    this.$refs.titleServerError.classList
                                        .remove('hidden');
                                    this.$refs.contentTypeServerError
                                        .classList
                                        .remove('hidden');
                                });
                            }
                        },
                    }
                }
            </script>
        </div>
    </div>
</div>
