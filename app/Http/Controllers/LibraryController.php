<?php

namespace App\Http\Controllers;

use App\Models\Grad;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{

    public function index()
    {
        $library=Library::all();
        return view('admin.pages.library.index',compact('library'));
    }


    public function create()
    {
        $grades=Grad::all();
        return view('admin.pages.library.create',compact('grades'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'Grade_id'=>'required',
            'Classroom_id'=>'required',
            'section_id'=>'required',
            'file_name'=>'required',
        ]);

        if ($request->hasFile('file_name')){
            $file=$request->file('file_name');
            $name=$request->file_name->getClientOriginalName();

            $file->storeAs('attachment/library/',$name,'attachments');
        }

        Library::create([
            'title'=>$request->title,
            'filename'=>$name,
            'grad_id'=>$request->Grade_id,
            'section_id'=>$request->section_id,
            'class_id'=>$request->Classroom_id,
            'teacher_id'=>1,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('library.index');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $library=Library::findOrFail($id);
        $grades=Grad::all();
        return view('admin.pages.library.edit',compact('library','grades'));
    }


    public function update(Request $request, $id)
    {
        $l=Library::findOrFail($id);
        if ($request->hasFile('file_name')){
            $file=$request->file('file_name');
            $name=$request->file_name->getClientOriginalName();

            $exists = Storage::disk('attachments')->exists('attachment/library/'.$name);

            if($exists)
            {
                Storage::disk('attachments')->delete('attachment/library/'.$name);
            }

            $file->storeAs('attachment/library/',$name,'attachments');
            $file_new=$request->file_name->getClientOriginalName();

            $l->filename=$l->filename !==$file_new ? $file_new : $l->filename;
        }

       $l->update([
            'title'=>$request->title,
            'filename'=>$name,
            'grad_id'=>$request->Grade_id,
            'section_id'=>$request->section_id,
            'class_id'=>$request->Classroom_id,
            'teacher_id'=>1,
        ]);

        toastr()->success(trans('site.updated'));
        return redirect()->route('library.index');
    }


    public function destroy(Request $request,$id)
    {
            $lib=Library::findOrFail($id);

                $exists = Storage::disk('attachments')->exists('attachment/library/'.$lib->filename);

                if($exists)
                {
                    Storage::disk('attachments')->delete('attachment/library/'.$lib->filename);
                }

             $lib->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('library.index');


        }

    public function dawnload_book($filename)
    {
        return response()->download('attachment/library/'.$filename);
    }
}
