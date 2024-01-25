<?php

namespace App\Http\Controllers\AdminDashboard\General;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Seller;
use App\Models\Buyer;

class GeneralController extends Controller
{
    // Seller Tab
    public function sellers(){
        try {

            $seller = User::join('sellers', 'users.id', 'sellers.user_id')
                        ->where('users.is_active', 1)->where('users.is_accept', 1)->where('is_reject', 0)
                        ->select('users.id as userid','sellers.id','sellers.comp_name_1','sellers.comp_email_1','sellers.comp_contact_1','sellers.designation_1','sellers.dob_1','sellers.comp_name_2','sellers.comp_email_2','sellers.comp_contact_2','sellers.designation_2','sellers.dob_2','sellers.comp_name_3','sellers.comp_email_3','sellers.comp_contact_3','sellers.designation_3','sellers.dob_3','sellers.comp_office_address','sellers.comp_factory_address','sellers.comp_ownername','sellers.upload_certification','sellers.ntn','sellers.gst','sellers.comp_general_certification','sellers.is_tmc','sellers.is_active')    
                        ->get();

            return view('admin-dashboard.general.seller')->with(compact('seller'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function sellerViewDetail($id){
        try {

            $data = Seller::where('id', $id)->first();

            return view('admin-dashboard.general.seller-viewdetail')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function sellerEdit($id){
        try {

            $data = Seller::where('id', $id)->first();

            return view('admin-dashboard.general.seller-edit')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function sellerEditSubmit(Request $request){
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

            return redirect('admin/sellers')->with('sellerupdate', 'Seller Updated successfully !');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }
    
    public function sellerRating(Request $request){
        try {
        
            $user = User::where('id', $request->sellerid)->firstOrFail();  //update
            $user->rating = $request->rate;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/sellers')->with('sellerrating', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sellerRemove(Request $request){
        try {
        
            $user = User::where('id', $request->sellerid)->firstOrFail();  //update
            $user->remove_reason = $request->note;
            $user->is_reject = 1;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/sellers')->with('sellerremove', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // Seller-Request Tab
    public function sellerRequests(){
        try {

            $seller = User::join('sellers', 'users.id', 'sellers.user_id')
                        ->where('users.is_active', 0)->where('users.is_accept', 0)->where('users.is_reject', 0)
                        ->select('users.id as userid','sellers.id','sellers.comp_name_1','sellers.comp_email_1','sellers.comp_contact_1','sellers.designation_1','sellers.dob_1','sellers.comp_name_2','sellers.comp_email_2','sellers.comp_contact_2','sellers.designation_2','sellers.dob_2','sellers.comp_name_3','sellers.comp_email_3','sellers.comp_contact_3','sellers.designation_3','sellers.dob_3','sellers.comp_office_address','sellers.comp_factory_address','sellers.comp_ownername','sellers.upload_certification','sellers.ntn','sellers.gst','sellers.comp_general_certification','sellers.is_tmc','sellers.is_active')    
                        ->get();

            return view('admin-dashboard.general.seller-request')->with(compact('seller'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function sellerAccept(Request $request){
        try {
        
            $user = User::where('id', $request->sellerid)->firstOrFail();  //update
            $user->is_active = 1;
            $user->is_accept = 1;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/seller-requests')->with('selleraccepted', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sellerReject(Request $request){
        try {
        
            $user = User::where('id', $request->sellerid)->firstOrFail();  //update
            $user->is_reject = 1;
            $user->is_reject_reason = $request->note;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/seller-requests')->with('sellerrejected', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // Buyer Tab
    public function buyers(){
        try {

            $buyer = User::join('buyers', 'users.id', 'buyers.user_id')
                        ->where('users.is_active', 1)->where('users.is_accept', 1)->where('is_reject', 0)
                        ->select('users.id as userid','buyers.id','buyers.comp_name_1','buyers.comp_email_1','buyers.comp_contact_1','buyers.designation_1','buyers.dob_1','buyers.comp_name_2','buyers.comp_email_2','buyers.comp_contact_2','buyers.designation_2','buyers.dob_2','buyers.comp_name_3','buyers.comp_email_3','buyers.comp_contact_3','buyers.designation_3','buyers.dob_3','buyers.comp_office_address','buyers.comp_factory_address','buyers.comp_ownername','buyers.upload_certification','buyers.ntn','buyers.gst','buyers.is_tmc','buyers.is_active')    
                        ->get();

            return view('admin-dashboard.general.buyer')->with(compact('buyer'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function buyerViewDetail($id){
        try {

            $data = Buyer::where('id', $id)->first();

            return view('admin-dashboard.general.buyer-viewdetail')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function buyerEdit($id){
        try {

            $data = Buyer::where('id', $id)->first();

            return view('admin-dashboard.general.buyer-edit')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function buyerEditSubmit(Request $request){
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'companyperson1' => '',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('flash_message_error', $validator->errors()->first());
            }

            $buyer = User::where('id', $request->userid)->firstOrFail();  //update
            $buyer->name = $request->companyperson1;
            $buyer->email = $request->companyemail1;
            $buyer->save();

            
            // checkcertification
            if(isset($request->uploadcertification)){     //New One Doc
                $doc = $request->uploadcertification->store('public/Certification');
                $doc = '/storage' . substr($doc,6);
            }   
            else{
                $doc = $request->prevdocument;         //Old One Doc
            }

            $user = Buyer::where('user_id', $buyer->id)->firstOrFail();  //update
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
            $user->is_tmc = 1;
            $user->updated_at = Carbon::now();
            $user->save();

            return redirect('admin/buyers')->with('buyerupdate', 'Buyer Updated successfully !');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function buyerRating(Request $request){
        try {
        
            $user = User::where('id', $request->buyerid)->firstOrFail();  //update
            $user->rating = $request->rate;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/buyers')->with('buyerrating', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function buyerRemove(Request $request){
        try {
        
            $user = User::where('id', $request->buyerid)->firstOrFail();  //update
            $user->remove_reason = $request->note;
            $user->is_reject = 1;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/buyers')->with('buyerremove', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // Buyer-Request Tab
    public function buyerRequests(){
        try {

            $buyer = User::join('buyers', 'users.id', 'buyers.user_id')
                        ->where('users.is_active', 0)->where('users.is_accept', 0)->where('users.is_reject', 0)
                        ->select('users.id as userid','buyers.id','buyers.comp_name_1','buyers.comp_email_1','buyers.comp_contact_1','buyers.designation_1','buyers.dob_1','buyers.comp_name_2','buyers.comp_email_2','buyers.comp_contact_2','buyers.designation_2','buyers.dob_2','buyers.comp_name_3','buyers.comp_email_3','buyers.comp_contact_3','buyers.designation_3','buyers.dob_3','buyers.comp_office_address','buyers.comp_factory_address','buyers.comp_ownername','buyers.upload_certification','buyers.ntn','buyers.gst','buyers.is_tmc','buyers.is_active')    
                        ->get();

            return view('admin-dashboard.general.buyer-request')->with(compact('buyer'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function buyerAccept(Request $request){
        try {
        
            $user = User::where('id', $request->buyerid)->firstOrFail();  //update
            $user->is_active = 1;
            $user->is_accept = 1;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/buyer-requests')->with('buyeraccepted', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function buyerReject(Request $request){
        try {
        
            $user = User::where('id', $request->buyerid)->firstOrFail();  //update
            $user->is_reject = 1;
            $user->is_reject_reason = $request->note;
            $user->updated_at = Carbon::now();
            $user->save();
            
            return redirect('admin/buyer-requests')->with('buyerrejected', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
