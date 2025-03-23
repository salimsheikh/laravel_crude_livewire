<x-layouts.app :title="__('Posts')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Post') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your all the posts.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <livewire:posts.posts />
</x-layouts.app>
