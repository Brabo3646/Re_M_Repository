<!--route='user.home'-->
<x-app-layout>
    <x-slot name="title">
        Re_M ホーム
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M ホーム
    </x-slot>
    <!--デッキ共有申請がきている時の画面-->
    @if(!$offered_decks->isEmpty())
        <h1>
            デッキの共有申請が来ています
        </h1>
        <table border="1">
            <tr>
                <th>申請者名</th>
                <th>名前</th>
                <th>説明</th>
                <th>クイズ数</th>
                <th>デッキを追加</th>
                <th>申請を拒否</th>
            </tr>
            @foreach($offered_decks as $offered_deck)
                <tr>
                    <th>
                        {{ $offered_deck->offer_avatar_name }}
                    </th>
                    <th class="deck_table_name">
                        {{ $offered_deck->deck_name }}
                    </th>
                    <th class="deck_table_description">
                        {{ $offered_deck->description }}
                    </th>
                    <th class="deck_table_question_count">
                        {{ $offered_deck->question_count }}
                    </th>
                    <th class="deck_table_confirm">
                        <form method = "POST" action = "{{ route('deck.offer.confirm') }}">
                            @csrf
                            <input type="hidden" name="deck_id" value ="{{$offered_deck->id}}">
                            <input type="hidden" name="user_id" value ="{{$user_id}}">
                            <button class="create-button">追加</button>
                        </form>
                    </th>
                    <th class="deck_table_refuse">
                        <form method = "POST" action = "{{ route('deck.offer.refuse') }}">
                            @csrf
                            <input type="hidden" name="deck_id" value ="{{$offered_deck->id}}">
                            <input type="hidden" name="user_id" value ="{{$user_id}}">
                            <button class="create-button">拒否</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </table>
    @endif
    <!--グループへの招待が来ているときの画面-->
    @if($invited_groups->isNotEmpty())
        <h1>
            グループへの招待が来ています
        </h1>
        <table border="1">
            <tr>
                <th>申請者名</th>
                <th>名前</th>
                <th>説明</th>
                <th>メンバー数</th>
                <th>グループに参加</th>
                <th>申請を拒否</th>
            </tr>
            @foreach($invited_groups as $invited_group)
                <tr>
                    <th>
                        {{ $invited_group->invite_avater_name }}
                    </th>
                    <th class="group_table_name">
                        {{ $invited_group->group_name }}
                    </th>
                    <th class="group_table_description">
                        {{ $invited_group->description }}
                    </th>
                    <th class="group_table_member_count">
                        {{ $invited_group->member_count }}
                    </th>
                    <th class="group_table_confirm">
                        <form method = "POST" action = "{{ route('group.invited.confirm') }}">
                            @csrf
                            <input type="hidden" name="group_id" value ="{{$invited_group->id}}">
                            <input type="hidden" name="user_id" value ="{{$user_id}}">
                            <button class="create-button">参加</button>
                        </form>
                    </th>
                    <th class="group_table_refuse">
                        <form method = "POST" action = "{{ route('group.invited.refuse') }}">
                            @csrf
                            <input type="hidden" name="group_id" value ="{{$invited_group->id}}">
                            <input type="hidden" name="user_id" value ="{{$user_id}}">
                            <button class="create-button">拒否</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </table>
    @endif
</x-app-layout>