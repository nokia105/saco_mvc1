
     @extends('loans.template')
      @section('memberworkspace')

         @section('title', '| Schedule')
       @section('css')
         
          
       <style type="text/css">
         .push_left{
          padding-right:2%;
         }
       </style>
       @endsection

      <div class="row">
       <div class="push_left col-xs-12">



         <ul class="nav nav-tabs">
  <li class="active col-md-2"><a data-toggle="tab" href="#schedule">Schedule</a></li>
  <li class="col-md-3"><a data-toggle="tab" href="#collateral">Collaterals</a></li>
  <li class="col-md-2"><a data-toggle="tab" href="#guarantor">Gurantor</a></li>
  <li class="col-md-3"><a data-toggle="tab" href="#insurance">Insurance</a></li>
   <li class="col-md-2"><a data-toggle="tab" href="#charges">Charges</a></li>
</ul>

         <div class="tab-content"> 
          <div id="schedule" class="tab-pane fade in active">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Schedule</h3>
                <br />
                  <br />
               <h3 class="box-title">Loan NO: #{{$code+$loan_id+$member_id}}</h3>

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
                  <div class="col-md-6 col-md-offset-5">
          <a ><button class="btn btn-default col-xs-3" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous()}}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
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

         <div id="collateral" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
                <br>
                <br>
                 <h3 class="box-title">loan no: #{{$code+$loan->id+$loan->member->member_id}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                 
                   <th>Collateral Name</th>
                   <th>Collateral type</th>
                   <th>Collateral Value</th>
              
                </tr>
                </thead>
                <tbody>
                   @if(!is_null($loan->collaterals))
                   @foreach( $loancollaterals as $collateral)
                 <tr>
                      
                   
                  <td>{{$collateral->colateral_name}}</td>
                  <td> {{$collateral->colateral_type}}</td>
                  <td> {{number_format($collateral->colateral_value,2)}}</td>
                  

                </tr>
              @endforeach 
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
              <h3 class="box-title">Guarantors</h3>
                <br>
                <br>
                 <h3 class="box-title">loan no: #{{$code+$loan->id+$loan->member->member_id}}</h3>
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
              <h3 class="box-title">Insurance</h3>
                <br>
                <br>
                 <h3 class="box-title">loan no: #{{$code+$loan->id+$loan->member->member_id}}</h3>
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
                  <td> {{number_format($insurance->percentage_insurance,2)}}</td>
                              
                  <td>{{number_format($loan->principle*($insurance->percentage_insurance/100),2)}}</td>
                                   
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
              <h3 class="box-title">Charges</h3>
                <br>
                <br>
                 <h3 class="box-title">loan no: #{{$code+$loan->id+$loan->member->member_id}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                 
                   <th>Fee Name</th>
                   <th>Fee Value</th>
                   
                   
                </tr>
                </thead>
                <tbody>
                   @foreach($loanfees as $loanfee)
                 <tr> 
                   
                  <td>{{$loanfee->fee_name}}</td>
                  <td> {{number_format($loanfee->fee_value,2)}}</td>
                 
                
                                   
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
      <!-- /.row -->
      @endsection
     
     @section('js')
          

        
      <script type="text/javascript">
        

            $(document).ready(function(){

    $('#example4').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    });      
            });

      </script>


     @endsection