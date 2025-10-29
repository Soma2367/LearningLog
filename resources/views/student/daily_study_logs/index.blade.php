<x-app-layout>
    <!-- ヘッダー -->
    <x-slot name="header">
        <div class="bg-gradient-to-r from-cyan-600 to-teal-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-white">学習記録</h1>
                            <p class="text-cyan-100 mt-1">継続は力なり - 今日も頑張りましょう！</p>
                        </div>
                        <a href="{{ route('student.daily_study_logs.create') }}"
                           class="bg-white text-cyan-600 px-6 py-3 rounded-xl hover:bg-cyan-50 transition-all transform hover:scale-105 font-semibold shadow-lg">
                            <x-heroicon-o-plus-circle class="w-5 h-5 inline mr-2" />
                            新しい記録を追加
                        </a>
                    </div>

                    <!-- 統計カード -->
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-cyan-100 text-sm">総学習時間</p>
                                    <p class="text-2xl font-bold text-white">
                                        {{ $totalHour }}時間{{ $remainingMin > 0 ? $remainingMin . '分' : '' }}
                                    </p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-lg">
                                    <x-heroicon-s-clock class="w-6 h-6 text-white" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-cyan-100 text-sm">平均評価</p>
                                    <p class="text-2xl font-bold text-white">{{ number_format($logs->avg('progress_rating'), 1) }}</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-lg">
                                    <x-heroicon-s-star class="w-6 h-6 text-white" />
                                </div>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-cyan-100 text-sm">連続記録</p>
                                    <p class="text-2xl font-bold text-white">{{ $consecutiveDays }}日</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-lg">
                                    <x-heroicon-s-fire class="w-6 h-6 text-white" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- メインコンテンツ -->
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            @if($logs->isEmpty())
                <!-- 空状態 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-br from-cyan-50 to-teal-50 px-8 py-12">
                        <div class="max-w-md mx-auto text-center">
                            <div class="bg-gradient-to-br from-cyan-100 to-teal-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <x-heroicon-o-academic-cap class="w-12 h-12 text-cyan-600" />
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">学習記録を始めましょう</h2>
                            <p class="text-gray-600 mb-8">毎日の学習を記録して、成長を実感しましょう。<br>目標達成への第一歩を踏み出そう！</p>
                            <a href="{{ route('student.daily_study_logs.create') }}"
                               class="inline-flex items-center bg-gradient-to-r from-cyan-600 to-teal-600 text-white px-8 py-4 rounded-xl hover:from-cyan-700 hover:to-teal-700 transition-all transform hover:scale-105 font-semibold shadow-lg">
                                <x-heroicon-o-sparkles class="w-5 h-5 mr-2" />
                                最初の記録を作成
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- カードグリッド -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($logs as $log)
                        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
                            <!-- カードヘッダー -->
                            <div class="relative h-32 bg-gradient-to-br from-cyan-400 via-cyan-500 to-teal-600 p-6">
                                <!-- 背景装飾 -->
                                <div class="absolute inset-0 opacity-20">
                                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white rounded-full"></div>
                                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full"></div>
                                </div>

                                <!-- 日付 -->
                                <div class="relative z-10">
                                    <p class="text-white/80 text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($log->study_date)->format('Y年') }}
                                    </p>
                                    <p class="text-white text-2xl font-bold">
                                        {{ \Carbon\Carbon::parse($log->study_date)->format('n月j日') }}
                                    </p>
                                </div>

                                <!-- 評価バッジ -->
                                <div class="absolute top-6 right-6 bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-full flex items-center">
                                    <x-heroicon-s-star class="w-4 h-4 text-yellow-300 mr-1" />
                                    <span class="text-white font-semibold text-sm">{{ $log->progress_rating }}.0</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- タイトル -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-cyan-600 transition-colors">
                                    {{ $log->title }}
                                </h3>

                                <!-- 内容 -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                    {{ $log->content }}
                                </p>

                                <!-- メタ情報 -->
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex items-center bg-gray-50 px-3 py-1.5 rounded-lg">
                                        <x-heroicon-o-clock class="w-4 h-4 text-gray-400 mr-1.5" />
                                        <span class="text-sm font-medium text-gray-700">{{ $log->study_time }}</span>
                                    </div>

                                    @if($log->teacher_feedback)
                                        <div class="flex items-center bg-green-50 px-3 py-1.5 rounded-lg">
                                            <x-heroicon-s-chat-bubble-left-right class="w-4 h-4 text-green-500 mr-1.5" />
                                            <span class="text-sm font-medium text-green-700">フィードバック</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- プログレスバー -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs text-gray-500">理解度</span>
                                        <span class="text-xs font-medium text-gray-700">{{ $log->progress_rating * 20 }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-cyan-500 to-teal-500 h-2 rounded-full transition-all duration-500"
                                        ></div>
                                    </div>
                                </div>

                                <!-- アクションボタン -->
                                <div class="flex gap-2 pt-4 border-t border-gray-100">
                                    <a href="{{ route('student.daily_study_logs.show', $log) }}"
                                       class="flex-1 bg-cyan-50 hover:bg-cyan-100 text-cyan-700 py-2.5 rounded-lg font-medium text-sm text-center transition-colors">
                                        詳細を見る
                                    </a>
                                </div>
                            </div>

                            <!-- フィードバックプレビュー -->
                            @if($log->teacher_feedback)
                                <div class="px-6 pb-4">
                                    <div class="bg-gradient-to-r from-cyan-50 to-teal-50 rounded-xl p-4 border border-cyan-200">
                                        <div class="flex items-start">
                                            <div class="bg-cyan-100 p-2 rounded-lg mr-3">
                                                <x-heroicon-s-user class="w-4 h-4 text-cyan-600" />
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-xs font-semibold text-cyan-700 mb-1">先生からのフィードバック</p>
                                                <p class="text-sm text-gray-700 line-clamp-2">
                                                    {{ $log->teacher_feedback }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            @endif
        </div>

        <div class="flex justify-center mt-12 mb-8">
          {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
