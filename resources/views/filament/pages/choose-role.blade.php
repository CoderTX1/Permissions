<x-filament::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}

        <div class="flex justify-start mt-4">
            <button type="submit" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button-color-primary bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 focus:ring-white border-transparent text-white focus:shadow-outline-primary">
                دخول بهذا الدور
            </button>
        </div>
    </form>
</x-filament::page>