<x-app-layout>
    <x-slot name="title">
        Re_M New Deck
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M 新しいデッキを作る
    </x-slot>
    <form method = "POST" action="{{ route('deck.create')}}">
        @csrf
        <div>
            <label>
                デッキの名前
                <input type = "text" name = "deck_name" value = "{{ old('deck_name') }}">
            </label>
            @error('deck_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-group">
            <label>
                デッキの説明
                <textarea name = "description">{{ old('description') }}</textarea>
            </label>
        </div>
        <div class = "form-button">
            <input type="submit" value="作成">
        </div>
    </form>
</x-app-layout>