    <!-- Main content -->

     @extends('layouts.master')
      @section('content')

       @section('title', '|Edit Provision')

      <div class="container-fluid">
      
      <form method="post" action="{{route('provisioned.update',$loan->id)}}"  enctype="multipart/form-data">      
          {{csrf_field()}}
           
        <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">Edit Loan</h3>
            </div>
            <!-- /.box-header -->
         <div class="box box-body box-info">
          <div class="row">
            <div class="col-md-6">
              <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>
   
              <div class="form-group">
                <label>Product Category</label>
                <select class="form-control select2 {{$errors->has('pcategory') ? ' has-error' : '' }}" style="width: 100%;" id="pcategory" name="pcategory">
                    <option value="">--Select Category--</option>
                  @foreach($loancategories as $loancategory)
                
                    <option value="{{ $loancategory->id }}" @php  if ($loan->loancategory_id==$loancategory->id) echo 'selected'   @endphp>{{$loancategory->category_name}}</option>
                   @endforeach

                </select>
                 <small class="text-danger">{{ $errors->first('pcategory') }}</small>
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
             <!--  <div class="box box-body box-primary"> -->
            <div class="form-group">
                  <label for="">Officer</label>
                  <input type="text" class="form-control" value="{{\Auth::guard('member')->user()->first_name}} {{\Auth::guard('member')->user()->last_name}}"  name="loanOfficer"  placeholder="Enter name" readonly="true">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Loan Requestor</label>
                  <input type="text" class="form-control"  value="{{$member->first_name}} {{$member->last_name}}" readonly="true">
              </div> 
            <!-- </div> -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>


     <!--terms row-->
     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Terms</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group">
                  <label for="">Principle</label>
                  <input type="text" class="form-control" id="principle" value="{{$loan->principle}}" name="principle">
                </div>
                <div class="form-group">
                  <label for="">Interest</label>
                  <input type="text"  class="form-control" value="{{$loan->interest}}" name="interest" id="interest">
                </div>
                <div class="form-group">
                <label>Interest Method</label>
                <select class="form-control select2"   name="Imethod" style="width: 100%;">
                  <option value="flat" @php if ($loan->interest_method=='flat') echo 'selected' @endphp>Flat</option>
                  <option value="decline" @php if ($loan->interest_method=='decline') echo 'selected' @endphp>Declining Balance</option>
                </select>
              </div>
         
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                  <label for="" class="col-md-12">Loan Period</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control"  name="period" value="{{$loan->duration}}" id="period">
                    </div>
                    <div class="col-sm-4">
                        <select class="col-md-4 form-control"  name="loanwm" style="width: 100%;">
                          <option value="month">Month</option>
                         <!--  <option value="week">Week</option> -->
                        </select>
                    </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                   <br/>
                  <label for="exampleInputEmail1">First Payment on</label>
                  <input type="date" data-date-format="yyyy-mm-dd" class="form-control" value="{{$loan->repayment_date}}" name="startpayment" placeholder="10">
                </div>
              </div>
              <div class="form-group">
                <br/>
               
              </div>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>

               <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
        <div class="box-header">
              <h3 class="box-title">Loan Discription:</h3>
            </div>
         <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              
              <div class="form-group">
        <label >Narration:</label>
        <textarea class="form-control" rows="4" name="narration" required="true">{{$loan->narration}}</textarea>
      </div>
            </div>
            <!-- /.col -->
         
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

     <!--/end terms-->
          <!--Colleratels row-->

          @if(count($member->collateral))

     <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Colletarals</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="collateral" class="form-control select2"  name="collateral[]" style="width: 100%;">
                        <option value="">--Select colleterals--</option>
                          @foreach($collaterals as  $collateral)
                          <option value="{{$collateral->id}}">{{$collateral->colateral_name}}</option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <div class="btn newcolerateral">+</div>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table44  table" width="100%">
                              <thead class="thead-dark" style="background-color: #eee;">
                                <tr>

                                  <th width="24%">Asset</th>
                                  <th width="24%">Value</th>
                                  <th align="right" width="24%">Valuation Date</th>
                                  <th align="right" width="4%"></th>
                                </tr>
                              </thead>
                                @php
                                 if(empty(old('collate'))){
                                @endphp
                                @foreach($loan->collaterals as $col)
                                <tr>

                                  <td >{{$col->colateral_name}} <input type="hidden" name="collate[]" value="{{$col->id}}" class="collate_check" /> </td>
                                  <td> {{$col->colateral_value}} </td>
                                  <td > {{$col->colateralevalution_date}} </td>
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach 
                                    @php
                                    }
                                    @endphp

                                   @php 
                                     if(!empty(old('collate'))){
                                  $collaterals=\App\Collateral::whereIn('id',old('collate'))->get();
                                   @endphp
                                @foreach($collaterals as $collateral)
                                      
                                 <tr>
                                  <td width="24%">{{$collateral->colateral_name}}
                                     <input type="hidden" value="{{$collateral->id}}" name="collate[]" class="collate_check">
                                  </td>
                                  <td width="24%">{{$collateral->colateral_value}}</td>
                                  <td align="right" width="24%">{{$collateral->colateralevalution_date}}</td>
                                  <td align="right" width="4%"><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                 @endforeach 
                                  @php
                                   }
                                   @endphp

                            </table>
            </div>

             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

        @endif
            <!-- /.box-body -->
      </div>

     <!--/end Colleratels-->
     <!--garantee and Charges row-->

          <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Guarantors</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="guarantor" class="form-control select2 "  name="g[]" style="width: 100%;">
                        <option value="">--Select guarantors--</option>
                          @foreach($guarantors as  $guarantor)
                          <option value="{{$guarantor->member_id}}">{{$guarantor->first_name}} {{$guarantor->middle_name}} {{$guarantor->last_name}}</option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <div class="btn newguarantor">+</div>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table table45" width="100%">
                                <thead class="thead-dark" style="background-color: #eee;">
                                <tr>

                                  <th width="24%">Firstname</th>
                                  <th width="24%">Middlename</th>
                                  <th align="right" width="24%">Lastname</th>
                                  <th align="right" width="4%"></th>
                                </tr> 
                              </thead>
                              <tbody>

                                 @php
                                   if(empty(old('guarantor'))){
                                 @endphp
                                @foreach($loan->guarantor as $grantors)
                                <tr>

                                  <td >{{$grantors->first_name}} <input type="hidden"  class="guarator_check" name="guarantor[]" value="{{$grantors->member_id}}"  /> </td>
                                  <td> {{$grantors->middle_name}} </td>
                                  <td > {{$grantors->last_name}} </td>
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach 

                                @php
                                    }
                                @endphp
                              </tbody>
                                
                                  @php 
                                     if(!empty(old('guarantor'))){
                                  $guras=\App\Member::whereIn('member_id',old('guarantor'))->get();
                                   @endphp
                                @foreach($guras as $gura)
                                      
                                 <tr>
                                  <td width="24%">{{$gura->first_name}}
                                     <input type="hidden" value="{{$gura->member_id}}" name="guarantor[]" class="guarantor_check">
                                  </td>
                                  <td width="24%">{{$gura->middle_name}}</td>

                                  <td align="right" width="24%">{{$gura->last_name}}</td>
                                  <td align="right" width="4%"><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                 @endforeach 
                                  @php
                                   }
                                   @endphp
                            </table>
            </div>

             <div class="form-group">
              <label for="charges" class="col-md-12">Charges</label>
                    <div class="col-sm-4">
                      <select id="charges" class="form-control select2" name="charges" style="width: 100%;">
                        <option value="">--Select Fee--</option>
                        @foreach($fees as  $fee)
                          <option value="{{$fee->id}}">{{$fee->fee_name}} </option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <button class="btn newcharge">+</button>
                    </div>
              </div><br/><br/>

            <div class="col-md-12">
              <table class="fee  table" width="100%">
                               <thead class="thead-dark" style="background-color: #eee;">
                                <tr>
                                  <th width="24%">Fee </th>
                                  <th width="24%">Amount</th>
                                  <th align="right" width="4%"></th>
                                </tr>
                                </thead>
                                 @php
                                if(empty(old('charges'))){
                                @endphp
                               @foreach($loan->loan_fees as $fee)
                                <tr>

                                  <td >{{$fee->fee_name}} <input type="hidden" name="charges[]" value="{{$fee->id}}" / class="charge_check"> </td>
                                  <td> {{$fee->fee_value}} </td>
                                  
                                  <td width="20%" ><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                @endforeach 
                                @php
                              }
                              @endphp


                                  @php 
                                     if(!empty(old('charges'))){
                                  $charges=\App\Feescategory::whereIn('id',old('charges'))->get();
                                   @endphp
                                @foreach($charges as $charge)
                                      
                                 <tr>
                                  <td width="24%">{{$charge->fee_name}}
                                     <input type="hidden" value="{{$charge->id}}" name="charges[]" class="charge_check">
                                  </td>

                                   <td width="24%">{{$charge->fee_value}}
                                   
                                  </td>
                                  
                                  <td align="right" width="4%"><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                 @endforeach 
                                  @php
                                   }
                                   @endphp 
                            </table>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>


         <div class="box col-md-12 box-info">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group{{$errors->has('file') ? ' has-error' : '' }}">

                <label for="">Add Attachment</label>
               <input name="file" type="file" multiple />
                <small class="text-danger">{{ $errors->first('file') }}</small> 
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

      <!--submit row-->
      <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              
              <div class="form-group">
                    <button   value="Post"  class="form-control btn btn-info pull-left"
                   data-toggle="confirm" 
                   data-title="Warning!" 
                   data-message="The posted amount cannot be edited!. Do you want to post this ? "
                   data-type="info">
                   Update
                   </button>
              </div>
            </div>
          
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

     <!--/end submit -->

          <!-- /.box -->
        </div>

      </form>


    @endsection


      @section('js')
      <script type="text/javascript">
        

                     $(document).ready(function () {


// code to get all records from table via select box
$('#pcategory').change(function()
{ 

var pcategoryid = $(this).find(":selected").val();

    
var dataString = 'pcategory='+ pcategoryid;
   
   
$.ajax
({
         
url:'{{route('interest')}}',
type:"GET",
 dataType: 'json',
data: dataString,
cache: true,
success: function(data)
{
$("#interest").val(data.interest);
$("#period").val(data.duration);
}

});
})

});






           $(document).ready(function() {
      /*charges row script */

    $(".newcolerateral").click(function () {

          

          var collateralid=$("#collateral").val();
                 
                  var dataString='collateral='+ collateralid;
                       



 if(collateralid !=''){
  var check='';
  var inputs=$(".collate_check");
  if (inputs.length > 0){
  for(var i = 0; i < inputs.length; i++){
  if ($(inputs[i]).val()===collateralid ) check=1;
  }
    }
  if (check===''){

       //alert('mmmmmhh');
$.ajax({         
url:'{{route('membercollateral')}}',

type:"GET",
 dataType: 'json',
 data:dataString,
cache: true,
success: function(data)
{
    //alert(data);
      var row = $(".table44").find('tr:last');
        $('<tr><td>'+data.asset+'</td><td>'+data.value+'</td><td>'+data.duration+'<input type="hidden" value="'+data.id+'" name="collate[]" class="collate_check"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#collateral").val('');
}

});

}
else  alert('Repeated collateral');

}
        return false;
  
});
    /* /end of garanters row */

    /*remove script*/
    $('.fee,.table44').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

/*charges row script */
    $(".newcharge").click(function () {
      
        if ( $("#charges").val() !='')
        { 

          var charge_id=$("#charges").val();  
          var dataString='charge_id='+charge_id;

           var check='';
  var inputs=$(".charge_check");
  if (inputs.length > 0){
  for(var i = 0; i < inputs.length; i++){
  if ($(inputs[i]).val()===charge_id) check=1;

  }
    } 
             if (check===''){
              $.ajax({         
              url:'{{route('loancharges')}}',

              type:"GET",
               dataType: 'json',
               data:dataString,
              cache: true,
              success: function(data)
              {
                     var row = $(".fee").find('tr:last');
        $('<tr><td>'+data.fee_name+'<input type="hidden" name="charges[]" class="charge_check" value="'+data.id+'" ></td><td>'+data.fee_value+'</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
                      $("#charges").val('');
              }

              });

            }else{
               
               alert('Repeated charge');

            }

        }
        return false;
    });
/*end of charge row */
});   







     //guarantor


        $(document).ready(function() {
   

    $(".newguarantor").click(function () {

           
                
          var guarantorid=$("#guarantor").val();
                 
                  var dataString='g='+ guarantorid;

                
             //     alert(dataString);
 if(guarantorid !=''){


 var check='';
  var inputs=$(".guarator_check");

  if (inputs.length > 0){
  for(var i = 0; i < inputs.length; i++){
  if ($(inputs[i]).val()===guarantorid) check=1;

  }
    } 

    if (check===''){
     
$.ajax({         
url:'{{route('guarantors')}}',
type:"GET",
 dataType: 'json',
 data:dataString,
cache: true,
success: function(data)
{
    //alert(data);
      var row = $(".table45").find('tr:last');
        $('<tr><td>'+data.firstname+'</td><td>'+data.middlename+'</td><td>'+data.lastname+'<input type="hidden" value="'+data.id+'" name="guarantor[]" class="guarator_check"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#guarantor").val('');
}

});

  }else{

      alert('repeated guarantor');
  }
}
        return false;
  
});
    /* /end of garanters row */

    /*remove script*/
    $('.table45').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

/*charges row script 
    $(".newcharge").click(function () {
        if ( $("#charges").val() !='')
        {
        var row = $(".fee").find('tr:last');
        $('<tr><td>'+$("#charges").val()+'</td><td>1.2%</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#charges").val('');
        }
        return false;
    });
end of charge row */
});                         

      </script>

       @endsection



        