<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Works creation form') }}
        </h2>
    </x-slot>
    <div x-data="form()" class="container">
        <x-form submit="submit">
            @slot('form')
                <div class="col-span-6">
                    <x-label for="title">Title</x-label>
                    <x-input id="title" type="text" name="title"
                        :value="old('work.title')" class="block w-full"
                        x-model.debounce.500ms="data.title.content"
                        @input="$refs.titleServerError.classList.add('hidden')" />
                    <x-input-error-client message="data.title.error"
                        x-show="!validTitle" />
                    <div x-ref="titleServerError">
                        <x-input-error for="work.title" />
                        @if (!$errors->has('work.title'))
                            <x-input-error for="work.slug" />
                        @endif
                    </div>
                </div>
                <div class="col-span-6">
                    <x-label for="synopsis">Synopsis</x-label>
                    <textarea name="synopsis" id="synopsis"
                        class="mt-1 block w-full h-32 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        x-model.debounce.500ms="data.synopsis.content"
                        @input="$refs.synopsisServerError.classList.add('hidden')" />
                        {{ old('work.synopsis') }}
                    </textarea>
                    <x-input-error-client message="data.synopsis.error"
                        x-show="!validSynopsis" />
                    <div x-ref="synopsisServerError">
                        <x-input-error for="work.synopsis" />
                    </div>
                </div>
                <div class="col-span-6">
                    <x-label for="types">Types</x-label>
                    <select class="block w-full" x-model="data.type.content"
                        @input="$refs.typeServerError.classList.add('hidden')">
                        <option value="">{{ __('Select a type') }}</option>
                        @foreach ($types as $id => $type)
                            <option value="{{ $id }}"
                                wire:key="{{ "type-$id" }}">
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error-client message="data.type.error"
                        x-show="!validType" />
                    <div x-ref="typeServerError">
                        <x-input-error for="work.type_id" />
                    </div>
                </div>
                <div class="col-span-6">
                    <x-label for="states">State</x-label>
                    <select class="block w-full" x-model="data.state.content"
                        @input="$refs.stateServerError.classList.add('hidden')">
                        <option value="">{{ __('Select a state') }}</option>
                        @foreach ($states as $id => $state)
                            <option value="{{ $id }}"
                                wire:key="{{ "state-$id" }}">
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error-client message="data.state.error"
                        x-show="!validState" />
                    <div x-ref="stateServerError">
                        <x-input-error for="work.state_id" />
                    </div>
                </div>
                <div class="col-span-6">
                    <x-label for="ages">Ages</x-label>
                    <select class="block w-full" x-model="data.age.content"
                        @input="$refs.ageServerError.classList.add('hidden')">
                        <option value="">{{ __('Select a age') }}</option>
                        @foreach ($ages as $id => $age)
                            <option value="{{ $id }}"
                                wire:key="{{ "age-$id" }}">
                                {{ $age }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error-client message="data.age.error"
                        x-show="!validAge" />
                    <div x-cloak x-ref="ageServerError">
                        <x-input-error for="work.age_id" />
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
        @once
            <script src="{{ asset('js/validator.js') }}"></script>
        @endonce
        <script>
            function form() {
                return {
                    validTitle: true,
                    validSynopsis: true,
                    validType: true,
                    validState: true,
                    validAge: true,

                    data: {
                        title: {
                            content: @entangle('work.title').defer,
                            rules: {
                                require: true,
                                max: 200,
                            },
                            error: '',
                        },
                        synopsis: {
                            content: @entangle('work.synopsis').defer,
                            rules: {
                                require: true,
                            },
                            error: '',
                        },
                        type: {
                            content: @entangle('work.type_id').defer,
                            rules: {
                                require: true,
                            },
                            error: '',
                        },
                        state: {
                            content: @entangle('work.state_id').defer,
                            rules: {
                                require: true,
                            },
                            error: '',
                        },
                        age: {
                            content: @entangle('work.age_id').defer,
                            rules: {
                                require: false,
                            },
                            error: '',
                        },
                    },

                    init() {
                        this.$watch('data.title', value => {
                            this.validTitle = validation(value, 'title');
                        });
                        this.$watch('data.synopsis', value => {
                            this.validSynopsis = validation(value, 'synopsis');
                        });
                        this.$watch('data.type', value => {
                            this.validType = validation(value, 'type');
                        });
                        this.$watch('data.state', value => {
                            this.validState = validation(value, 'state');
                        });
                        this.$watch('data.age', value => {
                            this.validAge = validation(value, 'age');
                        });
                    },

                    validateAllFields() {
                        this.validTitle = validation(this.data.title, 'title');
                        this.validSynopsis = validation(this.data.synopsis,
                            'synopsis');
                        this.validType = validation(this.data.type, 'type');
                        this.validState = validation(this.data.state, 'state');
                        this.validAge = validation(this.data.age, 'age');
                    },

                    get valid() {
                        return this.validTitle &&
                            this.validSynopsis &&
                            this.validType &&
                            this.validState &&
                            this.validAge;
                    },

                    submit() {
                        this.validateAllFields();
                        if (this.valid) {
                            this.$wire.submit().then(() => {
                                // con el then evito que se muestren los errores anteriores antes de tener la respuesta.
                                this.$refs.titleServerError.classList.remove(
                                    'hidden');
                                this.$refs.synopsisServerError.classList.remove(
                                    'hidden');
                                this.$refs.typeServerError.classList.remove(
                                    'hidden');
                                this.$refs.stateServerError.classList.remove(
                                    'hidden');
                                this.$refs.ageServerError.classList.remove(
                                    'hidden');
                            })
                        }
                    },
                }
            }
        </script>
    </div>
</div>
