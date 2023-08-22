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
        $quiz->question_number = request('question_count') + 1;
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
        $delete_quiz = Quiz::find($id);
        $deck_id = $delete_quiz->deck_id;
        $quiz_number = $delete_quiz->question_number;
        $delete_quiz->delete();
        $quizzes = Quiz::where('question_number', '>', $quiz_number)->get();
        foreach($quizzes as $quiz){
            $quiz->question_number = $quiz->question_number - 1;
            $quiz->save();
        }
        $deck = Deck::find($deck_id);
        $deck->question_count = $deck->question_count - 1;
        $deck->save();
        return redirect()->route('deck.check' , $deck_id);
    }
}
