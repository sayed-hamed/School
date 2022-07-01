<?php

namespace App\Repositery;

use App\Models\Grad;
use App\Models\Student;

class StudentGraduatedRepositery implements StudentGraduatedRepositeryInterface
{

    public function create()
    {
        $grades=Grad::all();
        return view('admin.pages.students.graduated.create',compact('grades'));
    }

    public function softdelete($request)
    {
       $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

       if (Student::count()<1){
           return redirect()->back();
       }

       foreach ($students as $student){
           $ids=explode(',',$student->id);

           Student::whereIn('id',$ids)->delete();
       }

        toastr()->success(trans('site.Added successfully!'));

       return redirect()->route('graduated.index');


    }


    public function index()
    {
        $students=Student::onlyTrashed()->get();
        return view('admin.pages.students.graduated.index',compact('students'));
    }


    public function delete_student($request)
    {
        Student::onlyTrashed()->where('id',$request->id)->forceDelete();
        toastr()->success(trans('site.Delted SuccessFully!'));

        return redirect()->route('graduated.index');

    }

    public function return_student($request)
    {
        Student::onlyTrashed()->where('id',$request->id)->restore();
        toastr()->success(trans('site.Added successfully!'));

        return redirect()->route('graduated.index');


    }


}
