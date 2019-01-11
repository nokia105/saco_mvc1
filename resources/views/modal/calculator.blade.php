
<div class="col-md-12">
    <form class="calculator">
       {{csrf_field()}}
               <br/>
             <div class="form-row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Principles</label>
                        <div class="">
                            <input type="text" name="principle" class="form-control principle" value="{{$principle}}" id="principle" />
                        </div>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Rate</label>
                        <input type="text" name="rate" class="form-control rate" id="rate" value="{{$interest}}" />
                       <span class="text-danger"></span>
                    </div>
              </div>

              <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Period</label>
                        <input type="text"  name="period"  class="form-control period" id="period"  value="{{$period}}" />
                       <span class="text-danger"></span>
                    </div>
                 
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Start date</label>
                        <input type="text" name="start_date" class="form-control start_date datepicker" id="start_date" value="{{$firstpayment}}" />
                        <span class="text-danger"></span>
                    </div>
              </div>
             </form> 
              
           
             
              <br/>
              <br/>
             <!--  <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <button class="btn btn-primary col-md-offset-3 col-md-3" style="margin-top: 20px;">Submit <i class="fa fa-send-o" style="color:green; font-size:15px;"></i></button>
              </div>
            </div> -->
           </form>
           <div class="loan_cal col-md-12">
               
                
             
             
           </div>
        </div>


<script>
  if (($('.principle').val().length !=0) && ($('.rate').val().length !=0) && ($('.period').val().length !=0)) {
        $.ajax({
        type: "GET",
        url: '{{route('calculator')}}',
        data:$('.calculator').serialize(),
        
        success:  function(data){
          //alert(data);
        $('.loan_cal').html(data);

         // location.reload();
        }

     
  });
}
else{
  $('.loan_cal').html('');
}

$('.principle,.rate,.period,.start_date').keyup( function (ev) {
    //ev.preventDefault();
    //alert('principle:'+$(".principle").val()+'rate:'+$(".rate").val()+'period:'+$(".period").val()+'date:'+$(".start_date").val());
if (($('.principle').val().length !=0) && ($('.rate').val().length !=0) && ($('.period').val().length !=0)) {
        $.ajax({
        type: "GET",
        url: '{{route('calculator')}}',
        data:$('.calculator').serialize(),
        
        success:  function(data){
          //alert(data);
        $('.loan_cal').html(data);

         // location.reload();
        }

     
  });
}
else{
  $('.loan_cal').html('');
}

 });

</script> 
                 
                    
            
     
   

