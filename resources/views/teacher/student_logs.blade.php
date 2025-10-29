<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $student->name }}さんの学習記録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- 戻るボタン -->
            <div class="mb-4">
               <a href="{{ route('teacher.dashboard') }}"
                  class="inline-flex items-center px-5 py-3  border border-transparent rounded-lg font-semibold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                   戻る
               </a>
            </div>
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($logs as $log)
                    <div class="mb-6 p-5 border rounded-lg hover:shadow-md transition">
                        <!-- ヘッダー -->
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $log->title }}</h3>
                                <p class="text-sm text-gray-600">
                                    📅 {{ $log->study_date->format('Y年m月d日') }} |
                                    ⏱️ {{ $log->formatted_study_time }} |
                                    ⭐ 自己評価: {{ $log->progress_rating }}/5
                                </p>
                            </div>
                            <a href="{{ route('teacher.feedback.show', $log) }}"
                               class="ml-4 px-4 py-2 {{ $log->hasFeedback() ? 'bg-gray-500' : 'bg-blue-500' }} text-white rounded hover:opacity-90 transition text-sm whitespace-nowrap">
                                {{ $log->hasFeedback() ? 'フィードバック編集' : 'フィードバックする' }}
                            </a>
                        </div>

                        <!-- 学習内容 -->
                        <div class="mb-3 p-3 bg-gray-50 rounded">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $log->content }}</p>
                        </div>

                        <!-- フィードバック表示 -->
                        @if($log->hasFeedback())
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-3">
                            <p class="text-sm font-semibold text-blue-800 mb-1">✏️ あなたのフィードバック</p>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $log->teacher_feedback }}</p>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-16 text-gray-500">
                        <p class="text-lg">まだ学習記録がありません</p>
                    </div>
                    @endforelse

                    <!-- ページネーション -->
                    <div class="mt-6">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
