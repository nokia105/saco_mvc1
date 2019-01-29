                       <div class="col-md-12">
                           <h4>Guarantor Approval<h4><br/>
                       </div>
    <form action ="{{route('save_guarantor_status',$loan->id)}}" method="post">
    	          {{csrf_field()}}
    	

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
                     <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Loan Period</label>
                        <input type="text"  class="form-control"  value="{{$loan->duration}} Month(s)"  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
              </div>
              
                   
    	<div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
  <label for="reason">Approve Reason:</label>
  <textarea class="form-control" rows="4"  name="reason" id="reason" value="{{old('reason')}}"  required="true"  autocomplete="off"></textarea>
   <small class="text-danger">{{ $errors->first('reason') }}</small>
</div>


     <input type="submit" name="submit" value="approve">
   </form>