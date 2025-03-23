<div class="w-full p-4">

    
    <livewire:posts.models.post-create />



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
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                    </div>
                    </td>
                </tr>
            @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
  