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
        <table border="1">
        <tr>
            <th class="deck_table">名前</th>
            <th>説明</th>
        </tr>
            @foreach(Auth::user()->decks as $deck)
                <tr>
                    <th class="">
                        <a href= "{{ route('deck.check', $deck->id)}}">
                        {{ $deck->name }}
                        </a>
                    </th>
                    <th class="">
                        {{ $deck->description }}
                    </th>
                    <th class="">
                        {{ $deck->updated_at }}
                    </th>
                </tr>
            </tr>
            @endforeach
        </table>
    </x-slot>
</x-app-layout>