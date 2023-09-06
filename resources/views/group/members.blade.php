<x-app-layout>
    <x-slot name="title">
        Re_M 新しいグループ
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{$group->group_name}}のメンバー一覧
    </x-slot>
        <form method = "POST" action = "{{ route('add.member',$group->id) }}">
            @csrf
            <button id="add.member">メンバーを追加する</button>
        </form>
    <ol>
        @foreach($members as $member)
            <li>{{$member->avatar_name}}</li>
        @endforeach
    </ol>
</x-app-layout>