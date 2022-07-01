<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grad;
use App\models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $grads=Grad::with('sections')->get();
        $teachers=Teacher::all();

        $list_grads=Grad::all();
        return view('admin.pages.sections.sections',compact('grads','list_grads','teachers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
        ]);



        $section=Section::create([
            'section_name'=>['en'=>$request->Name_Section_En,'ar'=>$request->Name_Section_Ar],
            'Grid_id'=>$request->Grade_id,
            'Class_id'=>$request->Class_id,
            'Status'=>1,
        ]);

        $section->teachers()->attach($request->teacher_id);


        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('section.index');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
        ]);



        $sections=Section::findOrFail($id);
        if (isset($request->Status)){
            $sections->Status=1;
        }else{
            $sections->Status=2;
        }

        if (isset($request->teacher_id)) {
            $sections->teachers()->sync($request->teacher_id);
        } else {
            $sections->teachers()->sync(array());
        }

        $sections->update([
            'section_name'=>['en'=>$request->Name_Section_En,'ar'=>$request->Name_Section_Ar],
            'Grid_id'=>$request->Grade_id,
            'Class_id'=>$request->Class_id,
            'Status'=>$sections->Status,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('section.index');


    }


    public function destroy($id)
    {
        $section=Section::findOrFail($id);
        $section->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('section.index');
    }

    public function getclasses($id){
        $list_classes=Classroom::where('Grid_id',$id)->pluck('class_name','id');
        return $list_classes;
    }
}
