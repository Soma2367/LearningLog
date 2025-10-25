<x-app-layout>
    <x-slot name="header">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <div class="flex items-center gap-4">
                    <a href="{{ route('student.daily_study_logs.index') }}"
                       class="text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10">
                        <x-heroicon-o-arrow-left class="h-6 w-6" />
                    </a>
                    <div>
                        <h2 class="text-3xl font-bold text-white">新しい学習記録</h2>
                    </div>
                </div>
            </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- フォームヘッダー -->
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-cyan-100 to-teal-100 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                            <x-heroicon-o-pencil-square class="w-6 h-6 text-cyan-600" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">記録フォーム</h3>
                            <p class="text-sm text-gray-600">すべての項目を入力してください</p>
                        </div>
                    </div>
                </div>

                <!-- フォーム本体 -->
                <form method="POST" action="{{ route('student.daily_study_logs.store') }}" class="p-8 space-y-6">
                    @csrf

                    <!-- タイトル -->
                    <div>
                        <label for="title" class="flex items-center font-semibold text-gray-900 mb-2">
                            <x-heroicon-o-document-text class="w-5 h-5 text-cyan-600 mr-2" />
                            タイトル
                            <span class="ml-2 text-xs font-normal text-red-500">*必須</span>
                        </label>
                        <input type="text" name="title" id="title"
                            class="w-full py-3 px-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300"
                            placeholder="例: 英語：be動詞/一般動詞"
                            value="{{old('title')}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- 学習内容 -->
                    <div>
                        <label for="content" class="flex items-center font-semibold text-gray-900 mb-2">
                            <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-cyan-600 mr-2" />
                            学習内容
                            <span class="ml-2 text-xs font-normal text-red-500">*必須</span>
                        </label>
                        <textarea name="content" id="content" rows="6"
                            class="w-full py-3 px-4 border-2 border-gray-200 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300"
                            placeholder="今日学んだ内容を詳しく書いてください。">{{old('content')}}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                    </div>

                    <!-- 学習時間と学習日 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- 学習時間 -->
                        <div>
                            <label for="study_time" class="flex items-center font-semibold text-gray-900 mb-2">
                                <x-heroicon-o-clock class="w-5 h-5 text-cyan-600 mr-2" />
                                学習時間
                                <span class="ml-2 text-xs font-normal text-red-500">*必須</span>
                            </label>
                            <input type="time" id="study_time" name="study_time"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300"
                                value="{{old('study_time')}}" />
                            <x-input-error :messages="$errors->get('study_time')" class="mt-2"/>
                        </div>

                        <!-- 学習日 -->
                        <div>
                            <label for="study_date" class="flex items-center font-semibold text-gray-900 mb-2">
                                <x-heroicon-o-calendar class="w-5 h-5 text-cyan-600 mr-2" />
                                学習日
                                <span class="ml-2 text-xs font-normal text-red-500">*必須</span>
                            </label>
                            <input type="date" id="study_date" name="study_date"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300"
                                value="{{old('study_date')}}" />
                            <x-input-error :messages="$errors->get('study_date')" class="mt-2"/>
                        </div>
                    </div>

                    <!-- 進捗評価 -->
                    <div>
                        <label for="progress_rating" class="flex items-center font-semibold text-gray-900 mb-2">
                            <x-heroicon-o-star class="w-5 h-5 text-cyan-600 mr-2" />
                            理解度（5段階評価）
                            <span class="ml-2 text-xs font-normal text-gray-500">任意</span>
                        </label>
                        <select name="progress_rating" id="progress_rating"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300 bg-white">
                            <option value="" selected>評価を選択してください</option>
                            <option value="5" class="py-2">⭐⭐⭐⭐⭐ 5 - 非常によく理解できた</option>
                            <option value="4" class="py-2">⭐⭐⭐⭐ 4 - よく理解できた</option>
                            <option value="3" class="py-2">⭐⭐⭐ 3 - まあまあ理解できた</option>
                            <option value="2" class="py-2">⭐⭐ 2 - あまり理解できなかった</option>
                            <option value="1" class="py-2">⭐ 1 - ほとんど理解できなかった</option>
                        </select>
                        <x-input-error :messages="$errors->get('progress_rating')" class="mt-2"/>
                        <p class="mt-2 text-sm text-gray-500">自分の理解度を正直に評価することで、復習の優先順位をつけやすくなります</p>
                    </div>

                    <!-- ボタンエリア -->
                    <div class="flex gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('student.daily_study_logs.index') }}"
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold text-center">
                            キャンセル
                        </a>
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white py-3 rounded-xl font-semibold shadow-lg flex items-center justify-center">
                            <x-heroicon-o-check-circle class="w-5 h-5 mr-2" />
                            記録を保存
                        </button>
                    </div>
                </form>
            </div>

            <!-- ヒントカード -->
            <div class="mt-6 bg-cyan-50 border-2 border-cyan-200 rounded-xl p-6">
                <div class="flex items-start">
                    <div class="bg-cyan-100 p-2 rounded-lg mr-4">
                        <x-heroicon-o-light-bulb class="w-6 h-6 text-cyan-600" />
                    </div>
                    <div>
                        <h4 class="font-bold text-cyan-900 mb-2">記録のコツ</h4>
                        <ul class="text-sm text-cyan-800 space-y-1">
                            <li>• 学んだことを具体的に書くと復習に役立ちます</li>
                            <li>• わからなかった点も記録しておくと、後で質問しやすくなります</li>
                            <li>• 毎日継続して記録することで、成長が見えてきます</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
