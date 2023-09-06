<x-app-layout>
    <x-slot name="title">
        Re_M クルー追加
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M クルーを追加する
    </x-slot>
    <x-slot name="slot">
        @if($route = "group")
        <form action="{{ route('crew.add', "group") }}" method="GET">
        @else
        <form action="{{ route('crew.add', "share") }}" method="GET">
        @endif
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="追加したいアバターのID">
            <input type="submit" value="検索">
        </form>
        @if ($avatar === null)
            <p>登録したいアバターのIDを入力してください。</p>
        @elseif ($avatar === 'nohit')
            <p>該当するアバターは見つかりませんでした。</p>
        @else
            <table border="1">
                <tr>
                    <th>名前</th>
                    <th>ID</th>
                    <th>自己紹介文</th>
                </tr>
                <tr>
                    <th>{{$avatar->avatar_name}}</th>
                    <th>{{$avatar->avatar_ID}}</th>
                    <th>{{$avatar->introduce}}</th>
                </tr>
            </table>
            @if ($avatar->user_id === $id)
            <p>自分自身を登録することはできません。</p>
            @else
                @if($route = "group")
                    <form method = "POST" action="{{ route('crew.register', "group")}}">
                @else
                    <form method = "POST" action="{{ route('crew.register', "share")}}">
                @endif
                    @csrf
                    <input type="hidden" name="user_id" value={{$avatar->user_id}}>
                    <input type="hidden" name="route" value={{$route}}>
                    <input type="submit" value="このアバターを登録する">
                </form>
            @endif
            <!--自分のアバターを検索した場合は、登録ボタンが出てこない-->
        @endif
            
            
        
    </x-slot>
</x-app-layout>