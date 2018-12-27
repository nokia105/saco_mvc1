

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

    <form action ="{{url('/agree_submitted')}}" method="post">
       {{csrf_field()}}
        <input type="hidden" name="loan_id" value="{{$loan->id}}">
                              @if($loan->loan_status==='submitted')
                           <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4><strong>Review Loan</strong></h4>
                           </div>
                           @endif

                            @if($loan->loan_status==='reviewed')        
                                <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4><strong>Assess Loan</strong></h4>
                           </div>
                            @endif

                              @if($loan->loan_status==='assessed')        
                                <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4><strong>Approve Loan</strong></h4>
                           </div>
                           @endif


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
           
             
                   @if($loan->loan_status==='reviewed' | $loan->loan_status==='submitted' )
                <div class="form-group{{ $errors->has('preason') ? ' has-error' : '' }}">
        <label for="reason"> Recommendation:</label>
           <textarea class="form-control" rows="4"  name="reason" id="reason" value="{{old('reason')}}"  required="true"></textarea>
            <small class="text-danger">{{ $errors->first('reason') }}</small>
</div>
              @endif

              <br/>
              @if($loan->loan_status==='submitted')
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">Review <i class="fa fa-check-circle-o fa-white" style="color:green; font-size:15px;"></i></button>
              </div>
            </div>
            @endif

            @if($loan->loan_status==='reviewed')
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">save <i class="fa fa-check-circle-o fa-white" style="color:green; font-size:15px;"></i></button>
              </div>
            </div>
            @endif

            @if($loan->loan_status==='assessed')
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">Approve <i class="fa fa-check-circle-o fa-white" style="color:green; font-size:15px;"></i></button>
              </div>
            </div>
            @endif
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