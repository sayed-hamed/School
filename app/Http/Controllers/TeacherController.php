<?php

namespace App\Http\Controllers;

use App\Repositery\TeacherRepositery;
use App\Repositery\TeacherRepositeryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
   protected $teacher;

   public function __construct(TeacherRepositery $teacher)
   {
       $this->teacher=$teacher;
   }

    public function index()
    {
        $Teachers=$this->teacher->getAllTeacher();
        return view('admin.pages.teachers.teacher',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Teachers=$this->teacher->getAllTeacher();
        $genders=$this->teacher->gender();
        $specializations=$this->teacher->spacialization();

        return view('admin.pages.teachers.create',compact('genders','specializations','Teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->teacher->StoreTeacher($request);
        return redirect()->route('teachers.index');

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

        $Teachers =  $this->teacher->EditTeacher($id);
        $specializations = $this->teacher->spacialization();
        $genders = $this->teacher->gender();
        return  view('admin.pages.teachers.edit',compact('Teachers','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->teacher->updateTeacher($request);
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $this->teacher->DeleteTeacher($request);
        return redirect()->route('teachers.index');


    }
}
