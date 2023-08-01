<x-app-layout>
    <x-slot name="title">
        Re_M New Deck
    </x-slot>
    <x-slot name="header">
        Re_M New Deck
    </x-slot>
    <h2>
        新しいデッキを作る
    </h2>
    <form method = "POST" action="{{ route('deck.create')}}">
        @csrf
        <div class = "mx-auto">
            <label>
                デッキの名前
                <input type = "text" name = "name" value = "{{ old('name') }}">
            </label>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-group">
            <label>
                デッキの説明
                <textarea name = "description">{{ old('description') }}</textarea>
            </label>
            <!--今のところ説明におけるエラーは想定していない-->
            <!--@error('description')-->
            <!--    <div class="error">{{ $message }}</div>-->
            <!--@enderror-->
        </div>
        <div class = "form-group">
            <label>
                <fieldset>
                    <legend>クイズのタイプ</legend>
                    <label><input type="radio" name="quiztype" value = 1>○×クイズ</label>
                    <label><input type="radio" name="quiztype" value = 2>４択クイズ</label>
                    <label><input type="radio" name="quiztype" value = 3>一問一答</label>
                </fieldset>
            </label>
        </div>
        <div class = "form-button">
            <button>作成</button>
        </div>
    </form>
</x-app-layout>