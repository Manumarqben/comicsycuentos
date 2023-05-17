<div x-data="{
    show: false,
    message: '',
    type: '',
    timerId: null,
}"
    x-on:alert.window="
        if (timerId !== null) {
            clearTimeout(timerId);
        }
        show = true; 
        message = $event.detail.message;
        type = $event.detail.type || 'success';
        timerId = setTimeout(() => show = false, 2000);
    "
    class="text-md text-gray-600 fixed bottom-7 left-0 w-2/3 sm:w-1/3 z-50">
    <div x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-x-96"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-96"
        x-transition:leave="transition ease-in duration-200"
        x-bind:class="{
            'alert': true,
            'alert-success': type === 'success',
            'alert-danger': type === 'danger',
            'alert-warning': type === 'warning',
            'alert-warning': type === 'info',
        }"
        style="display: none;">
        <span class="block sm:inline" x-text="message"></span>
        <div class="ml-2 flex items-center">
            <template x-if="type === 'success'">
                <x-icon.check-circle />
            </template>
            <template x-if="type === 'danger'">
                <x-icon.x-circle />
            </template>
            <template x-if="type === 'warning'">
                <x-icon.exclamation-triangle />
            </template>
            <template x-if="type === 'info'">
                <x-icon.information-circle />
            </template>
        </div>
    </div>
</div>
