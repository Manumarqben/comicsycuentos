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
                            <div x-show="data.type.content == 'text'">
                                <div class="w-full flex justify-center" wire:ignore>
                                    <div class="w-full md:w-3/4">
                                        <textarea id="ckcontent">
                                            {!! $chapterText !!}
                                        </textarea>
                                        <x-input-error-client
                                            message="data.text.error"
                                            x-show="!validText" />
                                        <x-input-error for="chapterText" />
                                    </div>
                                </div>
                            </div>
                            <div x-show="data.type.content == 'image'">
                                <div>
                                    <x-input type="file"
                                        wire:model="temporalImages" multiple />
                                    <span wire:loading
                                        wire:tarjet="temporalImages">Uploading...</span>
                                    <x-input-error for="temporalImages.*" />
                                    <p class="h2">temporal</p>
                                    @if (!$chapter->images->isEmpty() && $temporalImages == [])
                                        <div class="flex gap-1">
                                            @foreach ($chapter->images as $image)
                                                <img src="{{ Storage::url($image->url) }}"
                                                    class="w-64 sm:w-72">
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($temporalImages != [])
                                        <p>images Preview:</p>
                                        <div class="flex gap-1">
                                            @foreach ($temporalImages as $image)
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="w-64 sm:w-72">
                                            @endforeach
                                        </div>
                                    @endif
                                    <p class="h2">chapter</p>

                                    @if (!$chapter->images->isEmpty() && $chapterImages == [])
                                        <div class="flex gap-1">
                                            @foreach ($chapter->images as $image)
                                                <img src="{{ Storage::url($image->url) }}"
                                                    class="w-64 sm:w-72">
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($chapterImages != [])
                                        <div>
                                            images Preview:
                                            <span wire:loading
                                                wire:tarjet="deleteImage">Updating...</span>
                                        </div>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($chapterImages as $key => $image)
                                                <div
                                                    class="relative w-64 sm:w-72 max-h-96">
                                                    <img src="{{ $image->temporaryUrl() }}"
                                                        class="max-h-96">
                                                    <x-danger-button class="absolute top-1 right-1 z-10"
                                                        wire:click="deleteImage({{ $key }})">
                                                        X
                                                    </x-danger-button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
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
                <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
            @endPushOnce
            <script>
                function form() {
                    return {
                        validNumber: true,
                        validTitle: true,
                        validType: true,
                        validText: true,
                        validImages: @entangle('validImages'),

                        get valid() {
                            return this.validNumber &&
                                this.validTitle &&
                                this.validType &&
                                (this.validText || this.validImages);
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
                                content: @entangle('contentType').defer,
                                rules: {
                                    require: true,
                                },
                                error: '',
                            },
                            text: {
                                content: @entangle('chapterText').defer,
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
                            this.$watch('data.text', value => {
                                this.validText = validation(value, 'text');
                            })

                            if (document.querySelector('#ckcontent')) {
                                ClassicEditor.create(document.querySelector('#ckcontent'), {
                                        toolbar: {
                                            items: [
                                                'bold', 'italic', '|',
                                                'heading', '|',
                                                'bulletedList', 'numberedList', '|',
                                                'blockQuote', '|',
                                                'undo', 'redo'
                                            ],
                                            shouldNotGroupWhenFull: false,
                                        },
                                    })
                                    .then(editor => {
                                        editor.model.document.on('change:data', () => {
                                            this.data.text.content = editor
                                                .getData()
                                        });
                                        let interiorToolbar = document.querySelector(
                                            '.ck-sticky-panel__content');
                                        interiorToolbar.style.top = '4rem';

                                        let outdoorToolbar = document.querySelector(
                                            '.ck-editor__top');
                                        outdoorToolbar.style.position = 'sticky';
                                        outdoorToolbar.style.top = '4rem';
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            }
                        },

                        validateAllFields() {
                            this.validNumber = validation(this.data.number,
                                'number');
                            this.validTitle = validation(this.data.title, 'title');
                            this.validType = validation(this.data.type, 'type');
                        },

                        setContentType(value) {
                            this.data.type.content = value;
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
