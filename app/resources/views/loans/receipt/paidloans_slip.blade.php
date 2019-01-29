
 @extends('layouts.outreceipttemplate')
    
      @section('receiptcontent')
        
          <div style="margin-bottom:5px;">
   </div> 

         <div  id="div" class="col-md-8" style="background-color:#fff; margin-top:px;">
     <div class="info" style="margin-top:20px";>
    
     <div style="margin-bottom:20px;">
    <strong>TASAF SACOSS</strong>
</div>

     <div class="img">
     <img src="{{asset('/images/logo/saccos.jpg')}}">
     </div>
  </div>
  <div style="float:right; margin-bottom:5px;">
    Voucher #: {{$loan->voucher->voucher_no}} <br>
   Date: {{date('Y-m-d')}}<br>
   </div>



 

  

  <div style="text-align:center; margin-bottom:30px;">
    <strong>PAYMENT RECEIPT</strong>
  </div> 
           <table class="table table-striped table-bordered"> 
            <tr class="item last">
                <td>
                    Loans
                </td>
                
                <td style="text-align:right">
                    <strong>{{number_format($loan->loanpayment->amount_paid,2)}}</strong>
                </td>
               
            </tr>
            
            <tr class="total" style="color:blue">
                <td>Total</td>
                 
                <td style="text-align:right">
                  <strong>{{number_format($loan->loanpayment->amount_paid,2)}}</strong>
                </td>
              
            </tr>
        </table>

       <div class="signature">
         <label class="pull-left">Payee Name: {{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->last_name)}}
          {{ucfirst($loan->member->last_name)}}
         </label>
           <br />
           <label class="pull-left">Payee signature...........................</label>
          <label class="pull-right">Cashier signature...........................</label>

         
        </div>
      </div>

        @endsection
     
     
 

    



   
    




 