<x-app-layout>
    <x-slot name="title">
        Re_M {{$group->group_name}}共有デッキ一覧
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{$group->group_name}}共有デッキ一覧
    </x-slot>
    <x-slot name="slot">
        <form method = "POST" action = "{{ route('group.share.list') }}">
            @csrf
            <input type="hidden" name="group_id" value="{{$group->id}}">
            <button id="group_button">自身のデッキを共有する</button>
        </form>
        @if(!$decks->isEmpty())
            <table border="1">
            <tr>
                <th>名前</th>
                <th>説明</th>
                <th>更新日時</th>
                <th>クイズ数</th>
                <th>デッキを自身のライブラリに追加</th>
            </tr>
        @endif
            @forelse($decks as $deck)
                <tr>
                    <th id="group_table_name">
                        {{ $deck->deck_name }}
                        </a>
                    </th>
                    <th id="group_table_description">
                        {{ $deck->description }}
                    </th>
                    <th id="group_table_member_count">
                        {{ $deck->updated_at }}
                    </th>
                    <th class="deck_table_question_count">
                        {{ $deck->question_count }}
                    </th>
                    <th>
                        <form method = "POST" action = "{{ route('deck.group.add',$deck->id) }}">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <button id="group_button">追加</button>
                        </form>
                    </th>
                </tr>
            </tr>
            @empty
                <h2>グループにまだデッキが共有されていません</h2>
            @endforelse
        </table>
    </x-slot>
</x-app-layout>