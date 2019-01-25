
  <div class="col-md-12"><h3>Mark into Pedding</h3></div>
    <form action ="{{url('/pending_submitted')}}" method="post">
    	          {{csrf_field()}}
                <input type="hidden" name="loan_id" value="{{$loan->id}}">

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
              <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Principle</label>
                        <input type="text" name="" class="form-control"  value="{{$loan->principle}}"  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Interest
                        <input type="text" name="middle_name" class="form-control" id="exampleInputPassword1" value="{{$loan->interest}}" READONLY>
                        <span class="text-danger"></span>
                    </div>
              </div>
              
              <div class="col-md-12">
                 <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Amount Given</label>
                        <input type="text"  class="form-control"  value="{{($loan->principle)-($loan->loan_fees->sum('fee_value')+(($loan->insurances->percentage_insurance)/100)*$loan->principle)}} "  READONLY>
                       <span class="text-danger"></span>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Loan Period</label>
                        <input type="text"  class="form-control"  value="{{$loan->duration}} Month(s)"  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    
              </div>
          
    	<div class="form-group{{ $errors->has('pending_reason') ? ' has-error' : '' }}">
  <label for="reason">Pending Reason:</label>
  <textarea class="form-control" rows="4"  name="pending_reason" id="reason" value="{{old('pending_reason')}}"  required="true"></textarea>
   <small class="text-danger">{{ $errors->first('pending_reason') }}</small>
</div>


<!--  <div class="form-group"> 
        <label class="control-label" for="date">Date</label>
        <input  class="form-control dp1" id="date" name="pending_workingdate" placeholder="yyyy-mm-dd" type="text"  required="true" autocomplete="off">
      </div> -->

    <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-6" style="margin-top: 20px;">Mark it to pending <i class="fa fa-clock-o" style="color:; font-size:15px;"></i></button>
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