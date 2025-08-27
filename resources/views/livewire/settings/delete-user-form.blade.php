<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading class="text-white">{{ __('Delete account') }}</flux:heading>
        <flux:subheading class="text-white">{{ __('Delete your account and all of its resources') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <button class="btn btn-lg bg-red-600 hover:bg-red-700 text-white border-red-600" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Delete account') }}
        </button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg"
                              class="text-white">{{ __('Are you sure you want to delete your account?') }}</flux:heading>

                <flux:subheading class="text-white">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Password')" type="password" class="text-white"/>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <button
                        class="btn btn-lg bg-gray-600 hover:bg-gray-700 text-white border-gray-600">{{ __('Cancel') }}</button>
                </flux:modal.close>

                <button type="submit"
                        class="btn btn-lg bg-red-600 hover:bg-red-700 text-white border-red-600">{{ __('Delete account') }}</button>
            </div>
        </form>
    </flux:modal>
</section>
