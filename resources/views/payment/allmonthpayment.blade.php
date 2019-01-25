   @extends('layouts.master')
      @section('content')
      
          @section('title', '| Pay List')
       <div class="row">
       <div class="col-xs-12">

          <div id='modal_dialog'  style="display:none">
    <div class='title'>
    </div>
    <input type='button' value='yes' id='btnYes' />
    <input type='button' value='no' id='btnNo' />
</div>


         <div class="error" style="text-align:center">


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

              <div class="alert alert-success" style="display:none"></div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payments</h3>
            </div>
            <!-- /.box-header -->
            <div class="mainprinting pull-right col-md-3" style="text-align: right;">
             <div class="printcheck" >
                <button id="printcheck"><i class="fa fa-print"></i> print</button>
             </div>
             <div class=""  >
                <button id="pay" onclick='confirm("You are about to post data! The posted data can not be changed ")'>Pay</button>
             </div>
           </div>
             
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox"  id="checkall" class="checkbox"  value="checkall"></th>
                   <th>#</th>
                  <th>Name</th>
                  <th>Shares </th>
                  <th>Savings </th>
                  <th>Current Loan</th>
                  <th>Previous Loan</th>
                  <th>Total</th>
                  <th>Action</th>
                  <td>Status</td>
                </tr>
                </thead>
                <tbody>
                  @foreach($monthpaymentlists as $monthpaymentlist)

                 <tr>
                  <td><input type="checkbox"  id="checklist" class="checkbox" name="check[]" value="{{$monthpaymentlist->member_id}}"></td>
                <td>{{$monthpaymentlist->member->registration_no}}</td>
                <td>{{ucfirst($monthpaymentlist->member->first_name)}}  {{ucfirst($monthpaymentlist->member->last_name)}}</td>
                <td>{{number_format($share=$monthpaymentlist->shares,2)}}</td>
                <td>{{number_format($savings=$monthpaymentlist->savings,2)}}</td>
                <td>{{number_format($c_loan=$monthpaymentlist->current_loan,2)}}</td>
                <td>{{number_format($p_loan=$monthpaymentlist->previous_loan,2)}}</td>
                <td>{{number_format(($share+$savings+$c_loan+$p_loan),2)}}</td>
                 <td> <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('editpaymentlist',$monthpaymentlist->id)}}')" >
        <i class="fa fa-edit" style="color:green; font-size:15px;"></i>Edit</a> </li>
        
                                 
         </ul>
         </div></td>
                <td>{{strtoupper($monthpaymentlist->status)}}</td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


     

                      

             <div class="row">

            <div  id="printtable" class="container-fluid"  style="display:none">
 <div style="margin-bottom:5px;">
   </div> 

        <div  id="div" class="col-md-8" style="background-color:#fff; margin-top:px;">
     <div class="info" style="margin-top:20px; margin-left: 300px;";>
    
     <div style="margin-top:20px;">
    <strong>TASAF SACOSS</strong>
</div>

     <div class="img">
     <img src="{{asset('/images/logo/saccos.jpg')}}" style="">
     </div>
  </div>
  <div style="float:right; margin-bottom:10px;">
     <br>
   Date: {{date('d/m/Y')}}
   </div>

   <div style="padding-left:300px; margin-top:30px; margin-bottom: 10px;">
   <label><strong>MONTHLY PAYLIST</strong></label>
  </div>


   </div>
    
   <div id="table">

  <table class="table table-striped table-bordered">
  <thead>
    <tr>
                 <th>Member #</th>
                  <th>Full Names</th>
                  <th>Shares </th>
                  <th>Savings</th>
                  <th>Current Loan </th>
                  <th>Previous Loan</th>
                  <th>Total</th>
                  <th>Status</th>
    </tr>
  </thead>
  <tbody id="printcontent">
    
  </tbody>
</table>
</div>
</div>

        <!-- /.col -->

</div>
</div>


 @endsection



   @section('css')

          <style type="text/css">
            @page { size: auto;  margin:5mm; } 
      .mainprinting { 
    
    margin: 0 auto;
}
.printcheck    {
     margin-left: 30%;
    background: red;
    float: left;
}

.printdispatch  {
   
    background: #ffffff;
    margin-left: 50%;
}

          </style>

        @endsection



 
         @section('js')
        <script type="text/javascript">




               $(document).ready(function(){
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#printcheck').click(function(e){
                    var allVals = [];

                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });
                         
                       
                           if (allVals.length ===0) {

                         alert('not checked');
                       } else {
                           

                                var url_link="{{url('/')}}/printallmember_topay";
                                
                        // var $body = $("body");

                           $.ajax({
                           type: "GET",
                           url: url_link,
                           data:'array='+allVals,                                                           
                            success:  function(data){


                                $('#printcontent').html(data);
                                       
                             var restorepage=document.body.innerHTML;
                             var printContent=document.getElementById("printtable").innerHTML;
                             document.body.innerHTML=printContent;
                             window.print();

                             document.body.innerHTML=restorepage;


                               location.reload();
                             }
                            });
                          return;
                     
                      }

                });
                 
            });





                    $(document).ready(function(){
                    
                    
                  $('#checkall').click(function (e) {
                    
              $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);


                });

                $('#pay').click(function(e){
                       
                    var allVals = [];

                    $('input[type="checkbox"]:checked').each(function () {
                     allVals.push($(this).val());
                      });

                      alert(allVals);
                         
                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                           

                           $.ajax({

                           method: "GET",
                           url:'{{route('pay_allmembers')}}',
                           dataType:'json',
                           data:{ array:allVals, _token:'{{csrf_token()}}'},                                                           
                            success:function(data){

                               $('.alert').show();
                               $('.alert').html(data.success);

                               setTimeout(function(){
                               window.location.reload();
                               }, 2000);
                                  
                             }
                            });
                          return;
                     
                      }

                });
                 
            });


        </script>
          @include('modal.popup_lib')
        @endsection
         
   
     

       


     
 

