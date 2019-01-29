 @extends('layouts.master')
      @section('content')

          @section('title', '|Loan info')
       @section('css')

         <style type="text/css">
            .main{
       
        background: #ffffff;
        width:100%;
        height:100px;

            }

        

         </style>
       @endsection
      

<div class="row">

     <div class=" container-fluid main">
   <div class="sub-2 scol-xs-12" style="background-color: #FFF;">
    <h3>LOAN:<span style="color:orange;">#{{$code+$loan->id+$loan->member->member_id}}</span>/<span style="color:green;">{{strtoupper($loan->loan_status) }}</span></h3>
    <br/>

  </div>

    @if ($loan->loan_status==='draft')
    @role('Cashier|Secretary','member')


          <div class="col-md-4 pull-right" style=" margin-top: 20px;">
             <a a href="{{route('drafted.delete',$loan->id)}}" ><button class="btn btn-danger  col-xs-3 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>Delete</button></a>
         <a  onclick="showAjaxModal('{{route('submit',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>SUBMIT</button></a>
         <a a href="{{route('drafted.edit',$loan->id)}}" ><button class="btn btn-warning  col-xs-3 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>EDIT</button></a>

        
        
    </div>


 @endrole
 @elseif (($loan->loan_status==='submitted')||($loan->loan_status==='reviewed'))
    @role('Accountant','member')  
     <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>REVIEWED</button></a>
         <a  onclick="showAjaxModal('{{route('pending',$loan->id)}}')" ><button class="btn btn-warning  col-xs-3 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>PENDING</button></a>
          <a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" ><button class="btn btn-danger col-xs-4 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>DENY</button></a>
    </div>
   
         @endrole
  <!--gabage if-->
  @elseif($loan->loan_status==='reviewed')
   @role('Loan Officer','member')
  
         <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>ASSESSMENT</button></a>
          <a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" ><button class="btn btn-danger col-xs-4 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>DENY</button></a>
    </div>
  @endrole
  <!--end of gabage-->
  @elseif($loan->loan_status==='assessed')
   @role('Chair','member')
    <div class="sub-1 col-xs-7">
    <div class="btn-group">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-send" style="color:green; font-size:15px;"></i>Approve</a> </li>
        <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>                             
         </ul>
         </div>
       </div>

        <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>APPROVE</button></a>
          <a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" ><button class="btn btn-danger col-xs-4 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>REJECT</button></a>
    </div>
  @endrole
@elseif($loan->loan_status==='approved')
   @role('Accountant','member')
         <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('voucher',$loan->id)}}')" ><button class="btn btn-primary col-xs- pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>Gen. Voucher</button></a>
    </div>
    @endrole

    
    @elseif($loan->loan_status==='pending voucher')
   @role('Chair','member')
         <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('approve_voucher',$loan->id)}}')" ><button class="btn btn-primary col-xs- pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>Approve Voucher</button></a>
    </div>
    @endrole
  @elseif($loan->loan_status==='approved voucher')
   @role('Cashier','member')
    <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('post_loanpayment',$loan->id)}}')" ><button class="btn btn-primary col-xs- pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i> Post Payments</button></a>
    </div>
    @endrole

    @else
    @endif

</div>


<div class="col-xs-12">
  
   

  


<div class="panel with-nav-tabs panel-primary">

 <div class="panel-heading">
    <ul class="nav nav-tabs">
         
         <li class="active"><a data-toggle="tab" href="#general">General</a></li>
         @php if (!in_array($loan->loan_status,['submitted','reviewed','accessed','approved'])){ @endphp
         <li class=""><a data-toggle="tab" href="#schedule">Schedule</a></li>
         @php } @endphp
        <li class=""><a data-toggle="tab" href="#collateral">Collaterals</a></li>
        <li class=""><a data-toggle="tab" href="#guarantor">Gurantor</a></li>
        <li class=""><a data-toggle="tab" href="#insurance">Insurance</a></li>
         <li class=""><a data-toggle="tab" href="#charges">Charges</a></li>
            
   </ul>
 </div>




