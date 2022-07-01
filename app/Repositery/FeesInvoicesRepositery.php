<?php

namespace App\Repositery;

use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Student;
use App\Models\StudentAccount;

class FeesInvoicesRepositery implements FeesInvoicesRepositeryInterface
{

    public function index()
    {
        $fees=Fee_invoice::all();
        return view('admin.pages.students.invoices.index',compact('fees'));
    }

    public function add($request)
    {

        $List_Fees=$request->List_Fees;

        foreach ($List_Fees as $list_Fee){

            $Fees=new Fee_invoice();
            $Fees->invoice_date = date('Y-m-d');
            $Fees->student_id = $list_Fee['student_id'];
            $Fees->Grade_id = $request->Grade_id;
            $Fees->Classroom_id = $request->Classroom_id;;
            $Fees->fee_id = $list_Fee['fee_id'];
            $Fees->amount = $list_Fee['amount'];
            $Fees->description = $list_Fee['description'];
            $Fees->save();


            $StudentAccount=new StudentAccount();
            $StudentAccount->student_id = $list_Fee['student_id'];
            $StudentAccount->Grade_id = $request->Grade_id;
            $StudentAccount->Classroom_id = $request->Classroom_id;
            $StudentAccount->Debit = $list_Fee['amount'];
            $StudentAccount->credit = 0.00;
            $StudentAccount->description = $list_Fee['description'];
            $StudentAccount->save();

        }

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('fee_invoices.index');



    }

    public function show($id)
    {
       $student=Student::findOrFail($id);
       $fees=Fee::where('class_id',$student->Classroom_id)->get();
       return view('admin.pages.students.invoices.add',compact('student','fees'));
    }


    public function edit($id)
    {
        $fees_invoices=Fee_invoice::findOrFail($id);
        $fees=Fee::where('class_id',$fees_invoices->Classroom_id)->get();

        return view('admin.pages.students.invoices.edit',compact('fees','fees_invoices'));
    }


    public function update($request)
    {


            $Fees=Fee_invoice::findOrFail($request->id);
        $Fees->update([
            'fee_id' => $request->fee_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);



            $StudentAccount=StudentAccount::where('student_id',$Fees->student_id);
            $StudentAccount->update([
               'Debit'=> $request->amount,
                'description'=>$request->description,
            ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('fee_invoices.index');

    }


    public function delete($request)
    {
        $Fees=Fee_invoice::findOrFail($request->id);
        $Fees->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('fee_invoices.index');
    }


}
