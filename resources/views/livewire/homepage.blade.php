<div>
    <div class="p-8 bg-transparent rounded-2xl border-2 border-teal-500">
        <h2 class="text-2xl text-white font-bold mb-1">
            find authors, books, and track your reading
        </h2>
        <p class="text-white font-sm mb-5">
            save authors and their works to your library for later
        </p>
        <form wire:submit="submit">
            <div class="flex flex-row gap-2">
                <input wire:model="query" type="text"
                       class="w-full p-3 rounded-lg border border-teal-500 text-white focus:border-white transition"
                       placeholder="search for books, authors, and more">
                <button type="submit" class="btn btn-lg btn-primary">
                    <x-icons.book-search/>
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
            <div class="flex flex-row gap-4 mt-4" x-show="$wire.type === 'book'" x-transition.opacity>
                <div class="flex-col">
                    <label for="author" class="font-bold italic text-sm text-white">Author</label>
                    <input type="text" name="author" wire:model="author"
                           class="w-full p-3 rounded-lg max-w-64 border border-teal-500 text-white focus:border-white transition"
                           placeholder="search for books by author">
                </div>
            </div>
        </form>
    </div>
</div>
