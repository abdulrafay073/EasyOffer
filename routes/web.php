<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;

//Admin
use App\Http\Controllers\AdminDashboard\AdminDashboardController;
use App\Http\Controllers\AdminDashboard\General\GeneralController;
use App\Http\Controllers\AdminDashboard\Commercial\CommercialController;
use App\Http\Controllers\AdminDashboard\OrderProcessing\OrderProcessingController;
use App\Http\Controllers\AdminDashboard\Finance\FinanceController;
use App\Http\Controllers\AdminDashboard\ImportantMatter\MatterController;
use App\Http\Controllers\AdminDashboard\SalesAndMarketing\SalesAndMarketingController;
use App\Http\Controllers\AdminDashboard\Logistics\LogisticsController;
use App\Http\Controllers\AdminDashboard\SystemSetting\SystemSettingController;
use App\Http\Controllers\AdminDashboard\Notification\NotificationController;
use App\Http\Controllers\AdminDashboard\OrderPossibility\OrderPossibilityController;
//Seller
use App\Http\Controllers\SellerDashboard\SellerDashboardController;
use App\Http\Controllers\SellerDashboard\Deals\SellerDealsController;
use App\Http\Controllers\SellerDashboard\Bids\SellerBidsController;
use App\Http\Controllers\SellerDashboard\Listing\SellerListingController;
use App\Http\Controllers\SellerDashboard\Profile\SellerProfileController;

