   @extends('layouts.master')
      @section('content')
      
          @section('title', '| Post')
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
                <button id="pay" onclick='confirm("You are about to post data! The posted data can not be changed ")'> Pay</button>
             </div>
           </div>
             
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox"  id="checkall" class="checkbox"  value="checkall"></th>
                   <th>Member #</th>
                  <th>Full Names</th>
                  <th>Shares </th>
                  <th>Savings </th>
                  <th>Interest</th>
                  <th>Principle</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($members as $member)
                 <tr>
                  <td><input type="checkbox"  id="checklist" class="checkbox" name="check[]" value="{{$member->member_id}}"></td>
                 <td>{{$member->registration_no}}</td> 
                 <td>{{ucfirst($member->first_name)}} {{ucfirst($member->last_name)}} {{ucfirst($member->middle_name)}}<a href=""></a></td>     
                <td>{{number_format($share=$member->monthshare,2)}}</td>
                <td>{{number_format($saving=$member->monthsaving,2)}}</td>

                 @if(count($member->loans))
                  @php 
                      $month=date('m',strtotime(date('Y-m-d'))); 
                      $year=date('Y',strtotime(date('Y-m-d')));
                  @endphp
                <td>{{$interest=$member->loan->loanschedule->whereMonth('duedate','<=',$month)->whereYear('duedate','<=',$year)->where('status','=','!paid')->sum('monthinterest')}}</td>
                <td>{{$principle=$member->loan->loanschedule->where('status','=','unpaid')->whereMonth('duedate',$month)->whereYear('duedate',$year)->sum('monthprinciple')}}</td>
                <td>{{number_format($share+$saving+$interest+$principle,2)}}</td>
                  @endif
                  <td>{{number_format($interest=0.00,2)}}</td>
                  <td>{{number_format($principle=0.00,2)}}</td>
                 <td>{{number_format($share+$saving+$interest+$principle,2)}}</td>
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
   Date: {{date('d-m-Y')}}
   </div>

   <div style="text-align:center; margin-top:30px; margin-bottom: 10px;">
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
                  <th>Savings </th>
                  <th>Interest</th>
                  <th>Principle</th>
                  <th>Total</th>
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
                         
                           if (allVals.length ===0) {
                         alert('not checked');
                       } else {
                           

                           $.ajax({

                           method: "post",
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
        @endsection
         
   
     

       


     
 

