<div class="w-full p-4">
    <livewire:posts.modals.post-create />
    <livewire:posts.modals.post-edit />

    <flux:modal name="post-delete" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Post?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this posts.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="destroy">Delete Post</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Create Post Button -->
    <div class="flex justify-end mb-4">
        <flux:modal.trigger name="post-create">
            <flux:button>Create Post</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full bg-white border border-gray-200 rounded-xl shadow">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 border-b text-left text-gray-700 font-semibold">ID</th>
            <th class="px-6 py-3 border-b text-left text-gray-700 font-semibold">Title</th>
            <th class="px-6 py-3 border-b text-left text-gray-700 font-semibold">Content</th>
            <th class="px-6 py-3 border-b text-center text-gray-700 font-semibold">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 border-b">{{ $post->id }}</td>
                    <td class="px-6 py-3 border-b">{{ $post->title }}</td>
                    <td class="px-6 py-3 border-b">{{ $post->content }}</td>
                    <td class="px-6 py-3 border-b text-center">
                    <div class="flex items-center justify-center gap-2">
                        <flux:button size="xs" wire:click="edit({{ $post->id }})">Edit</flux:button>
                        <flux:button variant="danger" size="xs" wire:click="delete({{ $post->id }})">Delete</flux:button>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
