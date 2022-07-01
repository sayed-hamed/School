<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
       $settings=Setting::all();
       $setting['setting']=$settings->flatMap(function ($settings){
          return [$settings->key=>$settings->value];
       });

       return view('admin.pages.settings.index',$setting);
    }

    public function update(Request $request)
    {
        $inf=$request->except('_token', '_method', 'logo');
        foreach ($inf as $key=>$value){
            Setting::where('key',$key)->update(['value'=>$value]);
        }


        if ($request->hasFile('logo'))
        {
            $name=$request->file('logo')->getClientOriginalName();
            $file=$request->file('logo');

            Setting::where('key','logo')->update(['value'=>$name]);

            $file->storeAs('attachment/logo/',$name,'attachments');
        }

        toastr()->success(trans('site.updated'));
        return back();
    }
}
