<x-app-layout>
    <x-slot name="title">
        Re_M Answer
    </x-slot>
    <x-slot name="stylesheet">
        answer.css
    </x-slot>
    <x-slot name="header">
        Re_M クイズを解く！
    </x-slot>
    <x-slot name="slot">
        <p id = "quiz_count" class = hidden>{{ $quiz_count }}</p>
        <p id = "deck_id" class = hidden>{{ $deck_id }}</p>
        <section id = "front">
            @foreach($quizzes as $quiz)
            <h1 class = "question_{{ $loop->iteration }} hidden_question">{{ $loop->iteration }}/{{ $quiz_count }} 問目</h1>
            <h1 class = "question_{{ $loop->iteration }} hidden_question">Q.{{$quiz->question}}</h1>
            @endforeach
        </section>
        <section id="check-answer">
            <button id='check_answer_button'>答えを見る</button>
        </section>
        <div id = "mask" class = "backHidden"></div>
        <section id = "modal" class = "backHidden">
            @foreach($quizzes as $quiz)    
                <h2 class = "question_{{ $loop->iteration }} hidden_question"> Q.{{$quiz->question}}</h2>
                <h1 class = "question_{{ $loop->iteration }} hidden_question"> A.{{$quiz->answer}}</h1>
            <div>
                <form class="question_{{ $loop->iteration }} hidden_question" method="POST" action = "{{ route('quiz.CE')}}">
                    <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <button class="CE_button" type="submit" name="CE" value="correct">正解！</button>
                    <button class="CE_button" type="submit" name="CE" value="error">不正解</button>
                </form>
            </div>
            @endforeach
        </section>
    <script src='{{ asset("/js/answer.js") }}'></script>
    </x-slot>
</x-app-layout>