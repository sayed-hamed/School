<?php

namespace App\Repositery;
use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grad;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\models\Section;
use App\Models\Spacialization;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositery\TeacherRepositeryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Toastr;

class StudentRepositery implements StudentRepositeryInterface {


    public function show_students()
    {
        $students=Student::all();
        return view('admin.pages.students.index',compact('students'));
    }


    public function create_student()
    {
        $data['genders']=Gender::all();
        $data['nationalities']=Nationality::all();
        $data['bloods']=Blood::all();
        $data['grades']=Grad::all();
        $data['sections']=Section::all();
        $data['classrooms']=Classroom::all();
        $data['parents']=My_Parent::all();

        return view('admin.pages.students.add_student',$data);

    }

    public function Get_classrooms($id)
    {
        $list_class=Classroom::where('Grid_id',$id)->pluck("class_name","id");
        return $list_class;
    }

    public function Get_Sections($id)
    {
        $list_sections=Section::where('Class_id',$id)->pluck("section_name","id");
        return $list_sections;
    }

    public function store_students($request)
    {

        DB::beginTransaction();

        $student=Student::create([
            'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'gender_id'=>$request->gender_id,
            'national_id'=>$request->nationalitie_id,
            'blood_id'=>$request->blood_id,
            'Date_Birth'=>$request->Date_Birth,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'parent_id'=>$request->parent_id,
            'academic_year'=>$request->academic_year,
        ]);

        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file){

                $name=$file->getClientOriginalName();

                $file->storeAs('attachment/students/'.$student->name,$file->getClientOriginalName(),'attachments');

                $image=new Image();
                $image->filename=$name;
                $image->imageable_id=$student->id;
                $image->imageable_type='App\Models\Student';
                $image->save();

            }
        }

        DB::commit();

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('students.index');
    }



    public function show_student($id)
    {
        $Student=Student::findOrFail($id);
        return view('admin.pages.students.show',compact('Student'));
    }


    public function edit_form($id)
    {
       $student=Student::findOrFail($id);

        $data['genders']=Gender::all();
        $data['nationalities']=Nationality::all();
        $data['bloods']=Blood::all();
        $data['grades']=Grad::all();
        $data['sections']=Section::all();
        $data['classrooms']=Classroom::all();
        $data['parents']=My_Parent::all();

       return view('admin.pages.students.edit',$data,compact('student'));
    }


    public function edit_student($request,$id)
    {

        $student=Student::findOrFail($id);
        $student->update([
            'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'gender_id'=>$request->gender_id,
            'national_id'=>$request->nationalitie_id,
            'blood_id'=>$request->blood_id,
            'Date_Birth'=>$request->Date_Birth,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'parent_id'=>$request->parent_id,
            'academic_year'=>$request->academic_year,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('students.index');

    }

    public function delete_student($id)
    {
        $student=Student::findOrFail($id);
        $student->delete();
        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('students.index');
    }


    public function upload_attach($request)
    {
       foreach ($request->file('photos') as $file){

           $name=$file->getClientOriginalName();

           $file->storeAs('attachment/students/'.$request->student_name,$file->getClientOriginalName(),'attachments');

           $image=new Image();
           $image->filename=$name;
           $image->imageable_id=$request->student_id;
           $image->imageable_type='App\Models\Student';
           $image->save();

       }

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('students.show',$request->student_id);

    }

    public function dawnload_attachment($stdname, $filename)
    {
        return response()->download(public_path('attachment/students/'.$stdname.'/'.$filename));
    }

    public function delete_attachment($request)
    {
        Storage::disk('attachments')->delete('attachment/students/'.$request->student_name.'/'.$request->filename);

        Image::where('id',$request->id)->where('filename',$request->filename)->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('students.show',$request->student_id);
    }

}
