<flux:modal name="post-create"  class="max-w-3xl w-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Create Post</flux:heading>
            <flux:text class="mt-2">Add details of post.</flux:text>
        </div>

        <flux:input wire:model="title" label="Post Title" placeholder="Post title" />

        <flux:textarea wire:model="content" label="Post Content" placeholder="Post Content" />

        <div class="flex">
            <flux:spacer />

            <flux:button type="submit" variant="primary" wire:click="submit">Create Post</flux:button>
        </div>
    </div>
</flux:modal>