//Buyer
use App\Http\Controllers\BuyerDashboard\BuyerDashboardController;
use App\Http\Controllers\BuyerDashboard\Deals\BuyerDealsController;
use App\Http\Controllers\BuyerDashboard\Listing\BuyerListingController;
use App\Http\Controllers\BuyerDashboard\Profile\BuyerProfileController;
use App\Http\Controllers\BuyerDashboard\MakeRequest\BuyerMakeRequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});
// Route::get('/check-useremail/{email}', [RegisterController::class, 'checkUserEmail']);  //ajax call


Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {   //Group Routes For Admin Dashboard

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');

    // ******************************** General Module ******************************** 
    // Seller Tab
    Route::get('/sellers', [GeneralController::class, 'sellers'])->name('sellers');
    Route::get('/seller-viewdetail/{id}', [GeneralController::class, 'sellerViewDetail'])->name('seller-viewdetail');
    Route::get('/seller-edit/{id}', [GeneralController::class, 'sellerEdit'])->name('seller-edit');
    Route::post('/seller-editSubmit', [GeneralController::class, 'sellerEditSubmit'])->name('seller-editSubmit');
    Route::post('/seller-rating', [GeneralController::class, 'sellerRating'])->name('seller-rating');
    Route::post('/seller-remove', [GeneralController::class, 'sellerRemove'])->name('seller-remove');

    // Seller-Request Tab
    Route::get('/seller-requests', [GeneralController::class, 'sellerRequests'])->name('seller-requests');
    Route::post('/seller-requests-accept', [GeneralController::class, 'sellerAccept'])->name('seller-accept');
    Route::post('/seller-requests-reject', [GeneralController::class, 'sellerReject'])->name('seller-reject');

    // Buyer Tab
    Route::get('/buyers', [GeneralController::class, 'buyers'])->name('buyers');
    Route::get('/buyer-viewdetail/{id}', [GeneralController::class, 'buyerViewDetail'])->name('buyer-viewdetail');
    Route::get('/buyer-edit/{id}', [GeneralController::class, 'buyerEdit'])->name('buyer-edit');
    Route::post('/buyer-editSubmit', [GeneralController::class, 'buyerEditSubmit'])->name('buyer-editSubmit');
    Route::post('/buyer-rating', [GeneralController::class, 'buyerRating'])->name('buyer-rating');
    Route::post('/buyer-remove', [GeneralController::class, 'buyerRemove'])->name('buyer-remove');

    // Buyer-Request Tab
    Route::get('/buyer-requests', [GeneralController::class, 'buyerRequests'])->name('buyer-requests');
    Route::post('/buyer-requests-accept', [GeneralController::class, 'buyerAccept'])->name('buyer-accept');
    Route::post('/buyer-requests-reject', [GeneralController::class, 'buyerReject'])->name('buyer-reject');

    // ******************************** Commercial Module ******************************** 
    // Current-Request Tab
    Route::get('/current-requests', [CommercialController::class, 'currentRequests'])->name('com-current-requests');
    Route::get('/current-requests-excelexport', [CommercialController::class, 'currentRequestExcelExport'])->name('com-current-requests-excelexport');
    Route::get('/current-viewdetail/{id}', [CommercialController::class, 'currentViewDetail'])->name('com-current-viewdetail');
    Route::get('/current-viewhistory/{id}', [CommercialController::class, 'currentViewHistory'])->name('com-current-history');
    Route::get('/current-viewhistorysearch/{pname}/{buyerid}', [CommercialController::class, 'currentViewHistorySearch']);
    Route::get('/current-viewhistory-excelexport/{id}', [CommercialController::class, 'currentViewHistoryExcelExport'])->name('com-current-viewhistory-excelexport');
    Route::get('/current-viewhistorydetail/{id}', [CommercialController::class, 'currentViewHistoryDetail'])->name('com-current-viewhistorydetail');
    Route::get('/com-current-requests-direct-quotation/{id}', [CommercialController::class, 'currentRequestsDirectQuotation'])->name('com-current-requests-direct-quotation');
    Route::post('/com-current-requests-direct-quotation-proceed', [CommercialController::class, 'currentRequestsDirectQuotationSubmit'])->name('com-current-requests-direct-quotation-proceed');

    Route::get('/current-requests-proceed/{id}', [CommercialController::class, 'currentRequestsProceed'])->name('com-current-requests-proceed');
    Route::post('/current-requests-proceed-submit', [CommercialController::class, 'currentRequestsProceedSubmit'])->name('com-crp-submit');    // crp = current requests proceed
    Route::get('/current-requests-placebid/{id}', [CommercialController::class, 'currentRequestsPlacedBid'])->name('com-current-requests-placebid');
    Route::get('/current-requests-placebid-view-detail/{id}', [CommercialController::class, 'currentRequestsPlacedBidViewDetail'])->name('com-current-requests-placebid-viewdetail');
    Route::post('/current-requests-placebid-proceed', [CommercialController::class, 'currentRequestsPlacedBidProceed'])->name('com-current-requests-placebid-proceed');
    Route::post('/current-requests-reject', [CommercialController::class, 'currentRequestReject'])->name('com-current-requests-reject');

    // Sample-Request Tab
    Route::get('/sample-requests', [CommercialController::class, 'sampleRequests'])->name('sample-requests');
    Route::get('/sample-viewdetail/{id}', [CommercialController::class, 'sampleViewDetail'])->name('sample-viewdetail');
    Route::get('/sample-requests-proceed/{id}', [CommercialController::class, 'sampleRequestsProceed'])->name('sample-requests-proceed');
    Route::post('/sample-requests-proceed-submit', [CommercialController::class, 'sampleRequestsProceedSubmit'])->name('srp-submit');    // srp = sample requests proceed
    Route::post('/sample-requests-reject', [CommercialController::class, 'sampleRequestReject'])->name('sample-requests-reject');

    // InProcess-Request Tab
    Route::get('/inprocess-requests', [CommercialController::class, 'inprocessRequests'])->name('inprocess-requests');
    Route::get('/inprocess-viewdetail/{id}', [CommercialController::class, 'inprocessViewDetail'])->name('inprocess-viewdetail');
    Route::get('/inprocess-viewbid/{id}', [CommercialController::class, 'inprocessViewBid'])->name('inprocess-viewbid');
    Route::get('/inprocess-viewbid-detail/{id}', [CommercialController::class, 'inprocessViewBidDetail'])->name('inprocess-viewbid-detail');
    Route::post('/inprocess-viewbid-proceed', [CommercialController::class, 'inprocessViewBidProceed'])->name('inprocess-viewbid-proceed');
    Route::post('/inprocess-viewbid-delete', [CommercialController::class, 'inprocessViewBidDelete'])->name('inprocess-viewbid-delete');
    Route::get('/inprocess-viewbid-response/{id}', [CommercialController::class, 'inprocessViewBidResponse']);  //ajax call
    Route::post('/inprocess-viewbid-sendresponse', [CommercialController::class, 'inprocessViewBidSendResponse'])->name('inprocess-viewbid-sendresponse');

    //Rejected-Request Tab
    Route::get('/rejected-requests', [CommercialController::class, 'rejectedRequests'])->name('rejected-requestss');
    Route::get('/rejected-viewdetail/{id}', [CommercialController::class, 'rejectedViewDetail'])->name('rejected-viewdetail');

    //Quotation Tab
    Route::get('/quotations', [CommercialController::class, 'getQuotations'])->name('quotations');
    Route::get('/quotation-viewdetail/{id}', [CommercialController::class, 'quotationViewDetail'])->name('quotation-viewdetail');
    Route::post('/quotation-forward-to-buyers', [CommercialController::class, 'quotationsForwardToBuyer'])->name('quotation-forward-to-buyers');

    //Quotation Response Tab
    Route::get('/quotations-response', [CommercialController::class, 'getQuotationResponse'])->name('quotations-response');
    Route::get('/quotation-response-viewdetail/{id}', [CommercialController::class, 'quotationResponseViewDetail'])->name('quotation-response-viewdetail');

    // Order-Confirmation Tab
    Route::get('/order-confirmation-list', [CommercialController::class, 'index'])->name('order-confirmation-list');
    Route::get('/order-viewdetail/{id}', [CommercialController::class, 'orderViewDetail'])->name('order-viewdetail');
    Route::post('/order-confirmation-submit', [CommercialController::class, 'orderConfirmationSubmit'])->name('order-confirmation-submit');


    // ******************************** Order Processing Module ******************************** 
    // Running-Deals Tab
    Route::get('/running-deals', [OrderProcessingController::class, 'runningDeals'])->name('running-deals');
    Route::get('/running-deal-viewdetail/{id}', [OrderProcessingController::class, 'runningDealViewDetail'])->name('running-deals-viewdetail');
    Route::post('/running-deal-cancel', [OrderProcessingController::class, 'runningDealsCancel'])->name('running-deals-cancel');

    // Canceled-Deals Tab
    Route::get('/canceled-deals', [OrderProcessingController::class, 'canceledDeals'])->name('canceled-deals');
    Route::get('/canceled-deal-viewdetail/{id}', [OrderProcessingController::class, 'canceledDealViewDetail'])->name('canceled-deals-viewdetail');

    // Completed-Deals Tab
    Route::get('/completed-deals', [OrderProcessingController::class, 'completedDeals'])->name('completed-deals');
    Route::get('/completed-deal-viewdetail/{id}', [OrderProcessingController::class, 'completedDealViewDetail'])->name('completed-deals-viewdetail');


    // ******************************** Finance Module ******************************** 
    // Finance-Dashboard Tab
    Route::get('/finance', [FinanceController::class, 'financeDdashboard'])->name('finance-dashboard');

    // Payment-Transaction Tab
    Route::get('/payment-transaction', [FinanceController::class, 'paymentTransaction'])->name('payment-transaction');
    Route::get('/payment-transaction-data/{buyer}/{seller}', [FinanceController::class, 'getpaymentTransactionData']);  //ajax call
    Route::get('/payment-transaction-data1/{seller}/{admin}', [FinanceController::class, 'getpaymentTransactionData1']);  //ajax call

    // Receivables Tab
    Route::get('/receivables', [FinanceController::class, 'receivables'])->name('receivables');
    Route::post('/submit-receivables', [FinanceController::class, 'submitReceivables'])->name('submit-receivables');

    // Expenses Tab
    Route::get('/expenses', [FinanceController::class, 'expenses'])->name('expenses');
    Route::post('/submit-expenses', [FinanceController::class, 'submitExpenses'])->name('submit-expenses');


    // ******************************** Sales And Marketing Module ******************************** 
    // Buyers Tab
    Route::get('/sale-buyers', [SalesAndMarketingController::class, 'saleBuyers'])->name('sale-buyer');

    // Make Request Tab
    Route::get('/sale-make-request', [SalesAndMarketingController::class, 'saleMakeRequest'])->name('sale-make-request');
    Route::post('/sale-make-request', [SalesAndMarketingController::class, 'saleMakeRequestSubmit'])->name('sale-makerequest-submit');

    // Forwarded Quotation Request Tab
    Route::get('/sale-quotation-request', [SalesAndMarketingController::class, 'saleQuotationRequest'])->name('sale-quotation-request');
    Route::get('/sale-quotation-viewdetail/{id}', [SalesAndMarketingController::class, 'saleQuotationViewDetail'])->name('sale-quotation-viewdetails');
    Route::get('/sale-quotation-viewbids/{id}', [SalesAndMarketingController::class, 'saleQuotationViewBid'])->name('sale-quotation-viewbids');

    // Listing Tab
    Route::get('/sale-priority-product-list', [SalesAndMarketingController::class, 'salePriorityProductList'])->name('sale-priority-product-list');
    Route::get('/sale-priority-product-search', [SalesAndMarketingController::class, 'salePriorityProductSearch'])->name('sale-priority-product-search');

    // InProcess Request Tab
    Route::get('/sale-inprocess-request', [SalesAndMarketingController::class, 'saleInProcessRequest'])->name('sale-inprocess-request');

    // Request Detail Tab
    Route::get('/sale-request-detail', [SalesAndMarketingController::class, 'saleRequestDetail'])->name('sale-request-detail');

    // Order Confirmation Form Tab
    Route::get('/sale-order-confirmation', [SalesAndMarketingController::class, 'saleOrder'])->name('sale-order-confirmation');
    Route::post('/sale-order-confirmation', [SalesAndMarketingController::class, 'saleOrderSubmit'])->name('sale-order-confirmation-submit');

    // Running Deals Tab
    Route::get('/sale-running-deal', [SalesAndMarketingController::class, 'saleRunningDeals'])->name('sale-running-deals');

    // Email Marketing Tab
    Route::get('/sale-email-marketing', [SalesAndMarketingController::class, 'saleEmailMarketing'])->name('sale-email-marketing');

    // Previous Email Tab
    Route::get('/sale-previous-email', [SalesAndMarketingController::class, 'salePreviousEmail'])->name('sale-previous-email');


    // ******************************** Logistics Module ******************************** 
    // Logistics Tab
    Route::get('/logistic-orders', [LogisticsController::class, 'logisticOrders'])->name('logistics-orders');
    Route::get('/logistic-order-viewdetails/{id}', [LogisticsController::class, 'orderViewDetails'])->name('logistics-order-viewdetails');
    Route::post('/logistic-order-confirmation', [LogisticsController::class, 'logisticOrderSubmit'])->name('logistics-order-confirmation-submit');


    // ******************************** Important Matter Module ******************************** 
    Route::get('/new-matter', [MatterController::class, 'index'])->name('new-matter');
    Route::post('/create-matter', [MatterController::class, 'createMatter'])->name('create-matter');
    Route::get('/matters', [MatterController::class, 'getMatterListing'])->name('matters');
    Route::get('/update-matter/{id}', [MatterController::class, 'getMatterData'])->name('update-matter');
    Route::post('/update-matter', [MatterController::class, 'updateMatter'])->name('submit-update-matter');
    Route::get('/delete-matter/{id}', [MatterController::class, 'getMatterDataDel'])->name('delete-matter');
    Route::post('/delete-matter', [MatterController::class, 'deleteMatter'])->name('submit-delete-matter');


    // ******************************** Order Possibility Module ******************************** 
    Route::get('/order-buyer-by-inquiry', [OrderPossibilityController::class, 'orderPossibilityBuyerByInquiry'])->name('order-buyer-by-inquiry');
    Route::get('/order-buyer-by-order', [OrderPossibilityController::class, 'orderPossibilityBuyerByOrder'])->name('order-buyer-by-order');
    Route::get('/order-seller-by-order', [OrderPossibilityController::class, 'orderPossibilitySellerByOrder'])->name('order-seller-by-order');
    Route::get('/order-product-by-inquiry', [OrderPossibilityController::class, 'orderPossibilityProductByInquiry'])->name('order-product-by-inquiry');

    // ******************************** System Settings Module ******************************** 
    // Terms And Conditions Tab
    Route::get('/terms-and-conditions', [SystemSettingController::class, 'termsAndConditions'])->name('terms-and-conditions');

    // Roles Management Tab
    Route::get('/roles-management', [SystemSettingController::class, 'rolesManagement'])->name('roles-management');

    // Payment Method Management Tab
    Route::get('/payment-method-management', [SystemSettingController::class, 'paymentMethodManagement'])->name('payment-method-management');

    // Shipping Method Management Tab
    Route::get('/shipping-method-management', [SystemSettingController::class, 'shippingMethodManagement'])->name('shipping-method-management');


    // ******************************** Chat Module ******************************** 


    // ******************************** Notification Module ******************************** 
    //Notification Tab
    Route::get('/notification', [NotificationController::class, 'notification'])->name('admin-notification');
});


