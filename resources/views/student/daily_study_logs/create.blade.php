<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('student.daily_study_logs.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-o-arrow-left class="h-5 w-5" />
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">記録</h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <form method="POST" action="{{ route('student.daily_study_logs.store') }}" class="space-y-4">
                @csrf

                <!-- タイトル -->
                <div>
                    <label for="title" class="font-semibold mb-1 block text-gray-700">タイトル</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    <input type="text" name="title" id="title"
                        class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        placeholder="タイトルを入力してください"
                        value="{{old('title')}}">
                </div>

                <!-- 学習内容 -->
                <div>
                    <label for="content" class="font-semibold mb-1 block text-gray-700">学習内容</label>
                    <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                    <textarea name="content" id="content" rows="5"
                        class="w-full py-2 px-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        placeholder="今日学んだ内容を入力してください" value="{{old('content')}}"></textarea>
                </div>

                <!-- 学習時間 -->
                <div>
                    <label for="study_time" class="font-semibold mb-1 block text-gray-700">学習時間</label>
                     <x-input-error :messages="$errors->get('study_time')" class="mt-2"/>
                    <input type="time" id="study_time" name="study_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                </div>

                <!-- 学習日 -->
                <div>
                    <label for="study_date" class="font-semibold mb-1 block text-gray-700">学習日</label>
                     <x-input-error :messages="$errors->get('study_date')" class="mt-2"/>
                    <input type="date" id="study_date" name="study_date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                </div>

                <!-- 進捗評価 -->
                <div>
                    <label for="progress_rating" class="font-semibold mb-1 block text-gray-700">理解度（5段階）</label>
                     <x-input-error :messages="$errors->get('progress_rating')" class="mt-2"/>
                    <select name="progress_rating" id="progress_rating"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        <option value="" selected>評価を選択してください</option>
                        <option value="5">5 - 非常に良い</option>
                        <option value="4">4 - 良い</option>
                        <option value="3">3 - 普通</option>
                        <option value="2">2 - 悪い</option>
                        <option value="1">1 - 非常に悪い</option>
                    </select>
                </div>

                <!-- ボタン -->
                <div class="flex justify-center pt-4">
                    <x-button type="submit" variant="primary" class="px-10 py-2 text-base">
                        記録
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
