<x-app-layout>
    <x-slot name="header">
        　Re_M ホーム
    </x-slot>
    <h1>
        こんにちは！{{ Auth::user()->name }}さん
    </h1>
</x-app-layout>