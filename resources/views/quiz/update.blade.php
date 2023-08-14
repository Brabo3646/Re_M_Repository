<x-app-layout>
    <x-slot name="title">
        Re_M New Quiz
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{$quiz->question}}の新しいクイズを作る
    </x-slot>
</x-app-layout>