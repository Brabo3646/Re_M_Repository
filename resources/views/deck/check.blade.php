<x-app-layout>
    <x-slot name="title">
        Re_M デッキの内容を確認
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M デッキの内容を確認
    </x-slot>
    <x-slot name="slot">
        <form action="{{ route('deck.check',$id) }}" method="GET">
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="検索キーワードを入力">
            <input type="submit" value="検索">
        </form>
        <table border="1">
        <tr>
            <th>番号</th>
            <th>問い</th>
            <th>解答</th>
            <th>更新日時</th>
            <th>修正する</th>
            <th>削除する</th>
            <th>最後に正解/誤答した日時</th>
            <th>正解回数</th>
            <th>誤答回数</th>
            
        </tr>
            @forelse($quizzes as $quiz)
                <tr>
                    <th>
                        {{ $quiz->question_number }}
                    </th>
                    <th>
                        {{ $quiz->question }}
                    </th>
                    <th>
                        {{ $quiz->answer }}
                    </th>
                    <th>
                        {{ $quiz->updated_at }}
                    </th>
                    <th>
                        <form method = "POST" action = "{{ route('quiz.edit', $quiz->id) }}">
                            @csrf
                             <button class="create-button">修正</button>
                        </form>
                    </th>
                    <th>
                        <form method = "POST" action = "{{ route('quiz.destroy', $quiz->id) }}">
                            @method("DELETE")
                            @csrf
                            <button class="delete-button">削除</button>
                        </form>
                    </th>
                        @if ($quiz->latest_correct > $quiz->latest_error)
                            <th class = 'correct'>
                                {{ $quiz->latest_correct }}
                            </th>
                        @elseif ($quiz->latest_error > $quiz->latest_correct)
                            <th class = 'error'>
                                {{ $quiz->latest_error }}
                            </th>
                        @else
                            <th class = 'unanswered'>
                                未解答
                            </th>
                        @endif
                    <th>
                        {{ $quiz->correct_count }}
                    </th>
                    <th>
                        {{ $quiz->error_count }}
                    </th>  
                </tr>
            </tr>
            @empty
                <h2>クイズなし</h2>
            @endforelse
        </table>
    </x-slot>
</x-app-layout>