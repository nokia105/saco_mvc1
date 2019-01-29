@extends('member.member_template')
@section('memberinfo')
 @section('title', '|New Loan')
  <style type="text/css">
    .summary_savingshare h4{
      text-align: center;
      color:#000;
    }
    .summary_savingshare h5{
      padding-left:20px;
      font-size:14px;

    }

    .box-info  .box-header .btn-info{
      background-color:#72e5d7;
      color:#000;
      outline:none; 
    }

  </style>

  <div class="error" style="padding-top:50px; text-align:center;">

            @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>
                @endif
            
            @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>
         <form method="POST" action="{{route('store_appliedloan')}}">
           {{csrf_field()}}
                <input type="hidden" value="{{$id=request()->route('id')}}" name="memberid"> 

                  @php
                     $member=App\Member::findorfail($id);
                     $guarantors=App\Member::all()->where('member_id','!=',$id);
                     $collaterals=App\Member::find($id)->collateral;    
                  @endphp
          <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
              <h3 class="box-title">New Loan</h3>
              <a class="pull-right btn btn-info loan_possiblity">Check Loan Possiblity </a>

            </div>
            <!-- /.box-header -->
         <div class="box box-body box-info">
          <div class="row">
                
             <div class="notification" style="display:none; ">
               <button type="button"  class="pull-right close" aria-hidden="true">&times;</button>
               <div class="summary_savingshare">
                  <h4>Savings & Share Summary</h4>
                  <h5>Current Shares : <label> {{number_format($member->no_shares->where('state','in')->sum('amount')-$member->no_shares->where('state','out')->sum('amount'),2)}}</label></h5>
                   <h5>Current Savings : <label> {{number_format($member->savingamount->where('state','in')->sum('amount')-$member->savingamount->where('state','out')->sum('amount'),2)}}</label></h5>
                         <h4><strong>{{$lastloans->count()}} </strong> Current Outstanding Loans</h4>
                         <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Loan Code</th>
        <th>Inssued Date</th>
        <th>Principle</th>
        <th>Outstanding</th>
        <th>Remaining Month(s)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
         @php $i=1; @endphp
        @foreach($lastloans as $lastloan)
      <tr>
        <td>{{$i}}</td>
       <td>{{$code+$lastloan->id+$lastloan->member->member_id}}</td>
       <td>{{ \Carbon\carbon::parse($lastloan->loanInssue_date)->format('d/m/Y')}}</td>
       <td>{{number_format($lastloan->principle,2)}}</td>
       <td>{{number_format(($lastloan->principle)-($lastloan->loanrepayment->sum('principlepayed')),2)}}</td>
       <td>{{$lastloan->loanschedule->where('status','unpaid')->count()}}</td>
       <td>{{strtoupper($lastloan->loan_status)}}</td>
      </tr>
       @php $i++; @endphp
      @endforeach
    </tbody>
  </table>
                     <h4>Maximum Possible Loan</h4>
                     <h5>Maximum loan we can offer : <label>{{number_format($loanallowed,2)}}</label></h5>
                      
               </div>
                     
                        
             </div>
         
            
              <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>

               <div class="col-md-6">

              <div class="form-group{{ $errors->has('pcategory') ? ' has-error' : '' }}">
                <label>Product Category</label>
                <select class="form-control select2" style="width: 100%;" id="pcategory" name="pcategory">
                    <option value="">--Select Category--</option>
                  @foreach($loancategories as $loancategory)

                     @if(\Illuminate\Support\Facades\Input::old('pcategory')==$loancategory->id)
                    <option value="{{$loancategory->id}}" selected>{{$loancategory->category_name}}</option>
                      @else
                         <option value="{{$loancategory->id}}">{{$loancategory->category_name}}</option>
                     @endif

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
                  <label for="exampleInputEmail1">Loan Requestor</label>
                  <input type="text" class="form-control"  id="loanrequestor" name="loanrequestor" value="{{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}" readonly="true">
              </div>
            <!-- </div> -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>

       <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Terms</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('principle') ? ' has-error' : '' }}">
                  <label for="principle">Principle</label>
                  <input type="number" class="form-control" id="principle" name="principle" placeholder="100000" value="{{ old('principle')}}">
                   <small class="text-danger">{{ $errors->first('principle')}}</small>
                </div>
                <div class="form-group">
                  <label for="" class="col-md-6">Loan Period</label>
                
                    <div class="col-sm-8{{ $errors->has('period') ? ' has-error' : '' }}">
                        <input type="number"  class="form-control"  name="period" value="{{old('period')}}" id="period">
                        <small class="text-danger">{{ $errors->first('period') }}</small>
                    </div>
              </div>

             
         
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              
                    <div class="col-sm-12{{ $errors->has('startpayment') ? ' has-error' : '' }}">
                         <div class="form-group">
                  <label for="">First Payment on</label>
                  <input type="text"  id="startpayment" class="form-control datepicker span2 startpayment"  name="startpayment"  value="{{old('startpayment')}}" placeholder="yyyy-mm-dd" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('startpayment') }}</small>
              </div>
               <div class="btn btn-info" id="calculate" >calculate</div>
            </div>
            </div>

               
        
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
          </div>

 

    <div  style="padding-bottom:15px;"><input id="checkbox" type="checkbox" name="checkbox"><h4><strong> Use Collaterals</strong></h4></div>
           
             <div class="collateral_checkbox">

                 <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Collateral</h3>
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
               
             </div>

      <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h3 class="box-title">Guarantors</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
               <div class="form-group">
                    <div class="col-sm-4">
                      <select id="guarantor" class="selectguarantor form-control"    name="g[]" style="width: 100%;">
                        <option value="">--Select guarantors--</option>
                          @foreach($guarantors as  $guarantor)
                          <option value="{{$guarantor->member_id}}">{{$guarantor->first_name}} {{$guarantor->middle_name}} {{$guarantor->last_name}}</option>
                          @endforeach
                      </select>
                       
                    </div>
                    <div class="col-sm-1">
                        <div class="btn newguarantor"><button class="btn btn-primary">+Add</button></div>
                    </div>
              </div><br/><br/>
            
            <div class="col-md-12">

                            <table class="table45  table" width="100%">
                              <thead class="thead-dark" style="background-color: #eee;">
                                <tr>
                                   <th width="">Reg #</th>
                                  <th>Full Names</th>
                                  <th>Cancel</th>
                                </tr> 
                              </thead>

                               @php 
                                     if(!empty(old('guarantor'))){
                                  $guras=\App\Member::whereIn('member_id',old('guarantor'))->get();
                                   @endphp
                                @foreach($guras as $gura)
                                      
                                 <tr>
                                  <td>{{$gura->registration_no}}</td>
                                  <td width="24%">{{ucfirst($gura->first_name)}} {{ucfirst($gura->middle_name)}} {{ucfirst($gura->last_name)}}
                                     <input type="hidden" value="{{$gura->member_id}}" name="guarantor[]" class="guarantor_check">
                                  </td>
                                  <td align="right" width="4%"><input type="button" class="remove" style="color:red;" value="X" /></td>
                                </tr>
                                 @endforeach 
                                  @php
                                   }
                                   @endphp
                            </table>
            </div>
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-body -->
      </div>


       <div class="box col-md-12 box-primary">
        <!-- /.box-header -->
        <div class="box-header">
              <h3 class="box-title">Loan Reason</h3>
            </div>
         <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              
              <div class="form-group{{ $errors->has('narration') ? ' has-error' : '' }}">
        <label for="reason">Narration:</label>
        <textarea class="form-control" rows="4"  name="narration"  required="true"  autocomplete="off">{{old('narration')}}</textarea>
        <small class="text-danger">{{ $errors->first('narration') }}</small>
      </div>
            </div>
            <!-- /.col -->
         
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
    
      <div class="box col-md-12 box-danger">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              
              <div class="form-group">
                 <button class="btn btn-success">Submit</button>
                  <input type="hidden"  value="draft"   name="submit"  class="form-control btn btn-success pull-left">
              </div>
            </div>

            <!-- /.col -->
         
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

        <style type="text/css">


          
          .modal-header {
            
            border-bottom:1px solid red;
          }

          .modal-content {
            border:5px solid #00BFFF;
          }

          .modal-content h4{
            font-family: 'Rokkitt', serif;
          }
            .modal-footer button i{
              color:red;
            }

           .close{
            outline:0; 
            color:red;
            font-size:30px;
           }
            .close span:hover{
               color:red;
            } 
        </style>


        <div id="print" style="display:none;">
           <div class="container">


   <div class="loaninfo">
     <div class="company">
  <label>TASAF SACOSS</label>
  </div>

      <div class="col-md-6">
         
           <label>Principle is <strong> Tsh</strong> </label>
           
                    <br>
                    <br>
         
          <label>Interest is <strong> %</strong></label>
        
                
             
      </div>


       <div class="col-md-6">

         
                <label>Date Created: <strong></strong></label>
             
                          <br>
                          <br>
      
                <label>Loan Duration: <strong> Month(s)</strong></label>
              
      
    </div>
   </div>
  
      
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col"> Month</th> 
      <th scope="col">Date</th>
      <th scope="col">Monthly Payment(Tsh)</th>
      <th scope="col">Monthly Interest(Tsh)</th>
      
    </tr>
  </thead>
  <tbody>
     @for($i=0; $i<5; $i++)
    <tr>
      
      <td scope="row"> </td>
      <td> @php 
                    echo  date('Y-m-d', strtotime($i.' month', strtotime(2018-05-06)));
                @endphp</td>
      <td> </td>
      <td></td>
      
     
      
    </tr>
     @endfor
    
  </tbody>
