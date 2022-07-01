<?php

namespace App\Http\Controllers;

use App\Http\Traits\OnlineMeetingtrait;
use App\Models\Grad;
use App\Models\OnlineMeeting;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineMeetingController extends Controller
{
    use OnlineMeetingtrait;

    public function index()
    {
        $meetings=OnlineMeeting::all();
        return view('admin.pages.meetings.index',compact('meetings'));
    }


    public function create()
    {
        $grads=Grad::all();
        return view('admin.pages.meetings.create',compact('grads'));
    }

    public function indirect()
    {
        $grads=Grad::all();
        return view('admin.pages.meetings.indirect',compact('grads'));
    }

    public function store(Request $request)
    {
        $meeting=$this->CreateZoomMeeting($request);

        OnlineMeeting::create([
            'grid_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $meeting->id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $meeting->duration,
            'password' => $meeting->password,
            'start_url' => $meeting->start_url,
            'join_url' => $meeting->join_url,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('meetings.index');


    }

    public function indirectstore(Request $request)
    {

        OnlineMeeting::create([
            'grid_id' => $request->Grade_id,
            'classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);

        toastr()->success(trans('site.Added successfully!'));
        return redirect()->route('meetings.index');
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
        //
    }

    public function destroy(Request $request)
    {
        $meeting= Zoom::meeting()->find($request->id);
        $meeting->delete();

        $dm=OnlineMeeting::where('meeting_id',$request->id);
        $dm->delete();

        toastr()->error(trans('site.Delted SuccessFully!'));
        return redirect()->route('meetings.index');
    }
}
