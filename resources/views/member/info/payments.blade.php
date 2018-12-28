@extends('member.member_template')
@section('memberinfo')

 @section('title', '|All Shares')

 
        <style type="text/css">
         .push_left{
          padding-right:2%;
         }
       </style>


      <div class="row">
       <div class="push_left col-xs-12">



         <ul class="nav nav-tabs">
  <li class="active col-md-2"><a data-toggle="tab" href="#schedule">Loans</a></li>
  <li class="col-md-3"><a data-toggle="tab" href="#collateral">Shares</a></li>
  <li class="col-md-2"><a data-toggle="tab" href="#guarantor">Savings</a></li>
  <li class="col-md-3"><a data-toggle="tab" href="#insurance">Reg Fee</a></li>

</ul>

         <div class="tab-content"> 
          <div id="schedule" class="tab-pane fade in active">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Transactions</h3>
                <br />
               

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>loan #</th>
                   <th>Total Amount(Tsh)</th>
                   <th>Details</th>
                  <th>State</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                     @if(count($member->loan_payment))
                @foreach($loanstrasactions as $loanstrasaction)
                <tr>
                  <th>{{$code+$loanstrasaction->loan_id}}</th>
                  <td>{{number_format($loanstrasaction->amount,2) }} </td>
                  <td>{{ucfirst($loanstrasaction->narration)}}</td>
                   <td>{{strtoupper($loanstrasaction->state)}}</td>
                    <td>{{\Carbon\carbon::parse($loanstrasaction->date)->format('d/m/y')}}</td>   
                </tr>
                @endforeach

                 @else
                        <td>-</td>
                       <td>0.00</td>
                       <td>NOTHING</td>
                       <td>NONE</td>
                       <td>00-00-0000</td> 
                       @endif
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>

                   <th>Share #</th>
                   <th>Amount Tsh</th>
                   <th>State</th>
                   <th>Date</th>
              
                </tr>
                </thead>
                <tbody>
                          @if(count($member->share_payment))
                  @foreach($sharetrasactions as $sharetrasaction)
                 <tr> 
                  <td>{{$sharecode+$sharetrasaction->id}}</td>
                  <td> {{number_format($sharetrasaction->amount,2)}}</td>
                  <th>{{strtoupper($sharetrasaction->state)}}</th>
                  <td>{{\Carbon\carbon::parse($sharetrasaction->date)->format('d/m/y')}}</td>
                </tr>
              @endforeach 
                    @else
                       <td>-</td>
                       <td>0.00</td>
                       <td>NONE</td>
                       <td>00-00-0000</td> 
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
              <h3 class="box-title">Savings</h3>
                <br>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="insuarance" class="table table-bordered table-striped">
                <thead>
                <tr>
                
             
                    <th>Saving #</th>
                   <th>Amount Tsh</th>
                   <th>State</th>
                   <th>Date</th>                    
              
                </tr>
                </thead>
                <tbody>
                           @if(count($member->saving_payment))
                   @foreach($savingtrasactions as $savingtrasaction)
                 <tr> 
                 
                  <td>{{$savingcode+$savingtrasaction->member_saving_id}}</td>
                   <td>{{number_format($savingtrasaction->amount,2)}}</td>
                   <th>{{strtoupper($savingtrasaction->state)}}</th>
                  <td>{{\Carbon\carbon::parse($savingtrasaction->date)->format('d/m/y')}}</td>
                              
                </tr>
                 @endforeach
                  @else
                       <td>-</td>
                       <td>0.00</td>
                       <td>NONE</td>
                       <td>00-00-0000</td> 
                       @endif 
              
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>

     <div id="insurance" class="tab-pane fade">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reg Fee</h3>
                <br>
                <br>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
   
                   <th>Fee Amount</th>
                   <th>State</th>
                   <th>Date</th>
                   
              
                </tr>
                </thead>
                <tbody>
                 <tr> 
                               @if(count($member->regfee_payment))
                      @foreach($regfeetransactions as $regfeetransaction )
                  <td>{{number_format($regfeetransaction->amount,2)}}</td>
                  <td> {{strtoupper($regfeetransaction->state)}}</td>
                 <td>{{\Carbon\carbon::parse($regfeetransaction->date)->format('d/m/y')}}</td>              
              
                       @endforeach
                       @else

                       <td>0.00</td>
                       <td>NONE</td>
                       <td>00-00-0000</td> 
                       @endif

                         </tr>
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