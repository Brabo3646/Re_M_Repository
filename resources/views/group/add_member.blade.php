<x-app-layout>
    <x-slot name="title">
        Re_M メンバー追加
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{ $group->group_name }} に追加するクルーを選ぶ
    </x-slot>
    <x-slot name="slot">
        <a href={{route('crew.add',"group")}}><button>クルーを追加する</button></a>
        <h1>グループに招待するクルーを選択してください。</h1>
        <ul>
            @forelse($listed_crews as $crew)
                <li class="crew_name">
                    <form method = "POST" action="{{ route('add.member.confirm')}}">
                        @csrf
                        <input type ="hidden" name="group_id" value ="{{$group->id}}">
                        <input type ="hidden" name="user_id" value ="{{$crew->user_id}}">
                        <input type ="submit" value="{{ $crew->avatar_name }}">
                    </form>
                </li>
            @empty
            <h2>
                登録されているクルーがいないか、あなたのクルーは全員加盟済みです！
            </h2>
            @endforelse
        </ol>
    </x-slot>
</x-app-layout>