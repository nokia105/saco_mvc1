

    <form action ="{{url('/voucher_submitted')}}" method="post">

           <div class="ceneter" style="">
                                <h3>Generate Voucher</h3>
                           </div>
       {{csrf_field()}}
        <input type="hidden" name="loan_id" value="{{$loan->id}}">
         <input type="hidden"  class="form-control"  name="main_account" value="{{$sacoss_loanaccount->id}}"  READONLY>
         <input type="hidden"  class="form-control" name="memberaccount"  value="{{$loan_account= $loan->member->memberaccount->where('name','=','Loan Account')->first()->id}}"  READONLY>
            

             <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Loan Code</label>
                        <input type="text" name="" class="form-control" id="" value="#{{$code+$loan->id+$loan->member_id}}"  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Loanee</label>
                        <input type="text" name="middle_name" class="form-control"  value="{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}" READONLY>
                        <span class="text-danger"></span>
                    </div>
              </div>
              
              <div class="col-md-12">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">DR.  Account</label>
                        <input type="text"  class="form-control" name="dr_account"  value="{{$loan_account= $loan->member->memberaccount->where('name','=','Loan Account')->first()->account_no}}"  READONLY>
                       <span class="text-danger"></span>
                    </div>

                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">CR.  Account</label>
                        <input type="text"  class="form-control"  name="cr_account" value="{{$sacoss_loanaccount->account_no}}"  READONLY>
                       <span class="text-danger"></span>
                    </div>    
              </div>
               <div class="col-md-12">
               <div class="form-group  col-md-6">
                <label for="payment_method">Payment method</label>
              <select class="form-control select2" name="payment_method" required="true">
        
                <option value="check">Check</option>
              </select>
            </div>
          </div>

            <div class="form-row col-md-12">
                 <div class="col-md-12">
                                       
                    <label class="control-label" for="date">Check No:</label>
                    <input class="form-control"  name="check_no" required="true">
                                      
                          </div>
              </div>

              <div class="form-row col-md-12">
                 <div class="col-md-12">
                                       
                    <label class="control-label" for="date">Amount Given</label>
                    <input class="form-control" type="float" name="amount" value="{{($loan->principle)-($loan->loan_fees->sum('fee_value')+(($loan->insurances->percentage_insurance)/100)*$loan->principle)}}" required="true">
                                      
                          </div>
              </div>

              <div class="form-row col-md-12">
                  <div class="form-group{{ $errors->has('narration') ? ' has-error' : '' }} col-md-12">
    <label for="reason">Narration:</label>
     <textarea class="form-control" rows="4"  name="narration" id="reason" value="{{old('narration')}}"  required="true"  autocomplete="off"></textarea>
     <small class="text-danger">{{ $errors->first('narration') }}</small>
</div>

              <br/>
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-6" style="margin-top: 20px;">Save & Submit</button>
              </div>
            </div>
          </div>

     
    </form>

     <script type="text/javascript">
       

          $(function(){
  $('.dp1').fdatepicker({
   // initialDate: '2018-02-06',
    format: 'yyyy-mm-dd',
    disableDblClickSelection: true,
    leftArrow:'<<',
    rightArrow:'>>',
    closeIcon:'X',
    closeButton: true
  });
});  

     </script>