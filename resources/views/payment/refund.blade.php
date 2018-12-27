
    <!-- Main content -->

     @extends('loans.template')

       @section('title','Refund')
      @section('memberworkspace')

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

        
      
      <form method="post" action="{{route('post_refund',$id=request()->route('id'))}}">
            {{csrf_field()}}
            <input type="hidden" value="{{$id=request()->route('id')}}" name="member">

             @php
               $member=\App\Member::findorfail($id);
              
             @endphp
            <input type="hidden" class="form-control" id="memberaccount_id" name="memberaccount_id" >
            <input type="hidden" class="form-control" id="mainaccount_id" name="mainaccount_id" >
         <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Refund</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="form-group  col-md-5">
               <label for="">Select Payment</label>
               <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                      <select class="form-control select2 "  id="payment_type" name="payment_type" required>
                        <option value="">-----select Payment------</option>
                         <option value="saving">Savings</option>
                         <option value="share">Shares</option>
                             @if($member->status=='inactive')
                         <option value="reg_fee">Registration Fee</option>
                            @endif
                           
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('payment_type') }}</small>
              </div>
               </div>
                <div class="form-group  col-md-5">
               <label for=""> Payment Method</label>
               <div class="form-group{{ $errors->has('payment_method') ? ' has-error' : '' }}">
                      <select class="form-control select2"  id="payment_method" name="payment_method"
                      required>
                        <option value="">-----select Payment method------</option>
                         <option value="salary">Salary</option>
                          <option value="cash">Cash</option>       
                      </select>
                   
                     <small class="text-danger">{{ $errors->first('payment_method') }}</small>
              </div>
               </div>
            </div>

            <div class="row">
            <div class="form-group  col-md-5">
              <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Refund Amount</label>
                  <input type="text" class="form-control"  id="payment" name="payment" value="{{old('payment')}}" required="true">
                   <small class="text-danger">{{ $errors->first('payment') }}</small>
              </div>
             
            </div>

            <div class="form-group  col-md-5">
   
            <div class="form-group{{ $errors->has('refund_date') ? ' has-error' : '' }}">
              <label>Refund Date</label>

              <input type="date" name="refund_date" class="form-control" value="{{old('refund_date')}}" >
                  <small class="text-danger">{{ $errors->first('refund_date') }}</small>
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
          <div class="col-md-5">
             <div class="form-group{{ $errors->has('narration') ? ' has-error' : '' }}">
           <label for="reason">Narration:</label>
            <textarea class="form-control" rows="3"  name="narration" id="reason" value="{{old('narration')}}"  required="true"  autocomplete="off"></textarea>
         <small class="text-danger">{{ $errors->first('narration') }}</small>
        </div>
        </div>
      </div>

        <div class="row">
           <div class="col-md-2 col-md-offset-6">
              
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
        </div>
            <!-- /.box-body -->
      </div>
    </div>
   
     <!--/end submit -->

          <!-- /.box -->
       
      
       </form>

       
        
           
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
$('#payment_type').change(function()
{ 

var payment_typeid = $(this).find(":selected").val();
        // alert(pcategoryid);
    
var dataString = 'payment_type='+ payment_typeid;
   
    // alert(dataString);

      if(payment_typeid==""){

        alert('select category');

      }else{


  $.ajax
({
         
url:'{{route('ajaxreceivepayment',$id)}}',
type:"GET",
dataType: 'json',
data: dataString,
cache: true,
success: function(data)
{
    
$("#cr_account").val(data.main_account);
$("#dr_account").val(data.member_account);
$("#memberaccount_id").val(data.memberaccount_id);
$("#mainaccount_id").val(data.mainaccount_id);

}

});

      }
   
});
 
});
                    
     </script>
    @endsection

      