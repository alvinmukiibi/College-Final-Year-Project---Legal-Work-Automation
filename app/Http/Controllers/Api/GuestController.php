<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Firm;
use Validator;
use App\Events\FirmContacted;
class GuestController extends Controller
{
    public $statusCode200 = 200;
    public $statusCode422 = 422;
    public $statusCode201 = 201;

    public function showAllFirms(Request $request){

        $firm = new Firm;
        $firms = $firm->getAllFirms();

        $res['error'] = 'false';
        $res['firms'] = $firms;

        return response()->json($res, $this->statusCode200);
    }

    public function viewFirm(Request $request){

       $id = $request->input('firm_id');

       $firm = Firm::find($id);

       $res['error'] = false;
       $res['firm'] = $firm;

       return response()->json($res, $this->statusCode200);

    }

    public function contactFirm(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|nullable',
            'email' => 'email|nullable',
            'phone' => 'required',
            'contactChoice' => 'required',
            'query' => 'required',

        ]);

        if($validator->fails()){
            $res['error'] = true;
            $res['message'] = $validator->errors()->first();
            return response()->json($res, $this->statusCode422);
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'contactChoice' => $request->input('contactChoice'),
            'query' => $request->input('query')
        ];

        //get data of law firm being contacted

        $firm = Firm::find($request->input('firm_id'));

        $event = new FirmContacted;
        $event->data = $data;
        $event->firm = $firm;

        event($event);

        $res['error'] = false;
        $res['message'] = "You have successfully contacted, " . $firm->name . " You will be contacted shortly!!" ;

        return response()->json($res, $this->statusCode200);


    }

    public function searchFirm(Request $request){
        $searchPattern = $request->input('pattern');

        $firm = new Firm;
        $firm->pattern = $searchPattern;

        $marches = $firm->searchFirms();

        $count = $marches->count();

        if($count > 0){
            $res['error'] = false;
            $res['firms'] = $marches;
            return response()->json($res, $this->statusCode200);
        }else{

            $res['error'] = false;
            $res['firms'] = [];
            return response()->json($res, $this->statusCode200);

        }
    }


}
