<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              学習の記録
            </h2>
            <x-button :href="route('student.daily_study_logs.create')" variant="primary">
                記録
            </x-button>
        </div>
    </x-slot>
</x-app-layout>