</table>
</div>
</div>

    <h4>Loan issued by <lable>{{Auth::guard('member')->user()->first_name}}</lable></h4>
        </div>
    @endsection

      @section('js')
      <script type="text/javascript">

                  $(document).ready(function() {
    $('.selectguarantor').select2();
});

          $(document).ready(function () {

             $('.notification').css({ 'display':'block','backgroundColor': '#72e5d7','right': '-2%' ,'z-index':'1','position':'absolute','borderRadius':'10px'}).animate({
                    'left' : '0%'    
                },1000);

              $('.close').click(function(){
                 $('.notification').addClass('fade');
                   $('.notification').fadeOut();
              });

              $('.loan_possiblity').click(function(){
                  $('.notification').removeClass('fade');
                  $('.notification').fadeIn();

              });


// code to get all records from table via select box
$('#calculate').click(function()
{ 
var principle=$('#principle').val();
 //alert(principle);
//var pcategoryid = $(this).find(":selected").val();

  
    var principle=$('#principle').val();

     var period=$('#period').val();
      //var interest=$('#interest').val();
      var startpayment=$('.startpayment').val();
      var Imethod=$('#Imethod').val();
      /*var loanrequestor=$('#loanrequestor').val();
      var loanOfficer=$('#loanOfficer').val();*/
      url="{{ url('/') }}/calculator_popup/?principle="+principle+"&interest=&period="+period+"&startpayment="+startpayment;
      //alert(startpayment);
      showAjaxModalX2(url);


});

});
        

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
 
   $(document).ready(function(){

         $('.collateral_checkbox').hide();

        $('#checkbox').click(function(){

     $(".collateral_checkbox").toggle();
        });
      
      
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



   function printDiv(div){
   
     var restorepage=document.body.innerHTML;
     var printContent=document.getElementById(div).innerHTML;
     document.body.innerHTML=printContent;
     window.print();
     document.body.innerHTML=restorepage;

      $(".modal").modal('toggle');

   }

     //guarantor


        $(document).ready(function() {
   

    $(".newguarantor").click(function () {

             
          var guarantorid=$("#guarantor").val();
                 
                  var dataString='g='+ guarantorid;

                       
              //  alert(dataString);
 if(guarantorid !=''){


 var check='';
  var inputs=$(".guarantor_check");
    
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
   // alert(data);
      var row = $(".table45").find('tr:last');
        $('<tr><td>'+data.member_no+'</td><td>'+data.fullname+'</td><input type="hidden" value="'+data.id+'" name="guarantor[]" class="guarantor_check"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
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
});                         

</script>
@include('modal.popup_lib')
 @endsection