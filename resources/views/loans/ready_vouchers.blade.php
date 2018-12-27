@extends('layouts.master')
      @section('content')
      
           @section('title', '|Ready Voucher')
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
              <h3 class="box-title">Approved Vouchers</h3>
            </div>
            <!-- /.box-header -->
            <div class="mainprinting pull-right col-md-3" style="text-align: right;">
             <div class="printcheck" >
                <button id="printcheck"><i class="fa fa-print"></i>Check</button>
             </div>
             <div class="printdispatch"  >
                <button id="printdispatch" style=""><i class="fa fa-print"></i>Dispatch</button>
             </div>
           </div>
             
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox"  id="checkall" class="checkbox"  value="checkall"></th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Voucher #</th>
                  <th>Amount(Tsh)</th>
                  <th>Payment Mode</th>
                  <th>Status</th>
                  <th>generated Date</th>
                  <th>updated Date</th>
                  <th>Check No</th>
                  
                   <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                 <tr>
                  <td><input type="checkbox"  id="checklist" class="checkbox" name="check[]" value="{{$voucher->id}}"></td>
                 <td>{{ucfirst($voucher->loan->member->first_name)}}  {{ucfirst($voucher->loan->member->last_name)}}</td> 
                 <td><a href="{{route('loan_info',$voucher->loan->id)}}">#{{$code+$voucher->loan->id+$voucher->loan->member_id}}</a></td>     
                <td>#{{$voucher->voucher_no}}</td>
                <td>{{number_format($voucher->amount,2)}}</td>
                <td>{{strtoupper($voucher->mode_payment)}}</td>
                <td>{{strtoupper($voucher->status)}}</td>
                <td>{{\Carbon\carbon::parse($voucher->date)->format('d/m/y')}}</td>
                <td>{{\Carbon\carbon::parse($voucher->updated_date)->format('d/m/y')}}</td>
                <td>{{$voucher->check_no}}</td>
             @role('Cashier','member')
                        <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('paid',$voucher->loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>post</a> </li>
                               
         </ul>
         </div>
  </td>
@endrole
                </tr>
                @endforeach

               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


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
        

             <div class="row">

            <div  id="printtable" class="container-fluid"  style="display:none">
<div style="margin-bottom:5px;">
   </div> 
           
        <div  id="div" class="col-md-8" style="background-color:#fff;">
     <div class="info" style="">

        <div class="img" style="margin-left:310px; margin-top:20px;" >
     <img src="{{asset('/images/logo/saccos.jpg')}}">
     </div>

     <div style="margin-top:20px; text-align:center;">
    <h4><strong>TASAF SACCOS LIMITED</strong></h4>
</div>
  </div>
    
     <div>
     <table class="table col-md-12" >
                <thead>
                <tr >
                  <th style=""></th>
                  <th style="" class="pull-right"></th>
                </tr>
                </thead>
               <tbody>

                 <tr>
                  <td > <h5><strong> Telephone: </strong> 255 022 2123582-84</h5></td> 
                    <td class="pull-right"> <h5>Old Kilwa/ Malindi Road</h5></td>
                </tr>
                <tr >
                  <td><h5><strong> Fax: </strong> 255 022 2123582</h5></td>
                  <td class="pull-right"> <h5>P.O.  Box 9381</h5></td>  
                </tr>

                 <tr >
                  <td><strong> <h5><strong> E-Mail: </strong> info@tasaf.org</h5> </td>
                  <td class="pull-right"> <h5> Dar Es Salaam</h5> </td>  
                </tr>
               
               <tr>
                  <td><h5><strong> Website: </strong> www.tasaf.org</h5> </td>


                  <td class="pull-right"><h5>Tanzania</h5></td>  
                </tr>

                </tbody>
               
              </table> 
              </div>

           <h5>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------</h5>

            <div>
     <table class="table col-md-12">
                <thead>
                <tr >
                  <th style=""></th>
                  <th style="" class="pull-right"></th>
                </tr>
                </thead>
               <tbody>
                 <tr >
                  <td> <h5><strong> In reply please quote: </strong></h5></td> 
                    
                </tr>
                <tr >
                  <td><h5><strong> Ref</strong>. No.TSL/CL/GEN/03</h5></td>
                  <td class="pull-right"><h5>Date: {{date('d/m/Y')}}</h5></td>  
                </tr>

                 <tr >
                  <td><strong> <h5>Branch Manager,</h5> </td>
                
                </tr>
            
               <tr>
                  <td><h5>CRDB Bank, Tower Branch</h5> </td>

                </tr>
                <tr>
                  <td><h5>P.O Box 9213,</h5> </td>
                </tr>
                 <tr>
                  <td><h5>Dar Es salaam.</h5></td>

                </tr>

                </tbody>
               
              </table> 
              </div>
              <div class="account">
                <h5><strong>LIST OF CHEQUES DRAWN FROM ACCOUNT NO. 01J1043814300 </strong>It is certified that the following cheque/s have been issued by <strong>TASAF SACCOS LIMITED ON 16 AUGUST, 2018</strong></h5>
              </div>
    
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
       <th scope="col">PAYEE</th>
       <th scope="col">CHQ-DATE</th>
      <th scope="col">CHEQUE</th> 
      <th scope="col">VOUCHER NO.</th>
      <th scope="col">AMOUNT IN  TSH.</th>
      <th scope="col">STATUS</th>
    </tr>
  </thead>
  <tbody id="printcontent">
    
  </tbody>
</table>
</div>
</div>



        <!-- /.col -->
      

                <div  id="printtabledispatch" class="container-fluid"  style="display:none">


   <div class="loaninfo">
  <div style="margin-bottom:5px;">
   </div> 

  <div  id="div" class="col-md-8" style="background-color:#fff; margin-top:px;">
     <div class="info" style="margin-top:20px; margin-left: 300px;";>
    
     <div style="margin-top:20px;">
    <strong>TASAF SACOSS</strong>
</div>

     <div class="img">
     <img src="{{asset('/images/logo/saccos.jpg')}}" style="">
     </div>
  </div>
  <div style="float:right; margin-bottom:10px;">
     <br>
    Date: {{date('d-m-Y')}}
   </div>

   <div style="text-align:center; margin-top:30px; margin-bottom: 10px;">
   <label><strong>DISPATCH LIST</strong></label>
  </div>


   </div>
    
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
       <th scope="col">Payee</th>
      <th scope="col">Date</th> 
      <th scope="col">Check No</th>
      <th scope="col">Amount</th>
      <th scope="col">Total amount</th>
      <th scope="col">Signature</th>
    </tr>
  </thead>
  <tbody id="printcontentdispatch">
    
  </tbody>
</table>
</div>
</div>

</div>
</div>
</div>


 @endsection



   @section('css')

          <style type="text/css">
            
      .mainprinting { 
    
    margin: 0 auto;
}
.printcheck    {
     margin-left: 30%;
    background: red;
    float: left;
}

.printdispatch  {
   
    background: #ffffff;
    margin-left: 50%;
}

          </style>

        @endsection




         @section('js')
        <script type="text/javascript">


               $(document).ready(function(){
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printcheck').click(function(e){
                    var allVals = [];

                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });


                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                              // alert(allVals);

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


                 $(document).ready(function(){
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printdispatch').click(function(e){
                    var allVals = [];



                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });


                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                              // alert(allVals);

                                var url_link="{{url('/')}}/printdispatch";
                                
                        // var $body = $("body");

                           $.ajax({
                           type: "GET",
                           url: url_link,
                           data:'array='+allVals,                                                           
                            success:  function(data){


                                $('#printcontentdispatch').html(data);

                                   
                                       
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById("printtabledispatch").innerHTML;
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


   
     

       


     
 

