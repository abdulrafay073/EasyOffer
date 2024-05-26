<?php

namespace App\Http\Controllers\BuyerDashboard\Listing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

use App\Models\BuyerListing;
use Excel;

class BuyerListingController extends Controller
{
    public function index()
    {
        try {
            return view('buyer-dashboard.listing.create-listing');
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

            $data = BuyerListing::create(
                [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]
            );

            return redirect('buyer/listings')->with('createlisting', 'Listing Created successfully !');
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

            $data = BuyerListing::where('user_id', $user->id)->where('is_active', 1)->orderBy('id', 'ASC')->get();

            return view('buyer-dashboard.listing.listings')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //update
    public function getListingData($id)
    {
        try {
            $data = BuyerListing::where('id', $id)->firstOrFail();

            return view('buyer-dashboard.listing.update-listing')->with(compact('data'));
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

            $data = BuyerListing::where('id', $request->listingid)->firstOrFail();  //update
            $data->name = $request->editname;
            $data->updated_by = $user->id;
            $data->save();

            return redirect('buyer/listings')->with('updatelisting', 'Listing Update successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //delete
    public function getListingDataDel($id)
    {
        try {
            $data = BuyerListing::where('id', $id)->firstOrFail();

            return view('buyer-dashboard.listing.delete-listing')->with(compact('data'));
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

            $data = BuyerListing::where('id', $request->listingid)->first();
            $data->is_active = 0;
            $data->save();

            BuyerListing::destroy($request->listingid);

            return redirect('buyer/listings')->with('deletelisting', 'Listing Deleted successfully !');
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

                                    $check = BuyerListing::where('name', $value[$i][1])->first();
                                    if ($check == null) {

                                        $listing = new BuyerListing();
                                        $listing->user_id = $user->id;
                                        $listing->name = $value[$i][1];
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

            return redirect('buyer/listings')->with('excellisting', 'Listing Created successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
