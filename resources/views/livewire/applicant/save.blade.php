<div x-data="{
    validAlias: true,

    get valid() {
        return this.validAlias;
    },

    data: {
        alias: {
            content: @entangle('applicant.alias').defer,
            rules: {
                max: 50,
                min: 4,
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
    },

    validateAllFields() {
        this.validAlias = validation(this.data.alias, 'alias');
    },

    submit() {
        this.validateAllFields();
        if (this.valid) {
            this.$wire.submit().then(() => {
                this.focusInError();
            });
        }
    },
}">
    <x-button wire:click.prevent="$toggle('show')">Be author</x-button>
    <x-dialog-modal wire:model="show">
        @slot('title')
            {{ __('Apply to be Author') }}
        @endslot
        @slot('content')
            <x-form submit="submit">
                @slot('form')
                    <div class="col-span-6">
                        <div>
                            <x-label for="alias">Alias</x-label>
                            <x-input id="alias" type="text" name="alias"
                                class="block w-full {{ $errors->any() ? 'is-invalid' : '' }}"
                                x-model.debounce.500ms="data.alias.content"
                                @input="$refs.aliasServerError.classList.add('hidden')" />
                        </div>
                        <div>
                            <x-input-error-client message="data.alias.error"
                                x-show="!validAlias" />
                            <div x-ref="aliasServerError">
                                <x-input-error for="applicant.alias" />
                                <x-input-error for="applicant.user_id" />
                                @if (!$errors->has('applicant.alias'))
                                    <x-input-error for="applicant.slug" />
                                @endif
                            </div>
                        </div>
                    </div>
                @endslot
            </x-form>
            <p class="text-sm text-gray-500 pl-4 pt-1">
                *{{ __('If you do not introduce an alias, your username will be used') }}
            </p>
        @endslot
        @slot('footer')
            <x-secondary-button wire:click="$toggle('show')">
                {{ __('Cancel') }}
            </x-secondary-button>
            {{-- TODO: no cambia de aspecto cuando esta disabled --}}
            <x-button @click.prevent="submit" wire:loading.attr="disabled"
                x-bind:disabled="!valid">
                {{ __('Submit') }}
            </x-button>
        @endslot
    </x-dialog-modal>
    @once
        <script src="{{ asset('js/validator.js') }}"></script>
    @endonce
</div>
