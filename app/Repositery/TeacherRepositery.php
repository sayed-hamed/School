<?php

namespace App\Repositery;
use App\Models\Gender;
use App\Models\Spacialization;
use App\Models\Teacher;
use App\Repositery\TeacherRepositeryInterface;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Toastr;

class TeacherRepositery implements TeacherRepositeryInterface {



    public function getAllTeacher()
    {
       return Teacher::all();

    }

    public function gender()
    {
        return Gender::all();
    }

    public function spacialization()
    {
        return Spacialization::all();
    }

    public function StoreTeacher($request)
    {
        $request->validate([
            'Email'=>'required|unique:teachers',
            'Password'=>'required',
            'Name_ar'=>'required',
            'Name_en'=>'required',
            'Specialization_id'=>'required',
            'Gender_id'=>'required',
            'Joining_Date'=>'required|date|date_format:Y-m-d',
            'Address'=>'required',
        ]);

        $teacher=new Teacher();
        $teacher->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
        $teacher->password=Hash::make($request->Password);
        $teacher->email=$request->Email;
        $teacher->spec_id=$request->Specialization_id;
        $teacher->gender_id=$request->Gender_id;
        $teacher->joining_data=$request->Joining_Date;
        $teacher->address=$request->Address;
        $teacher->save();

        toastr()->success(trans('site.Added successfully!'));
    }


    public function EditTeacher ($request)
    {
       return Teacher::findOrFail($request);
    }

    public function updateTeacher($request)
    {

        $teacher=Teacher::findOrFail($request->id);
        $teacher->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
        $teacher->password=Hash::make($request->Password);
        $teacher->email=$request->Email;
        $teacher->spec_id=$request->Specialization_id;
        $teacher->gender_id=$request->Gender_id;
        $teacher->joining_data=$request->Joining_Date;
        $teacher->address=$request->Address;
        $teacher->save();

        toastr()->success(trans('site.updated'));

    }

    public function DeleteTeacher($request)
    {
       return Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('site.Delted SuccessFully!'));
    }
}
