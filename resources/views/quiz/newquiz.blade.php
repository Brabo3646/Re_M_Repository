<x-app-layout>
    <x-slot name="title">
        Re_M New Quiz
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M {{$deck->deck_name}}の新しいクイズを作る
    </x-slot>
    <form method = "POST" action="{{ route('quiz.create') }}">
        @csrf
        <input type = "hidden" name = "deck_id" value = {{$deck->id}}>
        <input type = "hidden" name = "question_count" value = {{$deck->question_count}}>
        <div>
            <label>
                クイズの問い
                <input type = "text" name = "question" value = "{{ old('question') }}">
            </label>
            @error('question')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                クイズの解答
                <input type = "text" name = "answer" value = "{{ old('answer') }}">
            </label>
            @error('answer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-button">
            <input type="submit" value="作成">
        </div>
    </form>
</x-app-layout>