Route::group(['middleware' => ['is_buyer'], 'prefix' => 'buyer'], function () {   //Group Routes For Buyer Dashboard

    Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('buyer-dashboard');

    // ******************************** Deals Module ******************************** 
    Route::get('/current-deals', [BuyerDealsController::class, 'currentDeals'])->name('current-deals');
    Route::get('/current-deal-viewdetail/{id}', [BuyerDealsController::class, 'currentDealViewDetail'])->name('current-deals-viewdetails');
    Route::post('/sale-confirm', [BuyerDealsController::class, 'saleConfirm'])->name('sale-confirm');
    Route::post('/sale-cancel', [BuyerDealsController::class, 'saleCancel'])->name('sale-cancel');
    Route::post('/lc-issue', [BuyerDealsController::class, 'lcIssue'])->name('lc-issue');
    Route::post('/payment-issue', [BuyerDealsController::class, 'paymentIssue'])->name('payment-issue');
    Route::post('/material-confirmation', [BuyerDealsController::class, 'materialConfirmation'])->name('material-confirmation');
    Route::post('/margin-received', [BuyerDealsController::class, 'marginReceived'])->name('margin-received');
    Route::post('/feedback', [BuyerDealsController::class, 'feedback'])->name('feedback');

    // Current Request Tab
    Route::get('/current-requests', [BuyerDealsController::class, 'currentRequests'])->name('current-requests');
    Route::get('/current-viewdetail/{id}', [BuyerDealsController::class, 'currentViewDetail'])->name('current-viewdetails');
    Route::get('/current-viewbids/{id}', [BuyerDealsController::class, 'currentViewBid'])->name('current-viewbids');
    Route::get('/current-viewbid-details/{id}', [BuyerDealsController::class, 'currentViewBidDetail'])->name('current-viewbid-details');
    Route::post('/current-bid-accept', [BuyerDealsController::class, 'currentBidAccept'])->name('current-bid-accepts');
    Route::post('/current-bid-rebid', [BuyerDealsController::class, 'currentBidReBid'])->name('current-bid-rebids');
    Route::post('/current-bid-reject', [BuyerDealsController::class, 'currentBidReject'])->name('current-bid-rejects');

    // Pending Request Tab
    Route::get('/pending-requests', [BuyerDealsController::class, 'pendingRequests'])->name('pending-requests');
    Route::get('/pending-viewdetail/{id}', [BuyerDealsController::class, 'pendingViewDetail'])->name('pending-viewdetails');
    Route::post('/delete-make-request', [BuyerDealsController::class, 'deleteMakeRequest'])->name('delete-make-request');

    // Rejected Request Tab
    Route::get('/rejected-requests', [BuyerDealsController::class, 'rejectedRequests'])->name('rejected-requests');
    Route::get('/rejected-viewdetail/{id}', [BuyerDealsController::class, 'rejectedViewDetail'])->name('rejected-viewdetails');
    Route::get('/rejected-re-request/{id}', [BuyerDealsController::class, 'rejectedReRequest'])->name('rejected-re-requests');
    Route::post('/rejected-re-request-submit', [BuyerDealsController::class, 'rejectedReRequestSubmit'])->name('rejected-re-requests-submit');

    // ******************************** Make Request Module ******************************** 
    Route::get('/make-request', [BuyerMakeRequestController::class, 'index']);
    Route::post('/make-request', [BuyerMakeRequestController::class, 'createRequest'])->name('create-request');


    // ******************************** Listing Module ******************************** 
    Route::get('/create-listing', [BuyerListingController::class, 'index']);
    Route::post('/create-listing', [BuyerListingController::class, 'createListing'])->name('create-listings');
    Route::get('/listings', [BuyerListingController::class, 'getListing'])->name('listings');
    Route::get('/update-listing/{id}', [BuyerListingController::class, 'getListingData'])->name('update-listings');
    Route::post('/update-listing', [BuyerListingController::class, 'updateListing'])->name('submit-editlistings');
    Route::get('/delete-listing/{id}', [BuyerListingController::class, 'getListingDataDel'])->name('delete-listings');
    Route::post('/delete-listing', [BuyerListingController::class, 'deleteListing'])->name('submit-dellistings');
    Route::post('/excel-listing', [BuyerListingController::class, 'excelListing'])->name('excel-listings');

    Route::get('/notification', [BuyerDashboardController::class, 'notification'])->name('notifications');

    // ******************************** Profile Module ******************************** 
    Route::get('/update-profile', [BuyerProfileController::class, 'index']);
    Route::post('/update-profile', [BuyerProfileController::class, 'updateProfile'])->name('update-profiles');
    Route::get('/check-password/{password}', [BuyerProfileController::class, 'checkUserPassword']);  //ajax call

});


