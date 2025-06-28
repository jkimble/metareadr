@props(['book'])
<div x-show="showModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">
    <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">{{ $book['title'] ?? 'Untitled' }}</h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-white hover:cursor-pointer">
                <x-icons.close/>
            </button>
        </div>
        <div class="mt-4 flex justify-end">
            <x-content.button styling="secondary" class="btn-xs" @click="showModal = false">
                Close
            </x-content.button>
        </div>
    </div>
</div>
