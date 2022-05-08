<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradRequest;
use App\Models\Classroom;
use App\Models\Grad;
use Illuminate\Http\Request;

class GradController extends Controller
{

    public function index()
    {
        $grades=Grad::all();
        return view('admin.pages.grades.grades',compact('grades'));
    }


    public function create()
    {
        //
    }


    public function store(GradRequest $request)
    {
        if (Grad::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){
            return redirect()->back()->withErrors(trans('site.exists'));
        }


        try {
            $validated = $request->validated();

            $grad=Grad::create([
                'name'=>['en'=>$request->name_en,'ar'=>$request->name],
                'notes'=>['en'=>$request->notes_en,'ar'=>$request->notes ]
            ]);

            toastr()->success(trans('site.Added successfully!'));

            return redirect()->route('grad.index');
        }
        catch (\Exception $e){

            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(GradRequest $request)
    {
        try {
            $validated=$request->validated();

            $grad=Grad::findOrFail($request->id);

            $grad->update([
               'name'=>['en'=>$request->name_en,'ar'=>$request->name],
               'notes'=>['en'=>$request->notes_en,'ar'=>$request->notes],
            ]);

            toastr()->success(trans('site.updated'));
            return redirect()->route('grad.index');
        }
        catch (\Exception $e){

            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        $class=Classroom::where('Grid_id',$request->id)->pluck('Grid_id');

        if ($class->count()==0){

            $grad=Grad::findOrFail($request->id);
            $grad->delete();

            toastr()->error(trans('site.Delted SuccessFully!'));
            return redirect()->route('grad.index');

        }
       else{
           toastr()->error(trans('site.Delted1 SuccessFully!'));
           return redirect()->route('grad.index');
       }

    }
}
