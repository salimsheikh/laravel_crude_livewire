<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

new class extends Component {
    public $files;
    public $message = '';

    public function mount(){
        $this->loadFiles();
    }

    // Load backup files from the storage "backup" folder
    public function loadFiles()
    {
        $this->files = collect(Storage::files("backup"))
            ->sortByDesc(function ($file) {
                return Storage::lastModified($file);
            })
            ->values()
            ->all();
    }

    // Download the selected backup file
    public function download($file){
        \Log::info($file);
        return Storage::download($file);
    }

    public function delete($file){
        \Log::info($file);
        Storage::delete($file);

        // Refresh the backup files list
        $this->loadFiles();
    }

    public function backup(){
        try {
            // Run the backup command (using Spatie's backup or your custom logic)
            Artisan::call('app:dbbackup');

            $this->message = 'Database backup completed successfully!';

            // Refresh the backup files list
            $this->loadFiles();

            // Optionally, emit an event if other components need to listen
            $this->emit('gridRefresh');

            // Emit an event to refresh the grid
            $this->emit('mount');
        } catch (\Exception $e) {
            $this->message = 'Backup failed: ' . $e->getMessage();
        }
    }
}; ?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('DB Backups')" :subheading=" __('List of all backup files.')">

        <!-- Status Message with Auto-hide via Alpine.js -->
        @if($message)
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                class="mt-4 mb-3 p-2 bg-green-200 text-green-800 rounded transition duration-300"
            >
                {{ $message }}
            </div>
        @endif

        <div class="flex justify-end mb-3">
            <flux:button size="xs" wire:click="backup">Create Backup</flux:button>
        </div>

        <!-- Backup Files Grid -->
        <table class="w-full border-collapse border border-gray-300 shadow-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Files</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Download</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{ basename($file) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <flux:button size="xs" wire:click="download('{{ $file }}')">Download</flux:button>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <flux:button variant="danger" size="xs" wire:click="delete('{{ $file }}')">Delete</flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-settings.layout>
</div>
