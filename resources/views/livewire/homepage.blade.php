<div>
    <h1 class="text-5xl text-white font-bold mb-5 text-center">metareadr</h1>
    <div class="p-8 bg-gray-600 rounded-2xl">
        <h2 class="text-2xl text-white font-bold mb-5">
            find books, authors, and track your reading.
        </h2>
        <form wire:submit="submit">
            <div class="flex flex-row gap-2">
                <input wire:model="query" type="text" class="w-full p-3 rounded-lg bg-gray-200"
                       placeholder="search for books, authors, and more">
                <button type="submit"
                        class="bg-teal-600 hover:bg-teal-600/60 transition cursor-pointer text-white font-bold text-center rounded px-8 py-2">
                    search
                </button>
            </div>
            @error('query')
            <span class="error">{{ $message }}</span>
            @enderror
            <div class="flex flex-row gap-4 mt-2">
                <div>
                    <input type="radio" wire:model="type" name="type" id="book" value="book">
                    <label for="book" class="text-white font-bold">Book Search</label>
                </div>
                <div>
                    <input type="radio" wire:model="type" name="type" id="author" value="author">
                    <label for="author" class="text-white font-bold">Author Search</label>
                </div>
            </div>
            @error('type')
            <span class="error">{{ $message }}</span>
            @enderror
        </form>
    </div>
</div>
