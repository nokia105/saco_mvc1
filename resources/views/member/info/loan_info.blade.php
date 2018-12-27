
    @extends('member.member_template')
    @section('memberinfo')
      @section('title', '|Loan Info')
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
               <h3 class="box-title">Loan NO: #{{$code+$lid+$id}}</h3>

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
                  <th>Amount Payed(Tsh)</th>
                  
                  <th>Due Date</th>
                  <th>Status</th>
                
                </tr>
                </thead>
                <tbody>
                @foreach($loan->loanschedule as $loan_schedule )
                <tr>
                 <td>@php $month= date('m',strtotime($loan_schedule->duedate));
                    @endphp
                   {{ date("F", mktime(0, 0, 0, $month, 1)) }}
         </td>
                  <td>{{number_format(($loan_schedule->monthprinciple)+($loan_schedule->monthinterest),2) }} </td>
                   <td>{{number_format( $loan_schedule->monthprinciple,2)}} </td>
                  <td>{{number_format($loan_schedule->monthinterest,2) }} </td>
                  <td>{{number_format($loan_schedule->monthrepayment->sum('amountpayed'),2)}}</td>
                  
                  <td>{{\Carbon\carbon::parse($loan_schedule->duedate)->format('d/m/y')}}</td>
                   <td>{{strtoupper($loan_schedule->status)}}</td>
                  
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
                 
                  <td>{{ucfirst($loanguarantor->first_name)}}</td>
                   <td>{{ucfirst($loanguarantor->middle_name)}}</td>
                    <td>{{ucfirst($loanguarantor->last_name)}}</td>
                              
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
                
                  <td>{{number_format($loan->principle,2)}}</td>
                  <td> {{$insurance->name}}</td>
                  <td> {{$insurance->percentage_insurance}} %</td>
                              
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
                   
                  <td>{{ucfirst($loanfee->fee_name)}}</td>
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

   $(function () {

    $('#example4').DataTable({

        ]

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  });
            


            });

      </script>


     @endsection