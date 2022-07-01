<?php

namespace App\Repositery;

use App\Models\Classroom;
use App\Models\Grad;
use App\Models\Quiz;
use App\models\Section;
use App\Models\Subject;
use App\Models\Teacher;

class QuizRepositery implements QuizRepositeryInterface
{

    public function index()
    {
        $quizes=Quiz::get();
        return view('admin.pages.exam.index',compact('quizes'));
    }

    public function create()
    {
        $date['grades']=Grad::all();
        $date['subjects']=Subject::all();
        $date['classrooms']=Classroom::all();
        $date['sections']=Section::all();
        $date['teachers']=Teacher::all();

        return view('admin.pages.exam.create',$date);
    }

    public function store($request)
    {
        $request->validate([

            'Name_ar'=>'required',
            'Name_en'=>'required',
            'subject_id'=>'required',
            'teacher_id'=>'required',
            'Grade_id'=>'required',
            'Classroom_id'=>'required',
            'section_id'=>'required',
        ]);

        Quiz::create([
           'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar] ,
            'subject_id'=>$request->subject_id,
            'grad_id'=>$request->Grade_id,
            'section_id'=>$request->section_id,
            'class_id'=>$request->Classroom_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('exam.index');

    }

    public function edit($id)
    {
        $quizz=Quiz::findOrFail($id);
        $date['grades']=Grad::all();
        $date['subjects']=Subject::all();
        $date['classrooms']=Classroom::all();
        $date['sections']=Section::all();
        $date['teachers']=Teacher::all();

        return view('admin.pages.exam.edit',compact('quizz'),$date);    }

    public function update($request, $id)
    {
        $request->validate([

            'Name_ar'=>'required',
            'Name_en'=>'required',
            'subject_id'=>'required',
            'teacher_id'=>'required',
            'Grade_id'=>'required',
            'Classroom_id'=>'required',
            'section_id'=>'required',
        ]);

        $quizz=Quiz::findOrFail($id);


        $quizz->update([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar] ,
            'subject_id'=>$request->subject_id,
            'grad_id'=>$request->Grade_id,
            'section_id'=>$request->section_id,
            'class_id'=>$request->Classroom_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('exam.index');
    }

    public function delete($id)
    {
        Quiz::destroy($id);
        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('exam.index');

    }
}
