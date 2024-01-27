<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">   
      
      <div class="user-profile">
          <div class="ulogo">
               <a href="index.html">
                <!-- logo for regular state and mobile devices -->
                   <div class="d-flex align-items-center justify-content-center">                     
                        <img src="{{ asset('') }}images/logo-dark.png" alt="">
                        <h3><b>Inventory</b> Admin</h3>
                   </div>
              </a>
          </div>
      </div>
    
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">  
        
      <li class="{{ $routeName == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>  
      
      {{-- <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Home Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('home.slider.edit') }}"><i class="ti-more"></i>Edit</a></li>
        </ul>
      </li>  --}}

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Supplier</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'suppliers.index' ? 'active' : '' }}"><a href="{{ route('suppliers.index') }}"><i class="ti-more"></i>Suppliers</a></li>
          <li class="{{ $routeName == 'suppliers.create' ? 'active' : '' }}"><a href="{{ route('suppliers.create') }}"><i class="ti-more"></i>Create</a></li>
        </ul>
      </li> 

      @php 
        // dd($routeName);
      @endphp

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Customer</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'customers.index' ? 'active' : '' }}"><a href="{{ route('customers.index') }}"><i class="ti-more"></i>Customers</a></li>
          <li class="{{ $routeName == 'customers.create' ? 'active' : '' }}"><a href="{{ route('customers.create') }}"><i class="ti-more"></i>Create</a></li>
          <li class="{{ $routeName == 'customer.credit' ? 'active' : '' }}"><a href="{{ route('customer.credit') }}"><i class="ti-more"></i>Credit Customers</a></li>
          <li class="{{ $routeName == 'customer.paid' ? 'active' : '' }}"><a href="{{ route('customer.paid') }}"><i class="ti-more"></i>Paid Customers</a></li>
          <li class="{{ $routeName == 'customer.wise.report' ? 'active' : '' }}"><a href="{{ route('customer.wise.report') }}"><i class="ti-more"></i>Customer Wise Report</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Unit</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'units.index' ? 'active' : '' }}"><a href="{{ route('units.index') }}"><i class="ti-more"></i>Units</a></li>
          <li class="{{ $routeName == 'units.create' ? 'active' : '' }}"><a href="{{ route('units.create') }}"><i class="ti-more"></i>Create</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'categories.index' ? 'active' : '' }}"><a href="{{ route('categories.index') }}"><i class="ti-more"></i>Categories</a></li>
          <li class="{{ $routeName == 'categories.create' ? 'active' : '' }}"><a href="{{ route('categories.create') }}"><i class="ti-more"></i>Create</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'products.index' ? 'active' : '' }}"><a href="{{ route('products.index') }}"><i class="ti-more"></i>Products</a></li>
          <li class="{{ $routeName == 'products.create' ? 'active' : '' }}"><a href="{{ route('products.create') }}"><i class="ti-more"></i>Create</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Purchase</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'purchases.index' ? 'active' : '' }}"><a href="{{ route('purchases.index') }}"><i class="ti-more"></i>Purchases</a></li>
          <li class="{{ $routeName == 'purchases.create' ? 'active' : '' }}"><a href="{{ route('purchases.create') }}"><i class="ti-more"></i>Create</a></li>
          <li class="{{ $routeName == 'purchases.pending' ? 'active' : '' }}"><a href="{{ route('purchases.pending') }}"><i class="ti-more"></i>Pending List</a></li>
          <li class="{{ $routeName == 'purchases.daily.report' ? 'active' : '' }}"><a href="{{ route('purchases.daily.report') }}"><i class="ti-more"></i>Purchase Daily Report</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Invoice</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'invoices.index' ? 'active' : '' }}"><a href="{{ route('invoices.index') }}"><i class="ti-more"></i>Invoices</a></li>
          <li class="{{ $routeName == 'invoices.pending.list' ? 'active' : '' }}"><a href="{{ route('invoices.pending.list') }}"><i class="ti-more"></i>Approval Invoice</a></li>
          <li class="{{ $routeName == 'invoices.print.list' ? 'active' : '' }}"><a href="{{ route('invoices.print.list') }}"><i class="ti-more"></i>Print Invoice List</a></li>
          <li class="{{ $routeName == 'invoices.daily.report' ? 'active' : '' }}"><a href="{{ route('invoices.daily.report') }}"><i class="ti-more"></i>Invoice Daily Report</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Stock</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ $routeName == 'stock.report' ? 'active' : '' }}"><a href="{{ route('stock.report') }}"><i class="ti-more"></i>Stock Report</a></li>
          <li class="{{ $routeName == 'stock.supplier.product.wise' ? 'active' : '' }}"><a href="{{ route('stock.supplier.product.wise') }}"><i class="ti-more"></i>Stock Supplier/Product Wise</a></li>
        </ul>
      </li>
        
      <li>
        <a href="#" onclick="event.preventDefault();document.getElementById('LogoutForm').submit();">
          <i data-feather="lock"></i>
          <span>Log Out</span>
        </a>
        <form id="LogoutForm" method="POST" action="{{ route('admin.logout') }}">
            @csrf
        </form>
      </li> 
      
    </ul>
  </section>
  
  <div class="sidebar-footer">
      <!-- item-->
      <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
      <!-- item-->
      <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
      <!-- item-->
      <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
  </div>
</aside>