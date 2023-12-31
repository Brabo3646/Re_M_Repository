<x-app-layout>
    <x-slot name="title">
        Re_M デッキ確認
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M デッキ確認
    </x-slot>
    <x-slot name="slot">
        <form action="{{ route('deck.check.list') }}" method="GET">
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="検索キーワードを入力">
            <input type="submit" value="検索">
        </form>
        <table border="1">
        <tr>
            <th class="deck_tablehead_name">名前</th>
            <th class="deck_tablehead_description">説明</th>
            <th class="deck_tablehead_update">更新日時</th>
            <th class="deck_tablehead_number">クイズ数</th>
            <th class="deck_tablehead_button">クイズを追加</th>
            <th class="deck_tablehead_button">デッキを消去</th>
        </tr>
            @forelse($decks as $deck)
                <tr>
                    <th class="deck_table_name">
                        <a href= "{{ route('deck.check',$deck->id) }}">
                        {{ $deck->deck_name }}
                        </a>
                    </th>
                    <th class="deck_table_description">
                        {{ $deck->description }}
                    </th>
                    <th class="deck_table_updated_at">
                        {{ $deck->updated_at }}
                    </th>
                    <th class="deck_table_question_count">
                        {{ $deck->question_count }}
                    </th>
                    <th class="deck_table_newquiz">
                        <form method = "POST" action = "{{ route('quiz.newquiz',$deck->id) }}">
                            @csrf
                             <button class="create-button">追加</button>
                        </form>
                    </th>
                    <th class="deck_table_delete">
                        <form method = "POST" action = "{{ route('deck.destroy', $deck->id) }}" onSubmit="return check()">
                            @method("DELETE")
                            @csrf
                            <button class="delete-button">削除</button>
                        </form>
                    </th>
                </tr>
            </tr>
            @empty
                <h2>デッキなし</h2>
            @endforelse
        </table>
        <script src="{{ asset('js/check_list.js') }}"></script>
    </x-slot>
</x-app-layout>