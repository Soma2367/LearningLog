<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フィードバック
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- 戻る -->
            <div class="mb-4">
                <a href="{{ route('teacher.student.logs', $log->student_id) }}"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $log->student->name }}さんの記録一覧に戻る
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- 学習記録詳細 -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $log->title }}</h3>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                            <span>👤 {{ $log->student->name }}</span>
                            <span>📅 {{ $log->study_date->format('Y年m月d日') }}</span>
                            <span>⏱️ {{ $log->formatted_study_time }}</span>
                            <span>⭐ 自己評価: {{ $log->progress_rating }}/5</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold mb-2 text-gray-700">📝 学習内容</h4>
                            <p class="whitespace-pre-wrap text-gray-700 leading-relaxed">{{ $log->content }}</p>
                        </div>
                    </div>

                    <!-- フォーム -->
                    <form action="{{ route('teacher.feedback.store', $log) }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="teacher_feedback" class="block text-sm font-semibold text-gray-700 mb-2">
                                フィードバック <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="teacher_feedback"
                                id="teacher_feedback"
                                rows="8"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="生徒へのフィードバックを入力してください"
                                required
                            >{{ old('teacher_feedback', $log->teacher_feedback) }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">最大1000文字</p>
                        </div>

                        <div class="flex gap-4">
                            <button
                                type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow-md transition">
                                {{ $log->hasFeedback() ? 'フィードバックを更新' : 'フィードバックを送信' }}
                            </button>

                            <a href="{{ route('teacher.student.logs', $log->student_id) }}"
                               class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold transition">
                                キャンセル
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
