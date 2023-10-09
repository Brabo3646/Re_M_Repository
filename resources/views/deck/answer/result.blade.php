<x-app-layout>
    <x-slot name="title">
        Re_M Result
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M 結果発表
    </x-slot>
    <x-slot name="slot">
    <table border="1">
        <tr>
            <th>番号</th>
            <th>問い</th>
            <th>解答</th>
            <th>正解/誤答</th>
            <th>正解回数</th>
            <th>誤答回数</th>
        </tr>
        @foreach($quizzes as $quiz)
            <tr>
                <th>
                    {{ $quiz->question_number }}
                </th>
                <th>
                    {{ $quiz->question }}
                </th>
                <th>
                    {{ $quiz->answer }}
                </th>
                    @if($quiz->pivot->latest_correct > $quiz->pivot->latest_error)
                    <th id="correct">
                        正解
                    </th>
                    @else
                    <th id="error">
                        誤答
                    </th>
                    @endif
                </th>
                <th>
                    {{ $quiz->pivot->correct_count }}
                </th>
                <th>
                    {{ $quiz->pivot->error_count }}
                </th>
            </tr>
        @endforeach
    </table>
    </x-slot>
</x-app-layout>