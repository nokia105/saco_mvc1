@section('js')
<script>
$(function(){
  $('#dpMonths,#form').fdatepicker();
});

$(function(){
  // implementation of custom elements instead of inputs
  var startDate = new Date(2012, 1, 1);
  var endDate = new Date(2018, 1, 2);
  $('#dp4').fdatepicker()
    .on('changeDate', function (ev) {
    if (ev.date.valueOf() > endDate.valueOf()) {
      $('#alert').show().find('strong').text('The start date can not be greater then the end date');
    } else {
      $('#alert').hide();
      startDate = new Date(ev.date);

      $('#startDate').val($('#dp4').data('date'));
    }
    $('#dp4').fdatepicker('hide');
  });
  $('#dp5').fdatepicker()
    .on('changeDate', function (ev) {
    if (ev.date.valueOf() < startDate.valueOf()) {
      $('#alert').show().find('strong').text('The end date can not be less then the start date');
    } else {
      $('#alert').hide();
      endDate = new Date(ev.date);
      $('#endDate').val($('#dp5').data('date'));
    }
    $('#dp5').fdatepicker('hide');
  });
});

  $(document).ready(function(){

     $("input[type='radio']").click(function(){
            var radioValue = $("input[name='duration']:checked").val();
            if(radioValue=='cummulative'){

               $('#year,#month,#quatery').removeAttr('style:display').hide(); 
            $('.date_interval').removeAttr("style:display").show();
            }else if(radioValue=='month'){
              $('.date_interval,#quatery,#year').removeAttr('style:display').hide(); 
               $('#month').removeAttr("style:display").show();    
            }else if(radioValue=='quatery'){
               $('.date_interval,#month').removeAttr('style:display').hide();       
                  $('#year').removeAttr("style:display").show();
                   $('#quatery').removeAttr("style:display").show();
            }else{
              $('.date_interval,#month,#quatery').removeAttr('style:display').hide(); 
               $('#year').removeAttr("style:display").show();
            }
        }); 

  });
</script> 

  @endsection