<style type="text/css">
  .datepicker {
    z-index: 100000;
       }
</style>
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
                 
                    <div class="form-group  col-md-6">
                        <label for="exampleInputEmail1">Start date</label>
                        <input type="text"  name="start_date"  class="form-control start_date datepicker" id="start_date"  value="@php if (empty($firstpayment)) echo date('Y-m-d'); else echo $firstpayment;  @endphp" />
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
    //alert($('.start_date').val());
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
      <script>
    $(function(){
      window.prettyPrint && prettyPrint();
 
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
         minDate: '+1D'
      });
     
      
    $( ".datepicker_curr_next" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
 
      $('#dp2').datepicker();
      $('#dp3').datepicker();
      
      
      var startDate = new Date(2016,1,20);
      var endDate = new Date(2016,1,25);
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('The start date can not be greater then the end date');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').text($('#dp4').data('date'));
          }
          $('#dp4').datepicker('hide');
        });
      $('#dp5').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() < startDate.valueOf()){
            $('#alert').show().find('strong').text('The end date can not be less then the start date');
          } else {
            $('#alert').hide();
            endDate = new Date(ev.date);
            $('#endDate').text($('#dp5').data('date'));
          }
          $('#dp5').datepicker('hide');
        });
       

    });
  </script>
                 
                    
            
     
   

