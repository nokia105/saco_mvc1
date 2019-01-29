@extends('layouts.master')
      @section('content')
      

          @section('title', '|Processed Loan')
       <div class="row">
       <div class="col-xs-12">


         <div class="error" style="text-align:center">


            @if (session('error'))

          
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>

    
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Processed Loans</h3>
            </div>
            <!-- /.box-header -->

              <div class="mainprinting pull-right col-md-3" style="text-align: right;">
             <div class="printcheck" >
                <button id="print"><i class="fa fa-print"></i>Print</button>
             </div>
           </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox"  id="checkall" class="checkbox"  value="checkall"></th>
                  <th>Code</th>
                   <th>Requesting Date</th>
                   <th>Loan Principle(Tsh)</th>
                   <th>Loan Interest(Tsh)</th>
                   <th>Charges</th>
                   <th>Insurances</th>
                   <th>Duration</th>
                   <th>Status</th>

                    @role('Loan Officer','member')
                   <th>Action</th>
                   @endrole


                    @role('Chair','member')
                   <th>Action</th>
                   @endrole

                </tr>
                </thead>
                <tbody>
                    @foreach($processed_loans as $loan)
                 <tr>
                 <td><input type="checkbox"  id="checklist" class="checkbox" name="check[]" value="{{$loan->id}}"></td> 
                 <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member_id}}</a></td>    
                    <td>{{\Carbon\Carbon::parse($loan->loanInssue_date)->format('d/m/y')}}</td>
                <td>{{number_format($loan->principle,2)}}</td>
                <td>{{number_format(($loan->mounthlyrepayment_interest)*$loan->duration,2)}}</td>
                <td>{{number_format($loan->loan_fees->sum('fee_value'),2)}}</td>
                <td>{{number_format((($loan->insurances->percentage_insurance)/100)*$loan->principle,2)}}</td>



                <td>{{$loan->duration}}</td>
                  <td>{{strtoupper($loan->loan_status)}}</td>
               
                  @role('Loan Officer','member')
                  @if($loan->loan_status=='reviewed')
                
                <td class="center">                     
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-send" style="color:green; font-size:15px;"></i>Assessment</a> </li>
        <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>                             
         </ul>
         </div>
</td>
       @endif 
       @endrole


               @role('Chair','member')

               @if($loan->loan_status=='assessed')
                
                <td class="center">                     
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-send" style="color:green; font-size:15px;"></i>Approve</a> </li>
         <li><a  onclick="showAjaxModal('{{route('provision',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Provision</a></li> 
        <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Reject</a> </li>                         
         </ul>
         </div>
</td>
     @endif
       
       @endrole
                </tr>
                @endforeach
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>




       <div class="printloan">
         


       </div>

         
      @include('modal.popup_lib')

      @endsection

       @section('js')
        <script type="text/javascript">


               $(document).ready(function(){
                  $('#checkall').click(function (e) {

                     
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printloan').click(function(e){
                    var allVals = [];

                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });


                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                             

                                var url_link="{{url('/')}}/printcheck";
                                
                        // var $body = $("body");

                           $.ajax({
                           type: "GET",
                           url: url_link,
                           data:'array='+allVals,                                                           
                            success:  function(data){


                                $('#printcontent').html(data);
                                       
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById("printtable").innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();

                             document.body.innerHTML=restorepage;


                               location.reload();
                             }
                            });
                          return;
                     
                      }

                });
                 
            });

          </script>

               @endsection
