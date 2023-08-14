<x-app-layout>
    <x-slot name="title">
        Re_M Edit Quiz
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M クイズの編集
    </x-slot>
    <form method = "POST" action="{{ route('quiz.update', $quiz->id) }}">
        @method('PATCH')
        @csrf
        <div>
            <label>
                クイズの問い
                <input type = "text" name = "question" value = "{{ old('question', $quiz->question) }}">
            </label>
            @error('question')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                クイズの解答
                <input type = "text" name = "answer" value = "{{ old('answer', $quiz->answer) }}">
            </label>
            @error('answer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-button">
            <input type="submit" value="更新">
        </div>
    </form>
</x-app-layout>