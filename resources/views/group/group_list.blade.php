<x-app-layout>
    <x-slot name="title">
        Re_M グループ一覧
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M グループ一覧
    </x-slot>
    <x-slot name="slot">
        <a href={{route('group.newgroup')}}><button>新しいグループを作成する</button></a>
        @if(!$groups->isEmpty())
            <table border="1">
            <tr>
                <th>グループ名</th>
                <th>説明</th>
                <th>メンバー数</th>
                <th>メンバー追加</th>
                <th>共有デッキ一覧</th>
            </tr>
        @endif
            @forelse($groups as $group)
                <tr>
                    <th id="group_table_name">
                        {{ $group->group_name }}
                        </a>
                    </th>
                    <th id="group_table_description">
                        {{ $group->description }}
                    </th>
                    <th id="group_table_member_count">
                             {{ $group->member_count }}人
                    </th>
                    <th>
                        <form method = "POST" action = "{{ route('group.members',$group->id) }}">
                            @csrf
                             <button id="group_button">追加</button>
                        </form>
                    </th>
                    <th id="group_table_decks">
                        <form method = "POST" action = "{{ route('group.decks',$group->id) }}">
                            @csrf
                             <button id="group_button">確認</button>
                        </form>
                    </th>
                </tr>
            </tr>
            @empty
                <h2>グループに所属していません</h2>
            @endforelse
        </table>
    </x-slot>
</x-app-layout>