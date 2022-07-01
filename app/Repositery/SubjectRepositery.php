<?php

namespace App\Repositery;

use App\Models\Grad;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepositery implements SubjectRepositeryInterface
{
    public function index()
    {
        $subjects=Subject::get();
        return view('admin.pages.subject.index',compact('subjects'));
    }

    public function create()
    {
        $grads=Grad::all();
        $teachers=Teacher::all();
        return view('admin.pages.subject.create',compact('grads','teachers'));
    }

    public function edit($id)
    {
        $subject=Subject::findOrFail($id);
        $grads=Grad::all();
        $teachers=Teacher::all();
        return view('admin.pages.subject.edit',compact('subject','grads','teachers'));
    }

    public function store($request)
    {
        $request->validate([

            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
            'teacher_id'=>'required',
        ]);

        Subject::create([
           'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar] ,
            'grade_id'=>$request->Grade_id,
            'class_id'=>$request->Class_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('subject.index');

    }

    public function update($request,$id)
    {
        $request->validate([

            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
            'teacher_id'=>'required',
        ]);

        $subiect=Subject::findOrFail($id);

        $subiect->update([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar] ,
            'grade_id'=>$request->Grade_id,
            'class_id'=>$request->Class_id,
            'teacher_id'=>$request->teacher_id,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('subject.index');
    }

    public function delete($id)
    {
        $subiect=Subject::findOrFail($id);
        $subiect->delete();
        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('subject.index');
    }
}
