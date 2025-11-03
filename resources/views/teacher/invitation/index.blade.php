<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            生徒招待
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- フォームヘッダー -->
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">招待コード</h3>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('student.daily_study_logs.store') }}" class="p-8 space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="flex items-center font-semibold text-gray-900 mb-2">
                            <x-heroicon-o-document-text class="w-5 h-5 text-cyan-600 mr-2" />
                            送信先メールアドレス
                            <span class="ml-2 text-xs font-normal text-red-500">*必須</span>
                        </label>
                        <input type="mail" name="title" id="title"
                            class="w-full py-3 px-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent hover:border-gray-300"
                            placeholder="someone@gmail.com"
                            value="{{old('title')}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>
                    <div class="flex justify-center">
                        <button
                          type="button"
                          class="inline-flex items-center px-5 py-3  border border-transparent rounded-lg font-semibold text-base text-white uppercase tracking-widest bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            送信
                        </button>
                    </div>
        </div>
    </div>
</x-app-layout>
