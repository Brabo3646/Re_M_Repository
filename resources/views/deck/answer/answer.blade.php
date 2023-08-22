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
        <section id="question">
            <h1>Q.問い</h1>
        </section>
        <section id="check-answer">
            <button>答えを見る</button>
        </section>
        <section id = modal class="hidden">
            <h2>Q.問い</h2>
            <h1>A.答え</h1>
        <div id="CE-button">
            <button>合ってた！</button>
            <button>もう一度！</button>
        </div>
    </section>
        <script src='{{ asset("/js/answer.js") }}'></script>
    </x-slot>
</x-app-layout>