@props(['authorInfo' => []])

@if(!empty($authorInfo))
    <div x-show="showModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4"
         @click="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full">
            <div class="flex flex-row flex-nowrap items-start justify-between">
                <div class="flex flex-col gap-2">
                    <h3>{{ $authorInfo['name'] ?? 'huh' }} {{ !empty($authorInfo['title']) ? $authorInfo['title'] : '' }}</h3>
                    <p>
                        {{ $authorInfo['birth_date'] ?? '' }}
                        {{--                        {{ !empty($authorInfo['death_date'] ? ' - ' . $authorInfo['death_date'] : '') }}--}}
                    </p>
                </div>
                <button @click="showModal = false" class="text-gray-400 hover:text-white hover:cursor-pointer">
                    <x-icons.close/>
                </button>
            </div>
            <div class="flex flex-col gap-2 text-white mt-4">
                @if(!empty($authorInfo['bio']))
                    <p>
                        {{ $authorInfo['bio']['value'] }}
                    </p>
                @endif
                <div class="flex flex-row flex-nowrap items-center justify-between gap-2 mt-4">
                    <x-content.button styling="secondary" class="btn-xs" @click="showModal = false">
                        <x-icons.close/>
                        Close
                    </x-content.button>
                </div>
            </div>
        </div>
    </div>
@endif
