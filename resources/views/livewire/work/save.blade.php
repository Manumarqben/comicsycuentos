<div>
    <x-slot name="header">
        <h2 class="h2">
            {{ __('Work form') }}
        </h2>
    </x-slot>
    <div x-data="workForm()" class="container">
        <x-form submit="submit">
            @slot('form')
                <div class="col-span-6">
                    <div>
                        <x-label for="title">Title</x-label>
                        <x-input id="title" type="text" name="title"
                            :value="old('work.title')"
                            class="block w-full {{ $errors->has('work.title') ? 'is-invalid' : '' }}"
                            x-model.debounce.500ms="data.title.content"
                            @input="$refs.titleServerError.classList.add('hidden')" />
                    </div>
                    <div>
                        <x-input-error-client message="data.title.error"
                            x-show="!validTitle" />
                        <div x-ref="titleServerError">
                            <x-input-error for="work.title" />
                            @if (!$errors->has('work.title'))
                                <x-input-error for="work.slug" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <div>
                        <x-label for="synopsis">Synopsis</x-label>
                        <x-textarea name="synopsis" id="synopsis"
                            class="mt-1 block w-full h-32 {{ $errors->has('work.synopsis') ? 'is-invalid' : '' }}"
                            x-model.debounce.500ms="data.synopsis.content"
                            @input="$refs.synopsisServerError.classList.add('hidden')">
                            {{ old('work.synopsis') }}
                        </x-textarea>
                    </div>
                    <div>
                        <x-input-error-client message="data.synopsis.error"
                            x-show="!validSynopsis" />
                        <div x-ref="synopsisServerError">
                            <x-input-error for="work.synopsis" />
                        </div>
                    </div>
                </div>
                <div class="col-span-6 md:flex">
                    <div class="flex flex-col w-full md:h-full pb-4 gap-3">
                        <div>
                            <x-label for="frontPage">
                                {{ __('Front page') }}
                            </x-label>
                            <x-input id="frontPage" type="file" name="frontPage"
                                :value="old('frontPage')" 
                                class="{{ $errors->has('frontPage') ? 'is-invalid' : '' }}" wire:model="frontPage" />
                            <span wire:loading wire:target="frontPage">
                                {{ __('Uploading') }}...
                            </span>
                            <x-input-error for="frontPage" />
                        </div>
                        <div>
                            <div>
                                <x-label for="types">{{ __('Types') }}
                                </x-label>
                                <select
                                    class="block w-full {{ $errors->has('work.type_id') ? 'is-invalid' : '' }}"
                                    x-model="data.type.content" x-ref="types"
                                    @input="$refs.typeServerError.classList.add('hidden')">
                                    <option value="">{{ __('Select a type') }}
                                    </option>
                                    @foreach ($types as $id => $type)
                                        <option value="{{ $id }}"
                                            id="{{ "type-$id" }}"
                                            wire:key="{{ "type-$id" }}">
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-error-client message="data.type.error"
                                    x-show="!validType" />
                                <div x-ref="typeServerError">
                                    <x-input-error for="work.type_id" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <x-label for="states">{{ __('State') }}
                                </x-label>
                                <select
                                    class="block w-full {{ $errors->has('work.state_id') ? 'is-invalid' : '' }}"
                                    x-model="data.state.content"
                                    @input="$refs.stateServerError.classList.add('hidden')">
                                    <option value="">
                                        {{ __('Select a state') }}
                                    </option>
                                    @foreach ($states as $id => $state)
                                        <option value="{{ $id }}"
                                            id="{{ "state-$id" }}"
                                            wire:key="{{ "state-$id" }}">
                                            {{ $state }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-error-client message="data.state.error"
                                    x-show="!validState" />
                                <div x-ref="stateServerError">
                                    <x-input-error for="work.state_id" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <x-label for="ages">{{ __('Ages') }}
                                </x-label>
                                <select
                                    class="block w-full {{ $errors->has('work.age_id') ? 'is-invalid' : '' }}"
                                    x-model="data.age.content" x-ref="ages"
                                    @input="$refs.ageServerError.classList.add('hidden')">
                                    <option value="">{{ __('Select a age') }}
                                    </option>
                                    @foreach ($ages as $id => $age)
                                        <option value="{{ $id }}"
                                            id="{{ "age-$id" }}"
                                            wire:key="{{ "age-$id" }}">
                                            {{ $age }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-error-client message="data.age.error"
                                    x-show="!validAge" />
                                <div x-cloak x-ref="ageServerError">
                                    <x-input-error for="work.age_id" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center" id="preview">
                        <x-work-information-card :frontPage="$this->frontPagePath"
                            class="bg-red-300">
                            @slot('type')
                                <span x-text="type"></span>
                            @endslot
                            @slot('age')
                                <span x-text="age"></span>
                            @endslot
                        </x-work-information-card>
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
            function workForm() {
                return {
                    types: @json($types),
                    ages: @json($ages),

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
                                require: true,
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

                    get type() {
                        let type = this.types[this.data.type.content] ?? 'type';
                        return type.trim().toUpperCase();
                    },

                    get age() {
                        let age = this.ages[this.data.age.content];
                        if (age !== undefined) {
                            return age == 0 ? 'TP' : `+${age}`;
                        }
                        return 'Age';
                    },

                    submit() {
                        this.validateAllFields();
                        if (this.valid) {
                            this.$wire.submit().then(() => {
                                this.$refs.titleServerError.classList
                                    .remove('hidden');
                                this.$refs.synopsisServerError.classList
                                    .remove('hidden');
                                this.$refs.typeServerError.classList
                                    .remove('hidden');
                                this.$refs.stateServerError.classList
                                    .remove('hidden');
                                this.$refs.ageServerError.classList
                                    .remove('hidden');
                                this.focusInError();
                            })
                        }
                    },
                }
            }
        </script>
    </div>
</div>
