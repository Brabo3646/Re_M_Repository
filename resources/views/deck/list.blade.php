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
        <form action="{{ route('deck.list') }}" method="GET">
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="検索キーワードを入力">
            <input type="submit" value="検索">
        </form>
        <table border="1">
        <tr>
            <th class="deck_table">名前</th>
            <th>説明</th>
            <th>更新日時</th>
        </tr>
            @forelse($decks as $deck)
                <tr>
                    <th class="deck_table_name">
                        <a href= "{{ route('deck.check', $deck->id)}}">
                        {{ $deck->deck_name }}
                        </a>
                    </th>
                    <th class="deck_table_description">
                        {{ $deck->description }}
                    </th>
                    <th class="deck_table_updated_at">
                        {{ $deck->updated_at }}
                    </th>
                </tr>
            </tr>
            @empty
                <h2>デッキなし</h2>
            @endforelse
        </table>
    </x-slot>
</x-app-layout>