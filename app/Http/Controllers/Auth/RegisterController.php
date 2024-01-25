<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Buyer;
use App\Models\BuyerListing;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;  //Use for Sending Mail
use Excel;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/login';
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'companyperson1' => ['required', 'string', 'max:255'],
            // 'companyemail1' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'companycontact1' => ['required', 'string', 'max:255'],

            // 'companyperson2' => ['required', 'string', 'max:255'],
            // 'companyemail2' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'companycontact2' => ['required', 'string', 'max:255'],
            
            // 'companyperson3' => ['required', 'string', 'max:255'],
            // 'companyemail3' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'companycontact3' => ['required', 'string', 'max:255'],

            // 'companyaddress' => ['required', 'string', 'max:255'],
            // 'designation' => ['required', 'string', 'max:255'],
            // 'ownername' => ['required', 'string', 'max:255'],
            // 'dob' => ['required', 'string', 'max:255'],
            // 'uploadcertification' => ['required', 'string', 'max:255'],
            // 'ntnno' => ['required', 'string', 'max:255'],
            // 'gstno' => ['required', 'string', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['companyperson1'],
            'email' => $data['companyemail1'],
            'password' => Hash::make($data['password']),
            'role_id' => intVal($data['optionsRadios']),    // 1 is Admin , 2 is Buyer , 3 is Seller
        ]);

        if(isset($data['uploadcertification'])){
            $img = $data['uploadcertification']->store('public/Certification');
            $img = '/storage' . substr($img,6);    
        }
        else{
            $img = "";
        }

        if(isset($data['companygeneralcertification'])){
            $cgimg = $data['companygeneralcertification']->store('public/CompanyGeneralCertification');
            $cgimg = '/storage' . substr($cgimg,6);    
        }
        else{
            $cgimg = "";
        }

        if(intVal($data['optionsRadios']) == 2){  // Buyer
            Buyer::create([
                'user_id' => $user->id,
                'comp_name_1' => $data['companyperson1'],
                'comp_email_1' => $data['companyemail1'],
                'comp_contact_1' => $data['companycontact1'],
                'designation_1' => $data['designation1'],
                'dob_1' => $data['dob1'],
                'comp_name_2' => $data['companyperson2'],
                'comp_email_2' => $data['companyemail2'],
                'comp_contact_2' => $data['companycontact2'],
                'designation_2' => $data['designation2'],
                'dob_2' => $data['dob2'],
                'comp_name_3' => $data['companyperson3'],
                'comp_email_3' => $data['companyemail3'],
                'comp_contact_3' => $data['companycontact3'],
                'designation_3' => $data['designation3'],
                'dob_3' => $data['dob3'],
                'comp_office_address' => $data['companyofficeaddress'],
                'comp_factory_address' => $data['companyfactoryaddress'],
                'comp_ownername' => $data['ownername'],
                'upload_certification' => $img,
                'ntn' => $data['ntnno'],
                'gst' => $data['gstno'],
                'is_tmc' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        }else if(intVal($data['optionsRadios']) == 3){  // Seller
            Seller::create([
                'user_id' => $user->id,
                'comp_name_1' => $data['companyperson1'],
                'comp_email_1' => $data['companyemail1'],
                'comp_contact_1' => $data['companycontact1'],
                'designation_1' => $data['designation1'],
                'dob_1' => $data['dob1'],
                'comp_name_2' => $data['companyperson2'],
                'comp_email_2' => $data['companyemail2'],
                'comp_contact_2' => $data['companycontact2'],
                'designation_2' => $data['designation2'],
                'dob_2' => $data['dob2'],
                'comp_name_3' => $data['companyperson3'],
                'comp_email_3' => $data['companyemail3'],
                'comp_contact_3' => $data['companycontact3'],
                'designation_3' => $data['designation3'],
                'dob_3' => $data['dob3'],
                'comp_office_address' => $data['companyofficeaddress'],
                'comp_factory_address' => $data['companyfactoryaddress'],
                'comp_ownername' => $data['ownername'],
                'upload_certification' => $img,
                'ntn' => $data['ntnno'],
                'gst' => $data['gstno'],
                'comp_general_certification' => $cgimg,
                'is_tmc' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }

        //Sending Status on Email s 
        // $data = [
        //     "name" => $data['firstname'] .' '. $data['lastname'],
        //     "email" => $data['email'],
        //     "password" => $data['password'],
        //     "userid" => $user->id,
        // ];

        // $to_name = $user->name;
        // $to_email = $user->email;
        // Mail::send("auth.dynamic-email", ["email_data" => $data], function($message) use ($to_name, $to_email) {
        // $message->to($to_email,$to_name)->subject("Spade Email Verification");
        // $message->from($to_email,$to_name);
        // });
        // Sending Status on Email e

        
        return $user;
          
    }

    //This Function is used for redirecting the login page after registeration
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect($this->redirectPath())->with('message', 'Your message');
    }

    // Ajax call function to check user email already exist or not
    public function checkUserEmail($email)
    {
        try {
            dd($email);
            $useremail = $email;
            $data = User::where('email', $useremail)->first();

            if($data != null){
                $exist = "yes";
            }else{
                $exist = "no";
            }

            return response()->json(['email'=>$exist]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
            
        }
    }
}