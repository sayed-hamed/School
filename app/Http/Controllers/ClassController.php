<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Models\Classroom;
use App\Models\Grad;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms=Classroom::all();
        $grads=Grad::all();
        return view('admin.pages.classrooms.classrooms',compact('classrooms','grads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(StoreClassRequest $request)
    {
        $list_classes=$request->List_Classes;

        try {
            $list_classes=$request->List_Classes;

            foreach ($list_classes as $list_class){
                $class=new  Classroom();
                $class->class_name=['en'=>$list_class['name_en'],'ar'=>$list_class['name']];
                $class->Grid_id=$list_class['Grade_id'];

                $class->save();
            }

            toastr()->success(trans('site.Added successfully!'));

            return redirect()->route('classroom.index');
        }



        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
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
    public function update(Request $request)
    {
        try {

            $class=Classroom::findOrFail($request->id);

            $class->update([
                'class_name'=>['en'=>$request->name_en,'ar'=>$request->name],
                'Grid_id'=>$request->Grade_id,
            ]);

            toastr()->success(trans('site.updated'));

            return redirect()->route('classroom.index');

        }
        catch (\Exception $e){
            return  redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        $class=Classroom::findOrFail($request->id);
        $class->delete();
        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('classroom.index');
    }
}
