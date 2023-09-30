<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Deck;
use App\Models\Quiz;
use App\Models\User;
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
        // クイズの整理番号は、デッキにあるクイズの数に一足したもの
        $quiz->question = request('question');
        $quiz->answer = request('answer');
        $quiz->save();
        
        $deck = Deck::find(request('deck_id'));
        $deck->question_count ++;
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
        // ここで、削除されたクイズの番号以上のクイズの番号を一つ下げる
        foreach($quizzes as $quiz){
            $quiz->question_number = $quiz->question_number - 1;
            $quiz->save();
        }
        $deck = Deck::find($deck_id);
        $deck->question_count = $deck->question_count - 1;
        // クイズの数を一つ減らす
        $deck->save();
        return redirect()->route('deck.check' , $deck_id);
    }
    public function CE()
    {
        $CE = request('CE');
        $quiz_id = request('quiz_id');
        $user_id = request('user_id');
        $user = User::find($user_id);
        $exists = $user->quiz($quiz_id)->exists();
        // ユーザーとクイズの中間データがない場合
        if(!$exists){
            $user->quiz($quiz_id)->attach($quiz_id);
        }
        $quiz = $user->quizzes()->where('id', $quiz_id)->first();
        if ($CE === "correct"){
            $quiz->pivot->increment('correct_count');
            $quiz->pivot->latest_correct = Carbon::now();
            $quiz->pivot->save();
        } else {
            $quiz->pivot->increment('error_count');
            $quiz->pivot->latest_error = Carbon::now();
            $quiz->pivot->save();
        }
        return response()->json(['code' => $CE]);
    }
}
