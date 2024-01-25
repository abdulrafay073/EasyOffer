<?php

namespace App\Http\Controllers\AdminDashboard\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Seller;
use App\Models\Buyer;

use App\Models\FinanceReceivable;
use App\Models\FinanceExpense;

use App\Models\SalesMarketingOrder;
use App\Models\CommercialOrder;
use App\Models\LogisticOrder;
use App\Models\OrderProcessingStages;

class FinanceController extends Controller
{
    public function financeDdashboard(){
        try {
            return view('admin-dashboard.finance.finance-dashboard');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Payment Transaction Tab
    public function paymentTransaction(){
        try {

            $buyers = Buyer::where('is_active', 1)->get();
            $sellers = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.finance.payment-transaction')->with(compact('buyers', 'sellers'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function getpaymentTransactionData($buyer, $seller)
    {
        try {
                       
            $logisticOrder = LogisticOrder::where('customer_contactperson', $buyer)
                                    ->where('supplier_contactperson', $seller)
                                    ->where('is_ready_for_orderprocessing', 1)
                                    ->where('order_processing_cancel', 0)
                                    ->where('status', '=', 'Order Completed')
                                    ->get();

            $dataArray = [];
            if($logisticOrder != null){
                foreach($logisticOrder as $data){

                    $item = OrderProcessingStages::where('logisticorder_id', $data->id)->first();

                    $dataArray[] = [
                        'invoice' => $item->payment_issue_file,
                        'status' => $data->status,
                    ];
                }
            }
            else{
                $dataArray[] = '';
            }

            return response()->json(['data'=>$dataArray]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function getpaymentTransactionData1($seller, $admin)
    {
        try {
                       
            $logisticOrder = LogisticOrder::where('supplier_contactperson', $seller)
                                    ->where('is_ready_for_orderprocessing', 1)
                                    ->where('order_processing_cancel', 0)
                                    ->where('status', '=', 'Order Completed')
                                    ->get();

            $dataArray = [];
            if($logisticOrder != null){
                foreach($logisticOrder as $data){

                    $item = OrderProcessingStages::where('logisticorder_id', $data->id)->first();

                    $dataArray[] = [
                        'margin' => $item->margin_received_file,
                        'status' => $data->status,
                    ];
                }
            }
            else{
                $dataArray[] = '';
            }

            return response()->json(['data'=>$dataArray]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Receivable Tab
    public function receivables(){
        try {

            $data = FinanceReceivable::all();

            return view('admin-dashboard.finance.receivables')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function submitReceivables(Request $request){
        try {

            $user = Auth::user();
            
            // *validation
            $validator = Validator::make($request->all(), [ 
                // 'invoice' => 'required',   
            ]);
            if ($validator->fails()) { 
                return response()->json(
                    [
                        'error'=>$validator->errors(),
                        'message'=>$validator->errors()->first()
                    ], 
                    $this->badRequest
                );            
            }

            // checkinvoice
            if(isset($request->invoice)){ 
                $doc = $request->invoice->store('public/FinanceReceivableInvoice');
                $doc = '/storage' . substr($doc,6);
            }   
            else{
                $doc = ""; 
            }

            $data = FinanceReceivable::create(
                [
                    'invoice_file' => $doc,
                    'remaining' => $request->remaining,   
                    'received' => $request->received,  
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]
            );
            
            return redirect('admin/receivables')->with('receivable', 'Receivable has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Expense Tab
    public function expenses(){
        try {

            $data = FinanceExpense::all();

            return view('admin-dashboard.finance.expenses')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function submitExpenses(Request $request){
        try {

            $user = Auth::user();
            
            // *validation
            $validator = Validator::make($request->all(), [ 
                // 'expensetype' => 'required',   
            ]);
            if ($validator->fails()) { 
                return response()->json(
                    [
                        'error'=>$validator->errors(),
                        'message'=>$validator->errors()->first()
                    ], 
                    $this->badRequest
                );            
            }


            $data = FinanceExpense::create(
                [
                    'expense_type' => $request->exptype,
                    'amount' => $request->amount,   
                    'datetime' => $request->datetime,  
                    'person' => $request->person,  
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]
            );
            
            return redirect('admin/expenses')->with('expense', 'Expenses has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}