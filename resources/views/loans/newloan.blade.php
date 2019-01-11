    <!-- Main content -->

     @extends('loans.template')
      @section('memberworkspace')

       @section('title', '| New Loan')

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
      
      <form method="post" action="{{url('/memberloan')}}">

          {{csrf_field()}}

          <input type="hidden" value="{{$id=request()->route('id')}}" name="memberloan"> 
     <div class="col-md-12">
          <div class="box col-md-12 box-info">
            <div class="box-header">
             
              <h3 class="box-title">New Loan</h3><a  onclick="showAjaxModalX2('{{route('calculator_popup')}}')"><span class="btn btn-success pull-right">Loan Calculator</span></a>
            </div>
            <!-- /.box-header -->
         <div class="box box-body box-info">
          <div class="row">
            <div class="col-md-6">
              <div class="box-header">
              <h3 class="box-title">Basic Details</h3>
            </div>
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
                  <label for="">Cashier:</label>
                  <input type="text" class="form-control" id="loanOfficer" value="{{$username->first_name}} {{$username->middle_name}} {{$username->last_name}}"  name="loanOfficer"  placeholder="Enter name" readonly="true">
              </div>
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


     <!--terms row-->
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
                  <input type="text" class="form-control" id="principle" name="principle" placeholder="100000" value="{{ old('principle')}}">
                   <small class="text-danger">{{ $errors->first('principle')}}</small>
                </div>
                <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                  <label for="">Interest in percentage</label>
                  <input type="text" class="form-control" name="interest" id="interest" value="{{ old('interest')}}">
                  <small class="text-danger">{{ $errors->first('interest') }}</small>
                </div>
                <div class="form-group{{ $errors->has('Imethod') ? ' has-error' : '' }}">
                <label>Interest Method</label>
                <select class="form-control select2" id="Imethod"  name="Imethod" style="width: 100%;">
                   @foreach($interestmethods as $interestmethod)
                    @if(\Illuminate\Support\Facades\Input::old('Imethod')==$interestmethod->id)
                    <option value="{{$interestmethod->id}}" selected>{{$interestmethod->method}}</option>
                      @else
                         <option value="{{$interestmethod->id}}">{{$interestmethod->method}}</option>
                     @endif
                  @endforeach
                </select>
                    <small class="text-danger">{{ $errors->first('Imethod') }}</small>
              </div>

              <div class="btn btn-success" id="calculate">calculate</div>
         
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                  <label for="" class="col-md-12">Period</label>
                
                    <div class="col-sm-8{{ $errors->has('period') ? ' has-error' : '' }}">
                        <input type="number" min=0 class="form-control"  name="period" value="{{old('period')}}" id="period">
                        <small class="text-danger">{{ $errors->first('period') }}</small>
                    </div>
                    <div class="col-sm-4">
                        <select class="col-md-4 form-control"  name="loanwm" style="width: 100%;">
                          <option value="month">Month</option>
                          <!-- <option value="week">Week</option> -->
                        </select>
                    </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12{{ $errors->has('startpayment') ? ' has-error' : '' }}">
                   <br/>
                  <label for="">First payment date</label>
                  <input type="text"  id="startpayment" class="form-control  datepicker span2"  name="startpayment"  value="{{old('startpayment')}}" placeholder="yyyy-mm-dd" autocomplete="off">
                    <small class="text-danger">{{ $errors->first('startpayment') }}</small>
                </div>


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
              <h3 class="box-title">Salary Slip:</h3>
            </div>
         <div class="box-body">
          <div class="row">
            <div class="col-md-8">
              
          <div class="col-sm-12{{$errors->has('file') ? ' has-error' : '' }}">

                <label for="">upload Salary Slip</label>
               <input name="file" type="file" multiple />
                <small class="text-danger">{{ $errors->first('file') }}</small> 
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

                            <table class="table45  table" width="100%">
                              <thead class="thead-dark" style="background-color: #eee;">
                                <tr>

                                  <th width="24%">Full Names</th>
                                  <th width="">Reg #</th>
                                  <th width="24%">Shares</th>
                                  <th align="right" width="24%">Savings</th>
                                  <th align="right" width="4%">Salary (Tsh)</th>
                                </tr> 
                              </thead>

                               @php 
                                     if(!empty(old('guarantor'))){
                                  $guras=\App\Member::whereIn('member_id',old('guarantor'))->get();
                                   @endphp
                                @foreach($guras as $gura)
                                      
                                 <tr>
                                  <td width="24%">{{ucfirst($gura->first_name)}} {{ucfirst($gura->middle_name)}} {{ucfirst($gura->last_name)}}
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
        <textarea class="form-control" rows="4"  name="narration"  value="{{old('narration')}}"  required="true"  autocomplete="off"></textarea>
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
    

      <!--submit row-->
      @role('Cashier|Secretary','member')
      <div class="box col-md-12 box-danger">
        <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Submit & Save"   name="submit"  class="form-control btn btn-success pull-left">
              </div>
            </div>

             <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="draft"  name="submit" class="form-control btn btn-info pull-left" >
              </div>
            </div>
            <!-- /.col -->
         
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

       @endrole

     <!--/end submit -->

          <!-- /.box -->
        </div>
      
       </form>

        <style type="text/css">


          
          .modal-header {
            
            border-bottom:1px solid red;
          }

          /*.modal-content {
            border:5px solid #00BFFF;
          }*/

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
       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                 <div><h4>Loan  Requestor: <strong id="Name"></strong></h4></div>
              </div>
              <div class="modal-body">

                  <div class="col-md-6">
                <div> <h4>Monthly repayment  <strong id="mrepayment"></strong> Tsh</h4></div>
                <div><h4>First repayment  <strong id="frepayment"></strong></h4></div>
                <div><h4>Last repayment  <strong id="lrepayment"></strong></h4></div>
                     
                    </div> 
                 <div class="col-md-6">
                   <div class="duration"> <h4>Loan Duration <strong id="lduration"></strong> Month(s)</h4></div>
               <div> <h4>principle is <strong id="lprinciple"></strong> Tsh</h4></div>
               <div> <h4>Interest is <strong id="linterest"></strong> %</h4></div>
                 </div>
                 
                <div><h4>Loan issued by  <strong id="lofficer"></strong></h4></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">close</button>
                <button id="button" onclick="printDiv('print')">Download PDF <i class="fa fa-file-pdf-o"></i></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

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
            

              //interest method pop up


          $(document).ready(function () {


// code to get all records from table via select box
$('#calculate').click(function()
{ 

 
var pcategoryid = $(this).find(":selected").val();

  
    var principle=$('#principle').val();

     var period=$('#period').val();
      var interest=$('#interest').val();
      var startpayment=$('#startpayment').val();
      var Imethod=$('#Imethod').val();
      var loanrequestor=$('#loanrequestor').val();
      var loanOfficer=$('#loanOfficer').val();
      url="{{ url('/') }}/calculator_popup/?principle="+principle+"&interest="+interest+"&period="+period+"&startpayment="+startpayment;
      //alert(startpayment);
      showAjaxModalX2(url);

       /*var dataString='principle='+principle+'&period='+period+'&interest='+interest+'&startpayment='+startpayment+'&Imethod='+Imethod+'&loanrequestor='+loanrequestor+'&loanOfficer='+loanOfficer;*/



         
         
/*$.ajax
({
         
url:'{{route('interestmethod')}}',
type:"GET",
 dataType: 'json',
data: dataString,
cache: true,
success: function(data)
{

var dwn_url='<a href="{{url('/')}}/pdf_download/'+data.principle+'/'+data.interest+'/'+data.loanperiod+'/'+data.firstpayment+'">Download PDF <i class="fa fa-file-pdf-o"></i></a>'
           
$("#lprinciple").html(data.principle);
$("#Name").html(data.loanrequestor);
$("#linterest").html(data.interest);
$("#mrepayment").html(data.monthlyrepayment);
$("#frepayment").html(data.firstpayment);
$("#lrepayment").html(data.lastpayment);
$("#lofficer").html(data.loanOfficer);
$("#lduration").html(data.loanperiod);
// $("#pdfview").html(dwn_url);

}

});*/
})

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

                
             //     alert(dataString);
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
    //alert(data);
      var row = $(".table45").find('tr:last');
        $('<tr><td>'+data.fullname+'</td><td>'+data.member_no+'</td><td><td>'+data.totalshare+'</td><td>'+data.totalsaving+'</td>'+data.salary+'<input type="hidden" value="'+data.id+'" name="guarantor[]" class="guarantor_check"></td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
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
@include('modal.popup_lib')
       @endsection