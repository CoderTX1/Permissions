<x-filament::page>
    <style>
        /* إخفاء الشريط الجانبي والتوب بار */
        aside.fi-sidebar,
        header.fi-topbar {
            display: none !important;
        }

        main.fi-main {
            margin-inline-start: 0 !important;
            padding: 0 !important;
        }

        /* جعل الصفحة كاملة الارتفاع وتوسيط المحتوى بالكامل */
        .choose-role-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f9fafb; /* لون خلفية خفيف */
        }

        .choose-role-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 0.5rem;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="choose-role-wrapper">
        <div class="choose-role-card">
            <form wire:submit.prevent="save" class="space-y-4">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold">اختيار الدور</h2>
                </div>
     
                {{ $this->form }}

                <div class="flex justify-center mt-4">
                    <button type="submit"
                        class="filament-button filament-button-size-md inline-flex items-center justify-center px-4 py-2 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset filament-button-color-primary bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 focus:ring-white border-transparent text-white focus:shadow-outline-primary">
                        دخول بهذا الدور
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-filament::page>
