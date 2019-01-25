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
 @elseif($loan->loan_status==='submitted')
    @role('Accountant|Cashier','member')  
     <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>REVIEWED</button></a>
         <a  onclick="showAjaxModal('{{route('pending',$loan->id)}}')" ><button class="btn btn-warning  col-xs-3 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>PENDING</button></a>
          <a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" ><button class="btn btn-danger col-xs-4 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>DENY</button></a>
    </div>
   
         @endrole
  @elseif($loan->loan_status==='reviewed')
   @role('Loan Officer','member')
  
         <div class="col-md-4 pull-right" style=" margin-top: 20px;">
         <a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>ASSESSMENT</button></a>
          <a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" ><button class="btn btn-danger col-xs-4 pull-right" style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>DENY</button></a>
    </div>
  @endrole
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
         <a  onclick="showAjaxModal('{{route('voucher',$loan->id)}}')" ><button class="btn btn-primary col-xs-4 pull-right " style="margin-right: 1px;"><i class="" style="color:green; font-size:px;"></i>VOUCHER</button></a>
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

       





          

