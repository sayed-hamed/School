<?php

namespace App\Repositery;

use App\Models\Attandence;
use App\Models\Grad;
use App\Models\Student;
use App\Models\Teacher;
use phpDocumentor\Reflection\Types\True_;

class AttandenceRepositery implements AttandenceRepositeryInterface
{

    public function index()
    {
        $grads=Grad::with(['sections'])->get();
        $l_grads=Grad::all();
        $teachers=Teacher::all();

        return view('admin.pages.attandence.index',compact('grads','l_grads','teachers'));
    }

    public function show($id)
    {
       $students=Student::with(['attandence'])->where('section_id',$id)->get();

       return view('admin.pages.attandence.attand',compact('students'));
    }

    public function store($request)
    {
        foreach ($request->attendences as $studentid=>$attendence){

            if ($attendence == 'presence'){
                $att_stat=true;
            }
            if ($attendence == 'absent'){
                $att_stat=false;
            }


            Attandence::create([

                'student_id'=>$studentid,
                'Grade_id'=>$request->grade_id,
                'Classroom_id'=>$request->classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>1,
                'attandence_date'=>date('Y-m-d'),
                'attandence_status'=>$att_stat,


            ]);

            toastr()->success(trans('site.Added successfully!'));
            return redirect()->back();



        }
    }
}
