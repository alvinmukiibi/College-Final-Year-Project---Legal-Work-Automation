<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Firm;
class SettingsController extends Controller
{
    public function viewSetttings(Request $request){

        $firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $setting = new Setting;
        $setting->firm_id = $firm_id;
        $settings = $setting->getSettings();
        // dd($settings);
        return view('firm.admin.settings')->with(['settings' => $settings]);

    }

    public function setRQA(Request $request){

        $data = $this->validate($request, [
            'rqa' => 'required|numeric'
        ]);

        $setting = new Setting;
        $setting->rqa = $data['rqa'];
        $setting->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $setting->setRQA();

        return redirect()->back()->with('success', 'RQA value set successfully!!');


    }
    public function changeRQA(Request $request){
        $data = $this->validate($request, [
            'newRQA' => 'required|numeric'
        ]);

        $setting = new Setting;
        $setting->firm_id = $request->input('firmID');
        $setting->rqa = $data['newRQA'];
        $setting->updateRQA();

        return redirect()->back()->with('success', 'Value Updated!!');
    }
}
