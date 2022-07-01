<?php

namespace App\Repositery;

use App\Models\Question;
use App\Models\Quiz;

class QuestionRepositery implements QuestionRepositeryInterface
{

    public function index()
    {
        $questions=Question::get();
        return view('admin.pages.questions.index',compact('questions'));
    }

    public function create()
    {
        $quizes=Quiz::all();
        return view('admin.pages.questions.create',compact('quizes'));
    }

    public function store($request)
    {
        $request->validate([
           'title'=>'required',
           'answers'=>'required',
           'right_answer'=>'required',
           'quizze_id'=>'required',
           'score'=>'required',
        ]);

        Question::create([
           'title'=>$request->title,
           'answers'=>$request->answers,
           'right_answer'=>$request->right_answer,
           'quiz_id'=>$request->quizze_id,
           'score'=>$request->score,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->back();

    }

    public function edit($id)
    {
       $question=Question::findOrFail($id);
       $quiz=Quiz::all();
       return view('admin.pages.questions.edit',compact('question','quiz'));
    }

    public function update($request, $id)
    {
        $request->validate([
            'title'=>'required',
            'answers'=>'required',
            'right_answer'=>'required',
            'quizze_id'=>'required',
            'score'=>'required',
        ]);

        $question=Question::findOrFail($id);

        $question->update([
            'title'=>$request->title,
            'answers'=>$request->answers,
            'right_answer'=>$request->right_answer,
            'quiz_id'=>$request->quizze_id,
            'score'=>$request->score,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('question.index');

    }

    public function delete($id)
    {
        $quest=Question::findOrFail($id);
        $quest->delete();
        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('question.index');
    }
}
