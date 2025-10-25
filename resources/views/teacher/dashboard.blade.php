<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            生徒一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($students as $student)
                        <a href="{{ route('teacher.student.logs', $student) }}"
                           class="group block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm
                                  hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full">
                                    <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition">
                                    {{ $student->name }}
                                </h3>
                            </div>

                            <p class="text-gray-600">
                                📝 学習記録:
                                <span class="inline-block ml-1 px-2 py-0.5 bg-blue-50 text-blue-700 text-sm font-semibold rounded-full">
                                    {{ $student->study_logs_count }} 件
                                </span>
                            </p>
                        </a>
                    @endforeach
                    @if($students->isEmpty())
                        <div class="col-span-3">
                            <div class="text-center py-16 border border-gray-200 rounded-2xl bg-white shadow-sm">
                                <p class="text-gray-500 text-lg">担当生徒がいません</p>
                                <p class="mt-2 text-gray-400 text-sm">生徒を追加するとここに表示されます。</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
