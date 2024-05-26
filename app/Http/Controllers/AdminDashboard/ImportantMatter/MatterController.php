<?php

namespace App\Http\Controllers\AdminDashboard\ImportantMatter;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Matter;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatterController extends Controller
{
    public function index()
    {
        try {

            $buyers = Buyer::where('is_active', 1)->get();
            $sellers = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.matter.create-matter')->with(compact('buyers', 'sellers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //create
    public function createMatter(Request $request)
    {
        try {

            // *validation
            $validator = Validator::make($request->all(), [
                'customer' => 'required',
                'assignto' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('flash_message_error', $validator->errors()->first());
            }

            $data = Matter::create(
                [
                    'customer_id' => $request->customer,
                    'assign_to' => $request->assignto,
                    'product_name' => $request->product,
                    'problem' => $request->problem,
                    'problem_rated' => $request->problemrated,
                    'status' => $request->status,
                    'solution' => $request->solution,
                    'boss_feedback' => $request->bossfeedback,
                    'manager_approval' => $request->managerapproval,
                    'resolve_time' => $request->resolvetime,
                    'issue_related' => $request->issuerelated,
                ]
            );

            return redirect('admin/matters')->with('creatematter', 'Matter has been created successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //get
    public function getMatterListing()
    {
        try {

            $data = Matter::withoutTrashed()->get();

            return view('admin-dashboard.matter.matters')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //update
    public function getMatterData($id)
    {
        try {
            $data = Matter::where('id', $id)->firstOrFail();

            $buyers = Buyer::where('is_active', 1)->get();
            $sellers = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.matter.update-matter')->with(compact('data', 'buyers', 'sellers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function updateMatter(Request $request)
    {
        try {

            $matter = Matter::find($request->matterid);
            $matter->customer_id = $request->customer;
            $matter->assign_to = $request->assignto;
            $matter->product_name = $request->product;
            $matter->problem = $request->problem;
            $matter->problem_rated = $request->problemrated;
            $matter->status = $request->status;
            $matter->solution = $request->solution;
            $matter->boss_feedback = $request->bossfeedback;
            $matter->manager_approval = $request->managerapproval;
            $matter->resolve_time = $request->resolvetime;
            $matter->issue_related = $request->issuerelated;
            $matter->save();

            return redirect('admin/matters')->with('updatematter', 'Listing Update successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //delete
    public function getMatterDataDel($id)
    {
        try {
            $data = Matter::where('id', $id)->firstOrFail();

            $buyers = Buyer::where('is_active', 1)->get();
            $sellers = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.matter.delete-matter')->with(compact('data', 'buyers', 'sellers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function deleteMatter(Request $request)
    {
        try {

            Matter::destroy($request->matterid);

            return redirect('admin/matters')->with('deletematter', 'Listing Deleted successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
