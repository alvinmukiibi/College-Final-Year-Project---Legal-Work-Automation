<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firm;
use Webpatser\Countries\Countries;
use App\Practice_groups;
use Carbon\Carbon;
use App\User;
use App\Events\FirmRegistered;

class FirmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::orderBy('name', 'asc')->where(['activity_flag'=>'active','verification_flag'=>'verified'])->get();

        return view('home.firms')->with("firms", $firms);
    }

    public function store(Request $request)
    {
        $firm_data = $this->validate($request, [
            "name" => "required|max:150",
            "email"=>"required|email",
            "work_contact"=>"required",
            "country"=>"required",
            "region"=>"required",
            "city"=>"required",
            "street_address"=>"required",
        ]);

        $count = Firm::where('email', $request->input('email'))->count();

        if($count > 0){
            return redirect()->route('register.firm')->with("error", "Email Already Exists");
        }



        $data = Firm::registerFirm($request);

        $firm = ["otp" => $data['otp'], "uuid" => $data['uuid'], "name" => $firm_data['name'], "email" => $firm_data['email']];


        //event to tell all the app that a firm has been registered

        event(new FirmRegistered($firm));

        $user = new User;
        $user->id_token = $data['uuid'];
        $user->password = $data['otp'];

        $persistOtp = $user->persistOtp();

        if(!$persistOtp){
            return redirect()->route('register.firm')->with("error", "Failed to generate OTP for the user");
        }

        return redirect()->route('register.firm')->with("success", "Firm Added Successfully");

        }

    public function viewFirm(Request $request)
    {
        $slug = $request->segment(2);
        $firm = Firm::where('slug', $slug)->get();
        foreach($firm as $fir){
            return view('home.view')->with("firm", $fir);
        }

    }

    public function showRegister(){
        $countries = new Countries;
        $data = [
            "countries" => $countries->getListForSelect(),
            "firms" => Firm::orderBy('created_at', 'desc')->paginate(10)

        ];

        return view("ulc.register")->with($data);
    }
    public function showFirm($firm){

        return view("ulc.view")->with("firm", Firm::where("uuid", $firm)->get());

    }
    public function activate($uuid){

        $lawfirm = new Firm;
        $lawfirm->uuid = $uuid;
        $activate = $lawfirm->activate();
        if($activate){
            $activateUser = $lawfirm->activateUsers();
            if($activateUser){
                return redirect()->back()->with("success", "Successful Activation");
            }else{
                return redirect()->back();
            }
        }else{
           return redirect()->back()->with("error", "Failed to activate");
        }
        return redirect()->back();

    }
    public function deactivate($uuid){

        $lawfirm = new Firm;
        $lawfirm->uuid = $uuid;
        $deactivate = $lawfirm->deactivate();
        if($deactivate){
            $deactivateUser = $lawfirm->deactivateUsers();
            if($deactivateUser){
                return redirect()->back()->with("success", "Successful Deactivation");
            }else{
                return redirect()->back();
            }
        }else{

           return redirect()->back()->with("error", "Failed to deactivate");
        }
        return redirect()->back();
     }

     public function countActiveFirms(){

        $firms = Firm::where(['verification_flag' => 'verified', 'activity_flag' => 'active'])->count();

        return response()->json(['count' => $firms]);
     }
}
