<?php

namespace App\Repositery;

use App\Models\Fee;
use App\Models\Grad;

class StudentFeesRepositery implements StudentFeesRepositeryInterface
{
    public function index()
    {
        $grads=Grad::all();
        $fees=Fee::all();
        return view('admin.pages.students.fees.index',compact('grads','fees'));
    }

    public function create()
    {
        $Grades=Grad::all();
        return view('admin.pages.students.fees.create',compact('Grades'));
    }

    public function store($request)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'amount'=>'required|numeric',
            'Grade_id'=>'required',
            'Classroom_id'=>'required',
            'year'=>'required',
            'Fee_type'=>'required',
            'description'=>'nullable',
        ]);

        Fee::create([
           'title'=>['en'=>$request->title_en,'ar'=>$request->title_ar],
           'amount'=>$request->amount,
            'grid_id'=>$request->Grade_id,
            'class_id'=>$request->Classroom_id,
            'year'=>$request->year,
            'desc'=>$request->description,
            'fee_type'=>$request->Fee_type,
        ]);

        toastr()->success(trans('site.Added successfully!'));

        return redirect()->route('fee.index');

    }


    public function edit($id)
    {
       $fees=Fee::findOrFail($id);
       $grads=Grad::all();

       return view('admin.pages.students.fees.edit',compact('fees','grads'));
    }

    public function update($request,$id)
    {
        $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
            'amount'=>'required|numeric',
            'Grade_id'=>'required',
            'Classroom_id'=>'required',
            'year'=>'required',
            'Fee_type'=>'required',
            'description'=>'nullable',
        ]);

        $fee=Fee::findOrFail($id);

        $fee->update([

            'title'=>['en'=>$request->title_en,'ar'=>$request->title_ar],
            'amount'=>$request->amount,
            'grid_id'=>$request->Grade_id,
            'class_id'=>$request->Classroom_id,
            'year'=>$request->year,
            'desc'=>$request->description,
            'fee_type'=>$request->Fee_type,


        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('fee.index');

    }


    public function delete_fee($id)
    {
        $fee=Fee::findOrFail($id);
        $fee->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('fee.index');
    }

}
