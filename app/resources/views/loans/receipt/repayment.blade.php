@extends('layouts.outreceipttemplate')
    
      @section('receiptcontent')



         <div  id="div" class="col-md-8" style="background-color:#fff; margin-top:px;">
     <div class="info" style="margin-top:20px";>
    
     <div style="margin-bottom:20px; text-align:center; ">
    <strong>TASAF SACOSS</strong>
</div>

     <div class="img" style="margin-bottom:15px;"><center>
     <img src="{{asset('/images/logo/saccos.jpg')}}">
   </center>
     </div>
  </div>
     <div style="margin-bottom:30px;">
        <center>
    <strong>PAYMENT SLIP</strong>
  </center>
  </div> 

  <div style="float:right; margin-bottom:5px;">
     <br>
   Date: <strong>{{date('d/m/Y')}}</strong><br>
   </div>

    
      
  <div id="table">
  <table class="table table-striped table-bordered">
        
          <thead>
              <tr>
              <td style="text-align:center"> 
                Payment Item
              </td>
                <th style="text-align:center">
                    Sh
                </th>
                
      
            </tr>
          </thead>
            
            <tr class="item">
              <tbody>
                <td>
                   Savings
                </td>
                
                <td style="text-align:center";>
                   @if($getpaymenttype=='saving')
                          {{number_format($amount,2)}}
                          @else
                         ----
                          @endif
                   
                </td>
              

            </tr>
            
            <tr class="item">
                <td>
                    Shares
                </td>
                
                <td style="text-align:center";>
                  @if($getpaymenttype=='share')
                        
                          {{number_format($amount,2)}}
                          @else
                           ----
                          @endif
                  
                </td>

               
            </tr>

            <tr class="item">
                <td>
                  Amana
                </td>
                
                <td style="text-align: center">
                      ----
                </td>

               
            </tr>

            <tr class="item">
                <td>
                 Registration Fee
                </td>
                
                <td style="text-align: center;">
                 @if($getpaymenttype=='reg_fee')
                        
                          {{number_format($amount,2)}}
                          @else
                          ----
                             @endif   
                  
                </td>

            </tr>
            
            <tr class="item last">
                <td>
                    Loans
                </td>
                
                <td style="text-align:center";>
                   @if($getpaymenttype=='loan')
                     
                          {{number_format($amount,2)}}
                          @else
                          ----
                          @endif
                 
                </td>

              
            </tr>
            
            
            <tr class="total">
                <td style="text-align:center";>
                  TOTAL:
                </td>
                <td style="text-align:center">
                 {{number_format($amount,2)}} 
                </td>
                
             

            </tr>
          </tbody>
        </table>

        <div class="signature">
           <label class="pull-left">Cahier: {{\Auth::guard('member')->user()->first_name}} {{\Auth::guard('member')->user()->last_name}} </label>
          <label style="padding-left:20px;">Cashier signature.............</label>
          <label style="padding-left:20px;">Payee signature...............</label>
           <label class="pull-right">Payee: {{ucfirst($member->first_name)}} {{ucfirst($member->middle_name)}} {{ucfirst($member->last_name)}}</label>
        </div>
      </div>
       
    </div>
  </div>
  
        
    @endsection
    


   
