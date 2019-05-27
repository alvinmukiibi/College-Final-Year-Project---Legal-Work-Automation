<?php

namespace App\Http\Controllers;


use App\Mail\FirmMail;
use Illuminate\Http\Request;
use App\Firm;
use Webpatser\Countries\Countries;
use App\Practice_groups;
use Carbon\Carbon;
use App\User;
use App\Events\FirmRegistered;
use DB;
use Illuminate\Support\Facades\Mail;

class FirmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::orderBy('name', 'asc')->where(['activity_flag'=>'active','verification_flag'=>'verified'])->paginate(10);
        return view('home.firms')->with(["firms"=>$firms]);
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





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $firm = Firm::find($id);

        return view('home.view')->with("firm", $firm);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showRegister(){
        $countries = new Countries;
        $data = [
            "countries" => $countries->getListForSelect(),
            "firms" => Firm::orderBy('created_at', 'desc')->get()

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


    public function  search(Request $request)
    {
        $this->validate($request, [
            "search"=>"required|max:150",
        ]);
        $results = \DB::table('firms')->where('name', $request->get('search'))->get();

      return view ('firm.associate.lawyer',['results'=>$results]);
    }

    public function sendMail(Request $request)
    {
        $name = $request->get('name');
        $sender_message = $request->get('message');
        $email = $request->get('email');
        $practice_areas = $request->get('practice_areas');
        $firm_email = $request->get('firm_email');

        $content = [
          'title' => $name,
          'body' => $sender_message,
        ];

        Mail::to($firm_email)->send(new FirmMail($content));


        echo 'Me';
       // return redirect()->back()->with('success', 'Mail Sent successfully');
    }


}
