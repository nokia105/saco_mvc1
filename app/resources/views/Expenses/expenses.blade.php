@extends('layouts.master')
   @section('content')
    
            @section('title', '| Expenses')

  
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

        <div class="container-fluid"> 
       
      <form method="post" action="{{route('storeexpenses')}}">
            {{csrf_field()}}
           
            <input type="hidden" class="form-control" id="memberaccount_id" name="memberaccount_id" >
            <input type="hidden" class="form-control" id="mainaccount_id" name="mainaccount_id" >
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Expenses </h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="form-group  col-md-5">
               <label for="">Account From:</label>
               <div class="form-group{{ $errors->has('account_from') ? ' has-error' : '' }}">
                      <select class="form-control select2 "  id="account_from" name="account_from" required>
                        <option value="">-----select Account------</option>
                         <option value="bank">Bank Account</option>
                         <option value="cash">Cash Account</option>
                           
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('account_from') }}</small>
              </div>
               </div>
                <div class="form-group  col-md-5">
               <label for="">Account To:</label>
               <div class="form-group{{ $errors->has('account_to') ? ' has-error' : '' }}">
                      <select class="form-control select2"  id="account_to" name="account_to"
                      required>
                        <option value="">-----Select Account To------</option>
                         @foreach($expensesaccounts as $expensesaccount)
                         <option value="{{$expensesaccount->id}}">{{$expensesaccount->name}}</option> 
                         @endforeach     
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('account_to') }}</small>
              </div>
               </div>
            </div>

            <div class="row">
            <div class="form-group  col-md-5">
              <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Total Amount</label>
                  <input type="number" class="form-control"  id="payment" name="payment" value="{{old('payment')}}" required>
                   <small class="text-danger">{{ $errors->first('payment') }}</small>
              </div>
          
           
            
             
            </div>

            <div class="form-group  col-md-5">
   
             <div class="form-group{{ $errors->has('narration') ? ' has-error' : '' }}">
           <label for="reason">Narration:</label>
            <textarea class="form-control" rows="3"  name="narration" id="reason" value="{{old('narration')}}"  required="true"  autocomplete="off"></textarea>
         <small class="text-danger">{{ $errors->first('narration') }}</small>
        </div>
       
            
          
            </div>
          </div>

           <div class="row">
            <div class="form-group  col-md-5">  
             <div class="form-group{{ $errors->has('cr_account') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1"> Credted Account</label>
                  <input type="float" class="form-control"  id="cr_account" name="cr_account" value="{{old('cr_account')}}"  readonly="true">
                   <small class="text-danger">{{ $errors->first('cr_account') }}</small>
              </div>
          
            </div>

            <div class="form-group  col-md-5">
            
              <div class="form-group{{ $errors->has('cr_amount') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1"> Cr Amount</label>
                  <input type="float" class="form-control"  id="cr_amount" name="cr_amount" value="{{old('cr_amount')}}" readonly="true" >
                   <small class="text-danger">{{ $errors->first('cr_amount') }}</small>
              </div>
          
            </div>
          </div>

           <div class="row">
               <div class="col-md-5">
            <div class="form-group{{ $errors->has('dr_account') ? ' has-error' : '' }}">
                  <label for="">Debited Account </label>
                  <input type="float" class="form-control" id="dr_account" name="dr_account" value="{{old('dr_account')}}" readonly="true">
                  
                   <small class="text-danger">{{ $errors->first('dr_account') }}</small>
              </div>

            </div>
               <div class="col-md-5">
              <div class="form-group{{ $errors->has('dr_amount') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1"> Dr Amount</label>
                  <input type="float" class="form-control"  id="dr_amount" name="dr_amount" value="{{old('dr_amount')}}" readonly="true" >
                   <small class="text-danger">{{ $errors->first('dr_amount') }}</small>
              </div>
             </div>
        
        </div>

        <div class="row">
           <div class="col-md-2">
              
              <div class="form-group">
                   <button   value="Post"  class="form-control btn btn-info pull-left"
                   data-toggle="confirm" 
                   data-title="Warning!" 
                   data-message="The posted amount cannot be edited!. Do you want to post this ? "
                   data-type="info">
                   Post

                   </button>
            </div>
        </div>
            <!-- /.box-body -->
      </div>
    </div>
   
     <!--/end submit -->

          <!-- /.box -->
       
      
       </form>
       </div> 

       
   @endsection

  @section('js')
     <script type="text/javascript">


       $(document).ready(function(){

       

      $("#payment").keyup(function(){
       
      $("#dr_amount").val($(this).val());
       $("#cr_amount").val($(this).val());

   });
 });
       
    $(document).ready(function () {

    	 
// code to get all records from table via select box
$('#account_to,#account_from').change(function()
{ 

var account_toid = $('#account_to').val();
var account_fromid=$('#account_from').val();
        
    
var dataString = 'account_from='+ account_fromid+'&account_to='+account_toid;
   

      if(account_fromid==""){

        alert('select category');

      }else{


  $.ajax
({
         
url:'{{route('expenseajax')}}',
type:"GET",
dataType: 'json',
data: dataString,
cache: true,
success: function(data)
{
    
$("#cr_account").val(data.account_from);
$("#dr_account").val(data.account_to);


}

});

      }
   
});
 
});
                    
     </script>
    @endsection