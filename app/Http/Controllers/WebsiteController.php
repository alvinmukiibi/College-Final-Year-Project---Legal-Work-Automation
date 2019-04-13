<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use App\Firm;
use App\User;
class WebsiteController extends Controller
{


    public function showWebsite(Request $request){
        $user = new User;
         $user->firm_id = auth()->user()->firm_id;
        $firm = $user->firm;
            return view("firm.admin.website")->with('firm', $firm);

       }




       public function savelawfirmProfile(Request $request)
    {

    $data = $this->validate($request, [
    "name"=>"required|max:150",
    "contact1"=>"required|max:15",
    "contact2"=>"required|max:15",
    "country"=>"required|max:40",
    "area"=>"required|max:40",
    "city"=>"required|max:40",
    "street_address"=>"required|max:40",
    "website"=>"required|max:40",
    "description"=>"required|max:200",
    "avatar"=>"mimes:jpeg,jpg,gif,png,webp|dimensions:min_width=100,min_height=600"
]);
$image_name = null;
if($request->hasFile('avatar')){  //if user uploaded a profile picture
    if($request->file('avatar')->isValid()){ //if upload was successful
        $file = $request->file('avatar');
        $image = InterventionImage::make($file);
        $image->fit(500,500, null, 'center');
        $image_name = str_replace(' ', '_', $data['name']).'_'.time().'.'.$file->getClientOriginalExtension();
        $saved_to = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'firms'.DIRECTORY_SEPARATOR.$image_name;
        $image->save($saved_to);

    }else{
        return redirect()->back()->with("error", "File Upload Failed, please retry");
    }
}

$user = new Firm;
$user->firmData = $data;
$user->avatar = $image_name;
$save = $user->savelawfirmProfile();
if($save){
     return redirect()->back()->with("success", "Profile Changed Successfully");
}else{
 return redirect()->back()->with("error", "Nothing was changed");
}

    }
}
