<?php

namespace App\Http\Controllers\SellerDashboard\Listing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

use App\Models\SellerListing;
use Excel;

class SellerListingController extends Controller
{
    public function index()
    {
        try {
            return view('seller-dashboard.listing.create-listing');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //create
    public function createListing(Request $request)
    {
        try {
            $user = Auth::user();

            // *validation
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'error' => $validator->errors(),
                        'message' => $validator->errors()->first()
                    ],
                    $this->badRequest
                );
            }

            $data = SellerListing::create(
                [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'certification' => $request->certification,
                    'capacity' => $request->capacity,
                    'intermediate_manufacturing' => $request->optionsRadios,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]
            );
            return redirect('seller/listing')->with('createlisting', 'Listing Created successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //get
    public function getListing()
    {
        try {
            $user = Auth::user();

            $data = SellerListing::where('user_id', $user->id)->where('is_active', 1)->orderBy('id', 'ASC')->get();

            return view('seller-dashboard.listing.listings')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //update
    public function getListingData($id)
    {
        try {
            $data = SellerListing::where('id', $id)->firstOrFail();

            return view('seller-dashboard.listing.update-listing')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function updateListing(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => '',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('flash_message_error', $validator->errors()->first());
            }

            $data = SellerListing::where('id', $request->listingid)->firstOrFail();  //update
            $data->name = $request->editname;
            $data->description = $request->editdescription;
            $data->price = $request->editprice;
            $data->certification = $request->editcertification;
            $data->capacity = $request->editcapacity;
            $data->intermediate_manufacturing = $request->editoptionsRadios;
            $data->updated_by = $user->id;
            $data->save();

            return redirect('seller/listing')->with('updatelisting', 'Listing Update successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //delete
    public function getListingDataDel($id)
    {
        try {
            $data = SellerListing::where('id', $id)->firstOrFail();

            return view('seller-dashboard.listing.delete-listing')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function deleteListing(Request $request)
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                // 'name' => '',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('flash_message_error', $validator->errors()->first());
            }

            $data = SellerListing::where('id', $request->listingid)->first();
            $data->is_active = 0;
            $data->save();

            SellerListing::destroy($request->listingid);

            return redirect('seller/listing')->with('deletelisting', 'Listing Deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Excel Upload For Listing
    public function excelListing(Request $request)
    {
        try {
            $user = Auth::user();

            // Buyer Listing Excel
            if ($request->hasFile('uploadfile')) {

                $path = $request->file('uploadfile');
                $data = Excel::toArray([], $path);

                if (!empty($data)) {

                    foreach ($data as $key => $value) {
                        if (!empty($value)) {

                            for ($i = 0; $i < count($value); $i++) {

                                if ($i > 0) {  //data insert when row id is 1 in excel file

                                    $check = SellerListing::where('name', $value[$i][1])->first();
                                    if ($check == null) {

                                        $listing = new SellerListing();
                                        $listing->user_id = $user->id;
                                        $listing->name = $value[$i][1];
                                        $listing->description = $value[$i][2];
                                        $listing->certification = $value[$i][3];
                                        $listing->capacity = $value[$i][4];
                                        $listing->intermediate_manufacturing = $value[$i][5];
                                        $listing->price = $value[$i][6];
                                        $listing->created_by = $user->id;
                                        $listing->updated_by = $user->id;
                                        $listing->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return redirect('seller/listing')->with('excellisting', 'Listing Created successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
