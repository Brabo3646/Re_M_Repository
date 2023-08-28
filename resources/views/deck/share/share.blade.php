<x-app-layout>
    <x-slot name="title">
        Re_M デッキ共有
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{ $deck->deck_name }} の共有相手を選ぶ
    </x-slot>
    <x-slot name="slot">
        <a href={{route('crew.add')}}><button>クルーを追加する</button></a>
        <h1>デッキを共有する相手を選択してください。</h1>
        <ul>
            @forelse($avaters as $avater)
                
                <li class="crew_name">
                    <form method = "POST" action="{{ route('deck.share.confirm')}}">
                        @csrf
                        <input type ="hidden" name="deck_id" value ="{{$deck->id}}">
                        <input type ="hidden" name="user_id" value ="{{$avater->user_id}}">
                        <input type ="submit" value="{{ $avater->avater_name }}">
                    </form>
                </li>
            @empty
            <h2>
                登録されているクルーがいません...上のボタンから登録してみましょう！
            </h2>
            @endforelse
        </ol>
    </x-slot>
</x-app-layout>