   @extends('layouts.master')

   @section('dashboard')

        <div class="row">


           <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Members</span>
              <span class="info-box-number">{{$members}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"></span>

            <div class="info-box-content">
              <span class="info-box-text">Savings</span>
              <span class="info-box-number">{{number_format($savings,2)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"></span>

            <div class="info-box-content">
              <span class="info-box-text">Shares</span>
              <span class="info-box-number">{{number_format($shares,2)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"></span>

            <div class="info-box-content">
              <span class="info-box-text">Loans</span>
              <span class="info-box-number">{{number_format($loans,2)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>

       <div class="row">

          <div class="col-md-4 ">
              <!-- DIRECT CHAT -->
              <div class="box box-info direct-chat direct-chat-warning">
                <div class="box-header with-border"  style="text-align:center">
                  <h3 class="box-title">Year Recap Reports</h3>
                     <br>
                     <br>
                     <br>

                            <div class="progress-group" >
                 <span class="progress-text">Loan Interests Expected</span>
                    <span class="progress-number"><b>6,500,000</b>/10,000,000</span>
   
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width:65%">
    65%

</div>
</div>
      <br>
      <br>
                  <!-- /.progress-group -->
                              <div class="progress-group" style="margin-bottom:80px;" >
                 <span class="progress-text">Bad Loans</span>
                    <span class="progress-number"><b>2</b>/10</span>
   
  <div class="progress-bar progress-bar-red progress-bar-striped active" role="progressbar"
  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
    20%

</div>
</div>
                </div>
                <!-- /.box-header -->
             
              </div>
            </div>

            <div class="col-md-4">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border"  style="text-align:center">
                  <h3 class="box-title">Activities</h3>

                  <div class="box-tools pull-right">
                     @role('Cashier','member')
                    <span data-toggle="tooltip" title="{{$drafted+$submitted+$approved+$approved_vouchers}} New Activites" class="badge bg-yellow">{{$drafted+$submitted+$approved+$approved_vouchers}}</span>
                    @endrole
                     @role('Accountant','member')
                    <span data-toggle="tooltip" title="{{$submitted+$approved+$approved_vouchers}} New Activites" class="badge bg-yellow">{{$submitted+$approved+$approved_vouchers}}</span>
                    @endrole
                     @role('Chair','member')
                    <span data-toggle="tooltip" title="{{$reviewed}} New Activites" class="badge bg-yellow">{{$reviewed}}</span>
                    @endrole
                    @role('Loan Officer','member')
                            <span data-toggle="tooltip" title="{{$assessed+$pending_vouchers+$provisioned}} New Activites" class="badge bg-yellow">
                    @endrole
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                   
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">

                        @role('Cashier','member')

                   <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{url('/drafted_loans')}}">Drafted Loans
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i>{{$drafted}}</span></a></li>
                <li><a href="{{url('/newloans_received')}}"> Submitted Loans<span class="pull-right text-green"><i class="fa fa-angle-up"></i>{{$submitted}} </span></a>
                </li>
                <li><a href="{{url('/approved_loans')}}"> Approved Loans
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>{{$approved}}</span></a></li>
                  <li><a href="{{url('/ready_vouchers')}}"> Approved Vouchers
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>{{$approved_vouchers}} </span></a></li>

              </ul>
            </div>
                         @endrole  


                         @role('Accountant','member')

                   <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{url('/newloans_received')}}">Submitted Loans<span class="pull-right text-green"><i class="fa fa-angle-up"></i>{{$submitted}} </span></a>
                </li>
                <li><a href="{{url('/approved_loans')}}"> Approved Loans
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>{{$approved}}</span></a></li>
                  <li><a href="{{url('/ready_vouchers')}}"> Approved Vouchers
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>{{$approved_vouchers}} </span></a></li>

              </ul>
            </div>
                         @endrole  


                         @role('Chair','member')

                   <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{url('/processed_loans')}}">Assessed  Loans<span class="pull-right text-green"><i class="fa fa-angle-up"></i>{{$assessed}} </span></a>
                </li>
                <li><a href="{{url('/unpaid_vouchers')}}">  Pending Voucher(s)
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i>{{$pending_vouchers}}</span></a></li>
                  <li><a href="{{route('provisioned_loans')}}">Provisioned Loan(s)
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> {{$provisioned}}  </span></a></li>

              </ul>
            </div>
                         @endrole 


                           @role('Loan Officer','member')

                              <li><a href="{{url('/processed_loans')}}">Reviewed Loan(s) <span class="pull-right text-green"><i class="fa fa-angle-up"></i>{{$reviewed}}  </span></a>
                </li>
                           @endrole

                  </div>

                </div>
              </div>
            </div>
              <div class="col-md-4 ">
              <!-- DIRECT CHAT -->
              <div class="box box-info direct-chat direct-chat-warning">
                <div class="box-header with-border"  style="text-align:center">
                  <h3 class="box-title">Reports</h3>

                  <div class="box-tools pull-right">
                 
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                            data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">       
                          <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{url('/income_statments')}}">Income Statment<span class="pull-right text-green"><i class="fa fa-angle-up"></i></span></a>
                </li>
                <li><a href="{{route('balance_sheets')}}">Balance Sheet
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i></span></a></li>
                  <li><a href="{{route('capital_change')}}">Capital Changes
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> </span></a></li>

              </ul>
            </div>

                  </div>
                </div>
              </div>
            </div>
          </div>


    
             
          @yield('dashboardcontent')
    @endsection