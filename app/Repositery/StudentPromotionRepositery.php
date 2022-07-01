<?php

namespace App\Repositery;

use App\Models\Grad;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepositery implements StudentPromotionRepositeryInterface
{

    public function index()
    {
        $grades=Grad::all();
        return view('admin.pages.students.promotion.index',compact('grades'));
    }

    public function store($request)
    {


        DB::beginTransaction();


        $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
        if (Student::count()<1){
            return redirect()->back()->with('promotionserror',trans('site.no available data'));
        }
        foreach ($students as $student){
            $ids=explode(',',$student->id);

            Student::where('id',$ids)->update([
                'Grade_id'=>$request->Grade_id_new,
                'Classroom_id'=>$request->Classroom_id_new,
                'section_id'=>$request->section_id_new,
                'academic_year'=>$request->academic_year_new,

            ]);

            Promotion::updateOrCreate([

                'student_id'=>$student->id,
                'from_grad'=>$request->Grade_id,
                'from_classroom'=>$request->Classroom_id,
                'from_section'=>$request->section_id,
                'to_grad'=>$request->Grade_id_new,
                'to_classroom'=>$request->Classroom_id_new,
                'to_section'=>$request->section_id_new,
                'academic_year'=>$request->academic_year,
                'academic_year_new'=>$request->academic_year_new,

            ]);
        }

        DB::commit();

        toastr()->success(trans('site.updated'));
        return redirect()->back();

    }

    public function craete()
    {
        $promotions=Promotion::all();
        return view('admin.pages.students.promotion.mgmt',compact('promotions'));
    }

    public function destroyy($request)
    {

        DB::beginTransaction();

        if ($request->p_id==1){

            $promotions=Promotion::all();

            foreach ($promotions as $promotion){

                $ids=explode(',',$promotion->student_id);

                Student::where('id',$ids)->update([
                    'Grade_id'=>$promotion->from_grad,
                    'Classroom_id'=>$promotion->from_classroom,
                    'section_id'=>$promotion->from_section,
                    'academic_year'=>$promotion->academic_year,
                    ]);

                Promotion::truncate();         //delete all
            }

            DB::commit();
            toastr()->error(trans('site.Delted SuccessFully!'));
            return redirect()->back();
        }
        else{
            $promotions=Promotion::findOrFail($request->id);

            Student::where('id',$promotions->student_id)->update([
                'Grade_id'=>$promotions->from_grad,
                'Classroom_id'=>$promotions->from_classroom,
                'section_id'=>$promotions->from_section,
                'academic_year'=>$promotions->academic_year,
            ]);

            Promotion::destroy($request->id);

            DB::commit();
            toastr()->error(trans('site.Delted SuccessFully!'));
            return redirect()->back();

        }

    }
}
