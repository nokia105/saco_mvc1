<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        
        </li>

        <li class="treeview">
          <a href="#">
            <i class=" fa fa-group"></i>
            <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="{{route('registerform')}}">
            <i class="fa fa-registered"></i> <span>New Member</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

           <li class="">
          <a href="{{route('register_excel')}}">
            <i class="fa fa-registered"></i> <span> Upload Members</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{route('inactive_members')}}">
            <i class="fa fa-user-circle-o"></i> <span> Inactive Members</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{route('active_members')}}">
            <i class="fa fa-user-circle-o"></i> <span>Active Members</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

     </ul>
   </li>

    <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Loans</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

              @role('Cashier|Secretary','member')

             <li class="">
          <a href="{{url('/drafted_loans')}}">
            <i class="fa fa-archive"></i> <span>Draft</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        @endrole
             <li class="">
          <a href="{{url('/newloans_received')}}">
            <i class="fa fa-archive"></i> <span>Submitted</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

          <li class="">
          <a href="{{url('/processed_loans')}}">
            <i class="fa fa-archive"></i> <span>On progress</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="{{url('/approved_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Approved</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>     
        </li>

         <li class="">
          <a href="{{url('/rejected_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Rejected</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
        </li>

         <li class="">
          <a href="{{route('provisioned_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Provisioned</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
        </li>


         <li class="">
          <a href="{{route('aging_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Aging</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
        </li>

         

          <li class="">
          <a href="{{url('/pending_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Pending </span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
          </ul>
        </li>
  <li class="header">PAYMENTS</li>

    <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Payments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

               <li class="">
          <a href="{{url('/unpaid_vouchers')}}">
            <i class="fa fa-briefcase"></i> <span>Pending Voucher</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>     
        </li>

        <li class="">
          <a href="{{url('/ready_vouchers')}}">
            <i class="fa fa-briefcase"></i> <span>Approved Voucher</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>     
        </li>

          <li class="">
          <a href="{{url('/paid_loans')}}">
            <i class="fa fa-briefcase"></i> <span>Paid Vouchers</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
      
             <li class="">
          <a href="{{url('/Expenses')}}">
            <i class="fa fa-briefcase"></i> <span>Expenses</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
        </li>
         
       <li class="">
          <a href="{{route('member_payment')}}">
            <i class="fa fa-briefcase"></i> <span>Make payment</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{route('allpayments')}}">
            <i class="fa fa-briefcase"></i> <span>All Members</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


        <li class="">
          <a href="{{route('payments_list')}}">
            <i class="fa fa-briefcase"></i> <span>Payment List</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
     </ul>
   </li>
          <!--   <li class="treeview">
                    <a href="#">
          <i class="fa fa-money"></i>
          <span>Receive Payments</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                    </a>
                    <ul class="treeview-menu">
          
             <li class="">
                    <a href="">
          <i class="fa fa-briefcase"></i> <span>Receive</span>
          <span class="pull-right-container">
            <i class="fa  pull-right"></i>
          </span>
                    </a>     
                  </li>   
               </ul>
             </li> -->
<li class="header"><strong>REPORTS</strong></li>

   <li class="">
          <a href="{{route('loanreportselection')}}">
            <i class="fa fa-briefcase"></i> <span>Loans</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

  <li class="">
          <a href="{{route('savingsreportselection')}}">
            <i class="fa fa-briefcase"></i> <span>Savings</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

 <li class="">
          <a href="{{route('sharesreportselection')}}">
            <i class="fa fa-briefcase"></i> <span>Shares</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Finacial reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="{{url('/income_statments')}}">
            <i class="fa fa-file"></i> <span>Income statments</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{route('balance_sheets')}}">
            <i class="fa fa-file"></i> <span>Balance sheets</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="{{route('cash_flow')}}">
            <i class="fa fa-file"></i> <span>Cash Flow</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="{{route('capital_change')}}">
            <i class="fa fa-file"></i> <span>Capital Changes</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
     </ul>
   </li>

   <li class="header"><strong>ASSETS</strong></li>
<li class="">
          <a href="{{route('assetregister')}}">
            <i class="fa fa-file"></i> <span>New</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
  </li>

  <li class="">
          <a href="{{route('disposal')}}">
            <i class="fa fa-file"></i> <span>Disposal</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
  </li>

   

      @role('Admin','member')
             
<li class="header"><strong>GENERAL SETTING</strong></li>
<li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="">
          <a href="{{url('/Admin_member')}}">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
        </li>
         <li class="">
          <a href="{{url('/roles')}}">
            <i class="fa fa-briefcase"></i> <span>Roles</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{url('/permissions')}}">
            <i class="fa fa-briefcase"></i> <span>Permissions</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
     </ul>
   </li>
          
         <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            


         <li class="">
          <a href="{{route('shares')}}">
            <i class="fa fa-briefcase"></i> <span>Shares</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

                <li class="">
          <a href="{{url('/loanCategory')}}">
            <i class="fa fa-briefcase"></i> <span>Loan Category</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
          <li class="">
          <a href="{{url('/loan_fee')}}">
            <i class="fa fa-briefcase"></i> <span>Fee</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="{{url('/insurances')}}">
            <i class="fa fa-briefcase"></i> <span>Insurance</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="{{{route('tax')}}}">
            <i class="fa fa-briefcase"></i> <span>Tax</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


         <li class="">
          <a href="{{route('interest_methods')}}">
            <i class="fa fa-briefcase"></i> <span>Interest Method</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>



         <li class="">
          <a href="{{url('/penalties')}}">
            <i class="fa fa-ban"></i> <span>Penalties</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

         <li class="">
          <a href="{{url('/codes_registration')}}">
            <i class="fa fa-code"></i> <span>Codes</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

           <li class="">
          <a href="{{url('/category')}}">
            <i class="fa fa-ban"></i> <span>Ac category</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>


             <li class="">
          <a href="{{route('categoryaccountstypes')}}">
            <i class="fa fa-ban"></i> <span>Accounts Types</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{url('/main_accounts')}}">
            <i class="fa fa-ban"></i> <span>Main Accounts</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>

        <li class="">
          <a href="{{route('profit_distribution')}}">
            <i class="fa fa-ban"></i> <span>Profit Distribution</span>
            <span class="pull-right-container">
              <i class="fa  pull-right"></i>
            </span>
          </a>
       
        </li>
          </ul>
        </li>

        @endrole
   
           

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>








