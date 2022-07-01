<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Attandence;
use App\models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {
        $ids=\App\Models\Teacher::findOrFail(\auth()->user()->id)->sections()->pluck('section_id');
        $students=\App\Models\Student::where('section_id',$ids)->get();

        return view('admin.pages.teachers.dash-setting.student',compact('students'));
    }



    public function section()
    {
        $ids=DB::table('section_teacher')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections=Section::whereIn('id',$ids)->get();
        return view('admin.pages.teachers.dash-setting.sections',compact('sections'));
    }

    public function attandence(){

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





    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
