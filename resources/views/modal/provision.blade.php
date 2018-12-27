<div class="error" style="padding-top:50px; text-align:center;">


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

    <form action ="{{route('provision_reason')}}" method="post">
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
                        <label for="exampleInputEmail1">Loan Period</label>
                        <input type="text"  class="form-control"  value="{{$loan->duration}} Month(s)"  READONLY>
                       <span class="text-danger"></span>
                    </div>
                 
                    
              </div>         
      <div class="form-group{{ $errors->has('provision_reason') ? ' has-error' : '' }}">
  <label for="reason">Provision Terms:</label>
  <textarea class="form-control" rows="4"  name="provision_reason"  value="{{old('provision_reason')}}"  required="true"  autocomplete="off"></textarea>
   <small class="text-danger">{{ $errors->first('provision_reason') }}</small>
</div>


     <button>submit <i style="color:red; font-size:15px;"></i></button>