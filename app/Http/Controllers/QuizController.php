<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Deck;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\QuizRequest;

class QuizController extends Controller
{
    public function newquiz($id)
    {   
        $deck = Deck::find($id);
        return view('quiz.newquiz')
            ->with (['deck' => $deck]);
    }
    public function create(Quiz $quiz, Deck $deck)
    {
        $quiz = new Quiz();
        $quiz->deck_id = request('deck_id');
        $quiz->question_number = request('question_number');
        $quiz->question = request('question');
        $quiz->answer = request('answer');
        $quiz->save();
        
        $deck = Deck::find(request('deck_id'));
        $deck->question_count = $deck->question_count + 1;
        $deck->new_question_number = $deck->new_question_number + 1;
        $deck->save();
        
        return view('quiz.newquiz')
            ->with (['deck' => $deck]);
    }
    public function edit($id)
    {   
        $quiz = Quiz::find($id);
        return view('quiz.edit')
            ->with(['quiz' => $quiz]);
    }
    public function update($id)
    {
        $quiz = Quiz::find($id);
        $quiz->question = request('question');
        $quiz->answer = request('answer');
        $quiz->save();
        print_r($quiz);
        $id = $quiz->deck_id;
        return redirect()->route('deck.check', $id);
    }
    public function destory($id)
    {
        $quiz = Quiz::find($id);
        $deck_id = $quiz->deck_id;
        $quiz->delete();
        $deck = Deck::find($deck_id);
        $deck->question_count = $deck->question_count - 1;
        $deck->save();
        return redirect()->route('deck.check' , $deck_id);
    }
}
