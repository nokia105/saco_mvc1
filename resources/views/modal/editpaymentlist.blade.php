
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

    <form action ="{{route('posteditpaymentlist',$paymentlist->id)}}" method="post">
       {{csrf_field()}}

          <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4><{{$paymentlist->member->first_name}}</h4>

             <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Shares</label>
                        <input type="text" name="shares" class="form-control" id="" value="{{$paymentlist->shares}}"  >
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Savings</label>
                        <input type="text" name="savings" class="form-control"  value="{{$paymentlist->savings}}">
                        <span class="text-danger"></span>
                    </div>
              </div>
              <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Current Loan</label>
                        <input type="text" name="current_loan" class="form-control"  value="{{$paymentlist->current_loan}}">
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Previous Loan
                        <input type="text" name="previous_loan" class="form-control"  value="{{$paymentlist->previous_loan}}">
                        <span class="text-danger"></span>
                    </div>
              </div>   
             
              <br/>
              <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">Submit <i class="fa fa-send-o" style="color:green; font-size:15px;"></i></button>
              </div>
            </div>
          </div>
                 
                    
            
     
    </form>
