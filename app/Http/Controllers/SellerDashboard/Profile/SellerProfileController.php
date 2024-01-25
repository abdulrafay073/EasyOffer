<?php

namespace App\Http\Controllers\SellerDashboard\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  //Use for password decryption
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Seller;

class SellerProfileController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

            $data = Seller::where('user_id', $user->id)->firstOrFail();

            return view('seller-dashboard.profile.update-profile')->with(compact('data'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
    
    public function updateProfile(Request $request){
        try {

            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'companyperson1' => '',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('flash_message_error', $validator->errors()->first());
            }

            $seller = User::where('id', $request->userid)->firstOrFail();  //update
            $seller->name = $request->companyperson1;
            $seller->email = $request->companyemail1;

            if(isset($request->password)){
                
                $seller->password = Hash::make($request->password);
            
            }else{

                $data = User::where('id', $request->userid)->select('password')->firstOrFail();
                $seller->password = $data->password;
            }
            $seller->save();

            
            // checkcertification
            if(isset($request->uploadcertification)){     //New One Doc
                $doc = $request->uploadcertification->store('public/Certification');
                $doc = '/storage' . substr($doc,6);
            }   
            else{
                $doc = $request->prevdocument;         //Old One Doc
            }

            // check compnay-general-certification
            if(isset($request->companygeneralcertification)){     //New One Doc
                $cgdoc = $request->companygeneralcertification->store('public/CompanyGeneralCertification');
                $cgdoc = '/storage' . substr($cgdoc,6);
            }   
            else{
                $cgdoc = $request->prevgeneraldocument;         //Old One Doc
            }

            $user = Seller::where('user_id', $seller->id)->firstOrFail();  //update
            $user->comp_name_1 = $request->companyperson1;
            $user->comp_email_1 = $request->companyemail1;
            $user->comp_contact_1 = $request->companycontact1;
            $user->designation_1 = $request->designation1;
            $user->dob_1 = $request->dob1;
            $user->comp_name_2 = $request->companyperson2;
            $user->comp_email_2 = $request->companyemail2;
            $user->comp_contact_2 = $request->companycontact2;
            $user->designation_2 = $request->designation2;
            $user->dob_2 = $request->dob2;
            $user->comp_name_3 = $request->companyperson3;
            $user->comp_email_3 = $request->companyemail3;
            $user->comp_contact_3 = $request->companycontact3;
            $user->designation_3 = $request->designation3;
            $user->dob_3 = $request->dob3;
            $user->comp_office_address = $request->companyofficeaddress;
            $user->comp_factory_address = $request->companyfactoryaddress;
            $user->comp_ownername = $request->ownername;
            $user->upload_certification = $doc;
            $user->ntn = $request->ntnno;
            $user->gst = $request->gstno;
            $user->comp_general_certification = $cgdoc;
            $user->is_tmc = 1;
            $user->updated_at = Carbon::now();
            $user->save();

            return redirect('seller/update-profile')->with('profileupdate', 'Profile Updated successfully !');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function checkUserPassword($password)
    {
        try {
            $user = Auth::user();
            
            $data = User::where('email', $user->email)->first();

            if(Hash::check($password, $data->password)){
                $pswrd = "Success";
            }else{
                $pswrd = "Your Password is incorrect";
            }

            return response()->json(['user'=>$pswrd]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
            
        }
    }
}