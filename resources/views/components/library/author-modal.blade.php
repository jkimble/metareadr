@props(['authorInfo' => [], 'savedAuthors' => []])
@php
    $isDbAuthor = isset($authorInfo['id']);
    $name = $authorInfo['name'] ?? '';
    $title = $authorInfo['title'] ?? '';
    $birthDate = $authorInfo['birth_date'] ?? '';
    $deathDate = $authorInfo['death_date'] ?? '';
    $bio = $isDbAuthor ? $authorInfo['bio'] : (isset($authorInfo['bio']['value']) ? $authorInfo['bio']['value'] : ($authorInfo['bio'] ?? ''));
    $photos = $isDbAuthor ? null : ($authorInfo['photos'] ?? null);
    $key = $isDbAuthor ? $authorInfo['key'] : ($authorInfo['key'] ?? '');
@endphp
@if(!empty($authorInfo))
    <div x-show="showModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4"
         @click="showModal = false; $dispatch('close-modal')"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md w-full text-white">
            <div class="flex flex-row flex-nowrap items-start justify-between">
                @if($photos && !empty($photos))
                    <img src="https://covers.openlibrary.org/a/id/{{ $photos[0] }}-M.jpg"
                         alt="{{ $name }} Cover" width="150"
                         class="max-h-[150px]" loading="lazy">
                @endif
                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-bold">{{ $name }} {{ $title ? $title : '' }}</h3>
                    <p class="text-sm italic">
                        {{ $birthDate }}
                        {{ $deathDate ? ' - ' . $deathDate : '' }}
                    </p>
                </div>
                <button @click="showModal = false; $dispatch('close-modal')"
                        class="text-gray-400 hover:text-white hover:cursor-pointer">
                    <x-icons.close/>
                </button>
            </div>
            <div class="flex flex-col gap-2 text-white mt-4">
                @if($bio)
                    <h4 class="font-bold mb-2">About {{ $name }}:</h4>
                    <p class="max-h-36 overflow-y-scroll">
                        {{ $bio }}
                    </p>
                    <span class="text-xs text-center italic">
                        Scroll for more
                        <span class="animate-bounce inline-block">
                            <x-icons.down/>
                        </span>
                    </span>
                @endif
                <div class="flex flex-row flex-nowrap items-center justify-between gap-2 mt-4">
                    @if($key)
                        <x-content.button styling="primary" class="btn-xs"
                                          wire:click="saveAuthor('{{ $key }}')"
                                          :disabled="in_array($key, $savedAuthors)">
                            <x-icons.heart/>
                            {{ in_array($key, $savedAuthors) ? 'Author in Library' : 'Add Author to Library' }}
                        </x-content.button>
                    @endif
                    <x-content.button styling="secondary" class="btn-xs"
                                      @click="showModal = false; $dispatch('close-modal')">
                        <x-icons.close/>
                        Close
                    </x-content.button>
                </div>
            </div>
        </div>
    </div>
@endif
