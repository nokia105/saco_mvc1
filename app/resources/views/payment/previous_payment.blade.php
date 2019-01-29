 @extends('loans.template')
      @section('memberworkspace')
          @section('title', '| Previous Payments')

     
           <div class="error" style="padding-top:50px; text-align:center;">


            @if (session('error'))
                    <div class="alert alert-danger" id="flash">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success" id="flash">
                        {{ session('status') }}
                    </div>
                @endif
        </div>
        <div class="container-fluid">

           @php
                $id=Request::segment(2);
           @endphp
      
      <form method="post" action="{{route('store_shares_savings_excel',$id)}}" enctype="multipart/form-data">

          {{csrf_field()}}


     <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-12" style="text-align:center;">
              
              <div class="form-group" >
                  <h4><strong>Savings & Shares Payments</strong></h4>
              </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
       
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Excel</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
              <div class="form-group">
                  <label for="">Download Sample Excel</label>
               <a href="{{route('savings_shares_excel')}}"><input  type="button"  class="btn btn-info" value="Download"></a>
       
              </div>

            <!-- </div> -->
            </div>

            <div class="col-md-6">
          
            <div class="form-group{{ $errors->has('excel') ? ' has-error' : '' }}">
                  <label for="">Attach Excel file</label>
               <input name="excel" type="file" multiple    value="{{old('excel')}}" />
                <small class="text-danger">{{ $errors->first('excel') }}</small> 
              </div>
            
            </div>

             <div class="col-md-2 col-md-offset-6">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Post"   name="submit-excel"  class="form-control btn btn-info">
              </div>
            </div>
        </div>
            <!-- /.box-body -->


          </div>

        </div>
  
        </div>
          </form>


       
     <div class="col-md-12">
          <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Complete Previous Loan</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body">

          <div class="row">

              

            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->

                 <div class="form-group">
                <label>Product Category</label>
                <select class="form-control select2" style="width: 100%;" id="pcategory" name="pcategory">
                    <option value="">--Select Category--</option>
                  @foreach($loancategories as $loancategory)

                   
                    <option value="{{$loancategory->id}}" selected>{{$loancategory->category_name}}</option>
                    
                    
                   

                   @endforeach
                </select>
            
              </div>
              

            <!-- </div> -->
            </div>

            <div class="col-md-6">

               <div class="form-group">
                  <label for="principle">Principle</label>
                  <input type="text" class="form-control" id="principle" name="principle" placeholder="100000" >
                
                </div>
          
            </div>

            

       
        </div>

         <div class="row">

             <div class="col-md-6">

               <div >
                  <label for="duration">Duration</label>
                  <input type="text" class="form-control" id="duration" name="duration"  >
                   <small class="text-danger"></small>
                </div>
            </div>

              <div class="col-md-6">
               <div class="form-group">
                  <label >Interest</label>
                  <input type="text" class="form-control"   id="interest" placeholder="%" name="interest" >
                
                </div>
            </div>

         </div>
           

            <div class="row">
                      <div class="col-sm-6">
                <div class="form-group">
               
               
                  <label for="">Inssued Date</label>
                  <input type="text" id="issued_date" class=" datepicker form-control dp1 span2"  name="inssued_date"  placeholder="yyyy-mm-dd" autocomplete="off">
                 
                </div>

                     <div class="form-group">
               
               
                  <label for="">Start Date</label>
                  <input type="text"  id="startpayment" class="datepicker form-control dp1 span2"  name="inssued_date"  placeholder="yyyy-mm-dd" autocomplete="off">
                 
                </div>

              </div>

               <div class="col-md-6">
               <div class="form-group">
                  <label >NO Months Paid:</label>
                  <input type="text" class="form-control"   id="paid_month"  name="paid_month" >
                
                </div>
            </div>

              
            </div>


            <div class="row">

            <div class="col-md-2 col-md-offset-5 ">
               
                   <a   id="previous_loan" ><button class="btn btn-info"><i class="" style="color:green; font-size:px;"></i>Edit Schedule</button></a>
             
              
            </div>

            </div>

        

          </div>

        </div>
  
        </div>





          
     </div>

         @include('modal.popup_libprevious_payment')
          
     </div>

          @endsection

          @section('js')
           <script type="text/javascript">
     


               $(document).ready(function(){

                $('#previous_loan').click(function(){

                   var principle =$('#principle').val();
                   var interest=$('#interest').val();
                   var duration =$('#duration').val();
                   var pcategory=$('#pcategory').val();
                   var issued_date=$('#issued_date').val();
                    var startpayment=$('#startpayment').val();
                   var paidmonths=$('#paid_month').val();
                     if(paidmonths==''){

                      paidmonths=0;
                     }
                         paidmonths=paidmonths;

                   var dataString='principle='+principle+'&interest='+interest+'&duration='+duration+'&pcategory='+pcategory+'&issued_date='+issued_date+'&startpayment='+startpayment+'&paidmonths='+paidmonths;

                      alert(dataString);



 var url ="{{url('/')}}/profile/previous_loan/"+principle+"/"+interest+"/"+duration+"/"+pcategory+"/"+issued_date+"/"+startpayment+"/"+paidmonths+'/{{$id}}';

  // alert(url);

   showAjaxModal(url);
                        
                });

                    


             });
           </script>


   
          @endsection


   