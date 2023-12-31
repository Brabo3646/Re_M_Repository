<x-app-layout>
    <x-slot name="title">
        Re_M デッキ一覧
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M デッキ一覧
    </x-slot>
    <x-slot name="slot">
        <form action="{{ route('deck.answer.list') }}" method="GET">
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="検索キーワードを入力">
            <input type="submit" value="検索">
        </form>
        <table border="1">
            <tr>
                <th class="deck_tablehead_name">名前</th>
                <th class="deck_tablehead_description">説明</th>
                <th class="deck_tablehead_button">クイズを解く</th>
                <th class="deck_tablehead_update">更新日時</th>
                <th class="deck_tablehead_number">クイズ数</th>
            </tr>
            @forelse($decks as $deck)
                <tr>
                    <th class="deck_table_name">
                        {{ $deck->deck_name }}
                    </th>
                    <th class="deck_table_description">
                        {{ $deck->description }}
                    </th>
                    <th>
                        <form action="{{ route('deck.answer', $deck->id) }}" method="POST">
                            <button>解く</button>
                            @csrf
                        </form>
                    </th>
                    <th class="deck_table_updated_at">
                        {{ $deck->updated_at }}
                    </th>
                    <th class="deck_table_question_count">
                        {{ $deck->question_count }}
                    </th>
                </tr>
            </tr>
            @empty
                <h2>デッキなし</h2>
            @endforelse
        </table>
    </x-slot>
</x-app-layout>