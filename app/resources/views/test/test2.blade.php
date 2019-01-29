@extends('layouts.outreceipttemplate')
    
      @section('receiptcontent')

        <style type="text/css">
    

                  .table_remove td{

           	border-top: none !important;
           	 
           }

           .table_remove >thead>tr>th{

           	 border-bottom:0 solid #fff; *
           }
        
           .table_remove >thead>tr>td{

           	 padding:-3px;
           }

 .table_remove>tbody>tr>td, .table_remove>tbody>tr>th, .table_remove>tfoot>tr>td, .table_remove>tfoot>tr>th, .table_remove>thead>tr>td, .table_remove>thead>tr>th {
    padding:0; 
    /* line-height: 1.42857143; */
    vertical-align: top;
    /* border-top: 1px solid #ddd; */
}


              .hr hr{
             	border-top:5px double #000;
             }

             .account{
             	text-align:center;
             	padding-top:20px;
             	padding-bottom:20px;  
             }
        </style>


     <div class="container">
     	<div class="row">

            <div  id="printtable" class="container-fluid">
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
     <table class="table table_remove col-md-12" >
                <thead>
                <tr >
                  <th style=""></th>
                  <th style="" class="pull-right"></th>
                </tr>
                </thead>
               <tbody>

               	 <tr>
                  <td > <h5><strong> Telephone: </strong> 255 022 2123582-84</h5></td> 
                    <td class="pull-right">	<h5>Old Kilwa/ Malindi Road</h5></td>
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
     <table class="table table_remove col-md-12">
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
  	@php
  	  $total_amount=0;

  	   @endphp
  	@foreach($vouchers as $voucher)
         @php
  	  $total_amount+=$voucher->amount;

  	   @endphp
  	<tr>
  	<td>{{$voucher->loan->member->first_name}}</td>
  	<td>{{$voucher->updated_date}}</td>
  	<td>{{$voucher->check_no}}</td>
  	<td>{{$voucher->voucher_no}}</td>
  	<td>{{number_format($voucher->amount,2)}}</td>
  	<td>CLOSED</td>	
  	</tr>
  	
  	@endforeach

  	<tr>
  		<td colspan="4" style="text-align: center">TOTAL</td>
  		<td>{{number_format($total_amount,2)}}</td>
  		<td></td>
  	</tr>

  	    
  </tbody>
</table>

 <div class="account">
                           @php
                                $f=new \NumberFormatter('en',\NumberFormatter::SPELLOUT);
                           @endphp

              	<h5>And further certified that the above cheque/s totalling <strong>TZS: {{number_format($total_amount,2)}} ({{ucfirst($f->format($total_amount))}})</strong></h5>
              </div>
</div>

 <div class="signature">
 	<h5>AUTHORISED SIGNATURE:</h5>
 	     <br>
 	  <h5>(CHAIR PERSON) CHAIPERSON’S NAME…………………………………</h5>
 	  <br>
 	  <h5>(TREASURER) TREASURER’S NAME ………………………………………</h5>   
 	
 </div>
</div>
     </div>
     </div>
 </div>
 
         
      @endsection

     




