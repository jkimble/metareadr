<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        showToast(message, type = 'success') {
            this.message = message;
            this.type = type;
            this.show = true;
            setTimeout(() => { this.show = false }, 3000);
        },
        init() {
            @if (session()->has('notify'))
                this.showToast('{{ session('notify')['message'] }}', '{{ session('notify')['type'] }}');
            @endif
        }
    }"
    @notify.window="showToast($event.detail.message, $event.detail.type)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed bottom-4 right-4 z-50 p-4 rounded-lg shadow-lg"
    :class="{
        'bg-success text-white': type === 'success',
        'bg-error text-white': type === 'error',
        'bg-info text-white': type === 'info',
        'bg-warning text-white': type === 'warning'
    }"
    style="display: none;"
>
    <div class="flex items-center">
        <div class="mr-2" x-show="type === 'success'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="mr-2" x-show="type === 'error'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <div class="mr-2" x-show="type === 'info'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="mr-2" x-show="type === 'warning'">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <span x-text="message"></span>
    </div>
</div>
