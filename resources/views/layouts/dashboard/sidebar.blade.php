 <!-- sidebar section -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
         <?php if (auth()->user()->role_id == 2) { ?>
             <a class="sidebar-brand brand-logo" href="{{ route('buyer-dashboard') }}"><img src="{{ asset('images/logo1.png') }}" alt="logo" /></a>
             <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('buyer-dashboard') }}"><img src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a>
         <?php } else if (auth()->user()->role_id == 3) { ?>
             <a class="sidebar-brand brand-logo" href="{{ route('seller-dashboard') }}"><img src="{{ asset('images/logo1.png') }}" alt="logo" /></a>
             <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('seller-dashboard') }}"><img src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a>
         <?php } else { ?>
             <a class="sidebar-brand brand-logo" href="{{ route('admin-dashboard') }}"><img src="{{ asset('images/logo1.png') }}" alt="logo" /></a>
             <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('admin-dashboard') }}"><img src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a>
         <?php } ?>
     </div>
     <ul class="nav mt-3">
         <li class="nav-item nav-profile">
             <a href="#" class="nav-link">
                 <div class="nav-profile-image">

                     <?php if (auth()->user()->role_id == 2) { ?>
                         <img src="{{ asset('images/faces/face16.jpg') }}" alt="profile" />
                     <?php } else if (auth()->user()->role_id == 3) { ?>
                         <img src="{{ asset('images/faces/face17.jpg') }}" alt="profile" />
                     <?php } else { ?>
                         <img src="{{ asset('images/faces/face21.jpg') }}" alt="profile" />
                     <?php } ?>

                     <span class="login-status online"></span>
                 </div>
                 <div class="nav-profile-text d-flex flex-column pr-3">
                     <?php $name = auth()->user()->name ?>
                     <span class="font-weight-medium mb-2">{{ $name }}</span>
                     <span class="font-weight-normal">$8,753.00</span>
                 </div>
                 <!-- <span class="badge badge-danger text-white ml-3 rounded">3</span> -->
             </a>
         </li>

         <!-- Buyer Menu -->
         <?php if (auth()->user()->role_id == 2) { ?>

             <li class="nav-item">
                 <a class="nav-link" href="{{ route('buyer-dashboard') }}">
                     <i class="mdi mdi-home menu-icon"></i>
                     <span class="menu-title">Dashboard</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-briefcase-check menu-icon"></i>
                     <span class="menu-title">Deals</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('current-deals') }}">Current Deals</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('current-requests') }}">Current Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('pending-requests') }}">Pending Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('rejected-requests') }}">Rejected Requests</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('create-request') }}">
                     <i class="mdi mdi-dns menu-icon"></i>
                     <span class="menu-title">Make Request</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#listing" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-hamburger menu-icon"></i>
                     <span class="menu-title">Listing</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="listing">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('create-listings') }}">Make Listing</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('listings') }}">View Listings</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#">
                     <i class="mdi mdi-video-input-component menu-icon"></i>
                     <span class="menu-title">Chat</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('notifications') }}">
                     <i class="mdi mdi-repeat menu-icon"></i>
                     <span class="menu-title">Notification</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('update-profiles') }}">
                     <i class="mdi mdi-face menu-icon"></i>
                     <span class="menu-title">Profile</span>
                 </a>
             </li>
             <li class="nav-item">
                 <span class="nav-link" href="#">
                     <i class="mdi mdi-logout-variant menu-icon"></i>
                     <span class="menu-title">
                         <a href="{{ route('logout') }}" class="text-black" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="text-decoration:none">Sign Out
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </span>
                 </span>
             </li>

             <!-- Seller Menu -->
         <?php } else if (auth()->user()->role_id == 3) { ?>

             <li class="nav-item">
                 <a class="nav-link" href="{{ route('seller-dashboard') }}">
                     <i class="mdi mdi-home menu-icon"></i>
                     <span class="menu-title">Dashboard</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-briefcase-check menu-icon"></i>
                     <span class="menu-title">Deals</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('current-deal') }}">Current Deals</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('current-request') }}">Current Requests</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item" hidden>
                 <a class="nav-link" href="{{ route('create-bid') }}">
                     <i class="mdi mdi-dns menu-icon"></i>
                     <span class="menu-title">Make Bid</span>
                 </a>
             </li>
             <div class="nav-item" hidden>
                 <a class="nav-link" href="{{ route('placed-bids') }}">
                     <i class="mdi mdi-bank menu-icon"></i>
                     <span class="menu-title">Placed Bids</span>
                 </a>
             </div>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-bids" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-bank menu-icon"></i>
                     <span class="menu-title">Quotation</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-bids">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('current-bid') }}">Current Quotations</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('pending-bid') }}">Pending Quotations</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#listing" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-hamburger menu-icon"></i>
                     <span class="menu-title">Listing</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="listing">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('create-listing') }}">Make Listing</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('listing') }}">View Listings</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#">
                     <i class="mdi mdi-video-input-component menu-icon"></i>
                     <span class="menu-title">Chat</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('notification') }}">
                     <i class="mdi mdi-repeat menu-icon"></i>
                     <span class="menu-title">Notification</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('update-profile') }}">
                     <i class="mdi mdi-face menu-icon"></i>
                     <span class="menu-title">Profile</span>
                 </a>
             </li>
             <li class="nav-item">
                 <span class="nav-link" href="#">
                     <i class="mdi mdi-logout-variant menu-icon"></i>
                     <span class="menu-title">
                         <a href="{{ route('logout') }}" class="text-black" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="text-decoration:none">Sign Out
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </span>
                 </span>
             </li>

             <!-- Admin Menu -->
         <?php } else { ?>

             <li class="nav-item">
                 <a class="nav-link" href="{{ route('admin-dashboard') }}">
                     <i class="mdi mdi-home menu-icon"></i>
                     <span class="menu-title">Dashboard</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-cards-variant menu-icon"></i>
                     <span class="menu-title">General</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-basic">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sellers') }}">Sellers</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('seller-requests') }}">Seller Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('buyers') }}">Buyers</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('buyer-requests') }}">Buyer Requests</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-com" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-briefcase-check menu-icon"></i>
                     <span class="menu-title">Commercial</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-com">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('com-current-requests') }}">Current Requests</a>
                         </li>
                         <li class="nav-item" hidden>
                             <a class="nav-link" href="{{ route('sample-requests') }}">Sample Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('inprocess-requests') }}">InProcess Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('rejected-requestss') }}">Rejected Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('quotations') }}">Quotations</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('quotations-response') }}">Quotations Response</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('order-confirmation-list') }}">Order Confirmation Form</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-op" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-cart menu-icon"></i>
                     <span class="menu-title">Order Processing</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-op">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('running-deals') }}">Running Deals</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('canceled-deals') }}">Canceled Deals</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('completed-deals') }}">Completed Deals</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-finance" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-finance menu-icon"></i>
                     <span class="menu-title">Finance</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-finance">
                     <ul class="nav flex-column sub-menu">
                         <!-- <li class="nav-item">
                         <a class="nav-link" href="{{ route('finance-dashboard') }}">Finance Dashboard</a>
                     </li> -->
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('payment-transaction') }}">Payment Transactions</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('receivables') }}">Receivables</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('expenses') }}">Expenses</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-sm" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-sale menu-icon"></i>
                     <span class="menu-title">Sales And Marketing</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-sm">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-buyer') }}">Buyers</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-make-request') }}">Make Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-quotation-request') }}">Quotation Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-priority-product-list') }}">Priority Product List</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-inprocess-request') }}">InProcess Requests</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-request-detail') }}">Request Details</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-order-confirmation') }}">Order Confirmation Form</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-running-deals') }}">Running Deals</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-email-marketing') }}">Email marketing</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('sale-previous-email') }}">Previous Emails</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-logistics" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-dip-switch menu-icon"></i>
                     <span class="menu-title">Logistics</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-logistics">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('logistics-orders') }}">Order Confirmation Form</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-matter" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-hexagon-multiple menu-icon"></i>
                     <span class="menu-title">Important Matter</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-matter">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('new-matter') }}">New Matter</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('matters') }}">View Matters</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-order" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-checkbox-marked-circle menu-icon"></i>
                     <span class="menu-title">Order Possibility</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-order">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('order-buyer-by-inquiry') }}">Buyer by Inquiry</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('order-buyer-by-order') }}">Buyer by Order</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('order-seller-by-order') }}">Seller By Order</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('order-product-by-inquiry') }}">Product By Inquiry</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="collapse" href="#ui-ss" aria-expanded="false" aria-controls="ui-basic">
                     <i class="mdi mdi-message-settings-variant menu-icon"></i>
                     <span class="menu-title">System Settings</span>
                     <i class="menu-arrow"></i>
                 </a>
                 <div class="collapse" id="ui-ss">
                     <ul class="nav flex-column sub-menu">
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('terms-and-conditions') }}">Terms And Conditions</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('roles-management') }}">Roles Management</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('payment-method-management') }}">Payment Method
                                 Management</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('shipping-method-management') }}">Shipping Method
                                 Management</a>
                         </li>
                     </ul>
                 </div>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="">
                     <i class="mdi mdi-video-input-component menu-icon"></i>
                     <span class="menu-title">Chat</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="{{ route('admin-notification') }}">
                     <i class="mdi mdi-repeat menu-icon"></i>
                     <span class="menu-title">Notification</span>
                 </a>
             </li>
             <li class="nav-item">
                 <span class="nav-link" href="#">
                     <i class="mdi mdi-logout-variant menu-icon"></i>
                     <span class="menu-title">
                         <a href="{{ route('logout') }}" class="text-black" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="text-decoration:none">Sign Out
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </span>
                 </span>
             </li>

         <?php } ?>

     </ul>
 </nav>