Route::group(['middleware' => ['is_seller'], 'prefix' => 'seller'], function () {   //Group Routes For Seller Dashboard

    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('seller-dashboard');

    // ******************************** Deals Module ******************************** 
    // Current Deals Tab
    Route::get('/current-deals', [SellerDealsController::class, 'currentDeals'])->name('current-deal');
    Route::get('/current-deal-viewdetail/{id}', [SellerDealsController::class, 'currentDealViewDetail'])->name('current-deals-viewdetail');
    Route::post('/purchase-confirm', [SellerDealsController::class, 'purchaseConfirm'])->name('purchase-confirm');
    Route::post('/purchase-cancel', [SellerDealsController::class, 'purchaseCancel'])->name('purchase-cancel');
    Route::post('/shipment-docs', [SellerDealsController::class, 'shipmentDocs'])->name('shipment-docs');

    // Current Requests Tab
    Route::get('/current-requests', [SellerDealsController::class, 'currentRequests'])->name('current-request');
    Route::get('/current-viewdetail/{id}', [SellerDealsController::class, 'currentViewDetail'])->name('current-viewdetail');
    Route::get('/current-placedbid/{id}', [SellerDealsController::class, 'currentPlacedBid'])->name('current-placedbid');
    Route::post('/current-placedbid-submit', [SellerDealsController::class, 'currentRequestSubmit'])->name('current-requests-submit');
    Route::post('/current-requests-reject', [SellerDealsController::class, 'currentRequestReject'])->name('current-requests-reject');


    // ******************************** Bids Module ******************************** 
    //not use
    Route::get('/make-bids', [SellerDashboardController::class, 'createBid'])->name('create-bid');     //not use
    Route::get('/placed-bids', [SellerDashboardController::class, 'placedBids'])->name('placed-bids'); //not use

    // Pending Bids Tab
    Route::get('/pending-bids', [SellerBidsController::class, 'pendingBids'])->name('pending-bid');
    Route::get('/pending-bids-detail/{id}', [SellerBidsController::class, 'pendingBidDetail'])->name('pending-bid-detail');
    Route::post('/pending-bids-cancel', [SellerBidsController::class, 'pendingBidCancel'])->name('pending-bid-cancel');

    // Current Bids Tab
    Route::get('/current-bids', [SellerBidsController::class, 'currentBids'])->name('current-bid');
    Route::get('/current-bids-detail/{id}', [SellerBidsController::class, 'currentBidDetail'])->name('current-bid-detail');
    Route::get('/current-bids-response/{id}', [SellerBidsController::class, 'currentBidResponse']);  //ajax call


    // ******************************** Listing Module ******************************** 
    Route::get('/create-listing', [SellerListingController::class, 'index']);
    Route::post('/create-listing', [SellerListingController::class, 'createListing'])->name('create-listing');
    Route::get('/listing', [SellerListingController::class, 'getListing'])->name('listing');
    Route::get('/update-listing/{id}', [SellerListingController::class, 'getListingData'])->name('update-listing');
    Route::post('/update-listing', [SellerListingController::class, 'updateListing'])->name('submit-editlisting');
    Route::get('/delete-listing/{id}', [SellerListingController::class, 'getListingDataDel'])->name('delete-listing');
    Route::post('/delete-listing', [SellerListingController::class, 'deleteListing'])->name('submit-dellisting');
    Route::post('/excel-listing', [SellerListingController::class, 'excelListing'])->name('excel-listing');

    Route::get('/notification', [SellerDashboardController::class, 'notification'])->name('notification');


    // ******************************** Profile Module ******************************** 
    Route::get('/update-profile', [SellerProfileController::class, 'index']);
    Route::post('/update-profile', [SellerProfileController::class, 'updateProfile'])->name('update-profile');
    Route::get('/check-password/{password}', [SellerProfileController::class, 'checkUserPassword']);  //ajax call

});
