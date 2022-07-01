<?php

namespace App\Http\Traits;


use MacsiDigital\Zoom\Facades\Zoom;

trait OnlineMeetingtrait
{

    public function CreateZoomMeeting($request)
    {
        $user = Zoom::user()->first();

        $meetings=[
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
//            'timezone' => config('zoom.timezone')
             'timezone' => 'Africa/Cairo'
        ];

        $meeting = Zoom::meeting()->make($meetings);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);

       return $user->meetings()->save($meeting);


    }

}
