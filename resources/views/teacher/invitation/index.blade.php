<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            生徒招待
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 my-4">

            @if(session('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
                {{ session('success') }}
              </div>
            @endif
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">新しい招待コード</h3>
                </div>

                <div class="px-8 py-6" >
                    <form action="{{ route('teacher.invitation.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-cyan-500 text-white px-6 py-3 rounded-lg hover:from-cyan-600 hover:to-teal-600 transition">
                            コード生成
                        </button>
                    </form>
                </div>

                 <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">招待コード一覧</h3>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse($invitations as $invitation)
                        <div class="px-8 py-4 flex items-center justify-between">
                            <div>
                                <p class="font-mono text-2xl font-bold text-gray-900">
                                    {{ $invitation->code }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    作成日時: {{ $invitation->created_at->format('Y年m月d日 H:i') }}
                                </p>
                            </div>

                            <div class="text-right">
                                @if($invitation->used)
                                    <span class="inline-block bg-gray-100 text-gray-600 px-4 py-2 rounded-full text-sm">
                                        使用済み
                                    </span>
                                    @if($invitation->student)
                                        <p class="text-xs text-gray-500 mt-1">
                                            使用者: {{ $invitation->student->user->name }}
                                        </p>
                                    @endif
                                @else
                                    <span class="inline-block bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                        未使用
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="px-8 py-12 text-center text-gray-500">
                            招待コードがまだありません
                        </div>
                    @endforelse
                </div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