<div class="tab-content">
    
  <div id="general" class="tab-pane fade in active">
             <div class="box">
            <div class="box-header">
              <h3 class="box-title">Basic info</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                  <th>Member Name</th>
                 
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   
                   <th>Duration</th>
                   <th>Requesting Date</th>
                  
                 
                
                </tr>
                </thead>
                <tbody>
                 <tr>   
                  <td>{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</td>
                  <td>{{$loan->principle}}</td>
                  <td>{{($loan->mounthlyrepayment_interest)*$loan->duration}}</td>
                  <td>{{$loan->duration}}</td>
                  <td>{{$loan->loanInssue_date}}</td>                  
                </tr>
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  @php if (!in_array($loan->loan_status,['submitted','reviewed','accessed','approved'])){ @endphp
  <div id="schedule" class="tab-pane fade in">
             <div class="box">
            <div class="box-header">
              <h3 class="box-title">Schedule</h3>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Month</th>
                   <th>Total Amount(Tsh)</th>
                  <th>Month Principle(Tsh)</th>
                  <th>Month Interest(Tsh)</th>
                  <th>Amount Paid(Tsh)</th>
                  <th>Amount unpaid</th>
                  <th>Due Date</th>
                  <th>Status</th>
                
                </tr>
                </thead>
            <!--       <div class="col-md-6 col-md-offset-5">
          <a ><button class="btn btn-default col-xs-3" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous()}}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div> -->
                <tbody>
        
                @foreach($loan->loanschedule as $loan_schedule )
                <tr>
                 <td>@php $month= date('m',strtotime($loan_schedule->duedate));
                    @endphp
                   {{ date("F", mktime(0, 0, 0, $month, 1)) }}
         </td>
                  <td>{{ number_format(($loan_schedule->monthprinciple)+($loan_schedule->monthinterest),2)}} </td>
                   <td>{{ number_format($loan_schedule->monthprinciple,2)}} </td>
                  <td>{{number_format($loan_schedule->monthinterest,2) }} </td>

                  <td>{{$loan_schedule->monthrepayment->sum('amountpayed')}}</td>

                    @if(!$loan_schedule->status=='')
                        @if($loan_schedule->status=='incomplete')
                         <td>{{number_format((($loan_schedule->monthprinciple)+($loan_schedule->monthinterest))-$loan_schedule->monthrepayment->sum('amountpayed'),2)}}</td>
                          @else
                           <td>-</td>
                          @endif 
                      @else
                          @if(date('Y-m-d')<=$loan_schedule->duedate)
                              <td >0.00</td>
                            @else
                               <td >{{number_format(($loan_schedule->monthprinciple)+($loan_schedule->monthinterest),2)}}</td>
                               @endif
                        @endif
                  <td>{{\Carbon\carbon::parse($loan_schedule->duedate)->format('d/m/Y')}}</td>

                     @if(!$loan_schedule->status=='')
                        @if($loan_schedule->status=='incomplete')
                         <td><span class="label label-sm label-warning">{{strtoupper($loan_schedule->status)}}</span></td>
                          @else
                           <td><span class="label label-sm label-success">{{strtoupper($loan_schedule->status)}}</span></td>
                          @endif 
                      @else
                          @if(date('Y-m-d')<=$loan_schedule->duedate)
                             <td><span class="label label-sm label-default"></td>
                            @else
                               <td><span class="label label-sm label-danger">UNPAID</span></td>
                               @endif
                        @endif
                  
                </tr>
                @endforeach
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
    @php } @endphp
  <div id="collateral" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Collerateral(s)</h3>
                <br>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                 
                   <th>Collateral Name</th>
                   <th>Collateral type</th>
                   <th>Collateral Value</th>
              
                </tr>
                </thead>
                <tbody>
                       @if(count($loan->collaterals)) 
                 @foreach( $loancollaterals as $collateral)
                 <tr>
                   
                  <td>{{$collateral->colateral_name}}</td>
                  <td> {{$collateral->colateral_type}}</td>
                  <td> {{$collateral->colateral_value}}</td>
                
                </tr>
                 @endforeach

                  @else
                  <td></td>
                  <td> </td>
                  <td></td>
                   @endif
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  <div id="guarantor" class="tab-pane fade">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Guarantor(s)</h3>
                <br>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="insuarance" class="table table-bordered table-striped">
                <thead>
                <tr>
                
             
                   <th>First Name</th>
                   <th>Midlle Name</th>
                   <th>Last Name</th>                    
              
                </tr>
                </thead>
                <tbody>
                   @foreach($loanguarantors as $loanguarantor)
                 <tr> 
                 
                  <td>{{$loanguarantor->first_name}}</td>
                   <td>{{$loanguarantor->middle_name}}</td>
                    <td>{{$loanguarantor->last_name}}</td>
                             
                </tr>
                 @endforeach  
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

     <div id="insurance" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Insurance(s)</h3>
                <br>
          
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                   <th>Loan principle</th>
                   <th>Insurance Name</th>
                   <th>Insurance Percentage %</th>
                   <th>Insurance Amount Tsh</th>
                   
              
                </tr>
                </thead>
                <tbody>
                 <tr> 
                
                  <td>{{$loan->principle}}</td>
                  <td> {{$insurance->name}}</td>
                  <td> {{$insurance->percentage_insurance}}</td>
                              
                  <td>{{$loan->principle*($insurance->percentage_insurance/100)}}</td>
                                   
                </tr>
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

   <div id="charges" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Charge(s)</h3>
                <br>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped col-md-6" style="width=40%;">
                <thead>
                <tr>
                
                 
                   <th>Fee </th>
                   <th>Value</th>
                   
                   
                </tr>
                </thead>
                <tbody>
                   @foreach($loanfees as $loanfee)
                 <tr> 
                   
                  <td>{{$loanfee->fee_name}}</td>
                  <td> {{$loanfee->fee_value}}</td>
                                
                </tr>
                  @endforeach 
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
</div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="modal fade" id="modal_ajax" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; z-index:1000;">X</button>
                    <h1></h1>
                </div>
                
                <div class="modal-body" style="margin:0px;"  >
                
                       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

         
     @include('modal.popup_lib')
         
     

      @endsection

       





          

