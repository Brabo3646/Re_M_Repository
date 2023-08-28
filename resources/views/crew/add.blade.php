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
        <form action="{{ route('crew.add') }}" method="GET">
        @csrf
            <input type="text" name="search" value = "{{ old('search') }}" placeholder="追加したいアバターのIDを入力">
            <input type="submit" value="検索">
        </form>
        @if ($avater === null)
            <p>登録したいアバターのIDを入力してください。</p>
        @elseif ($avater === 'nohit')
            <p>該当するアバターは見つかりませんでした。</p>
        @else
            <table border="1">
                <tr>
                    <th>名前</th>
                    <th>ID</th>
                    <th>自己紹介文</th>
                </tr>
                <tr>
                    <th>{{$avater->avater_name}}</th>
                    <th>{{$avater->avater_ID}}</th>
                    <th>{{$avater->introduce}}</th>
                </tr>
            </table>
            <form method = "POST" action="{{ route('crew.register')}}">
                @csrf
                <input type="hidden" name="user_id" value= {{$avater->user_id}}>
                <input type="submit" value="このアバターを登録する">
            </form>
            <!--自分のアバターを検索した場合は、登録ボタンが出てこない-->
        @endif
            
            
        
    </x-slot>
</x-app-layout>