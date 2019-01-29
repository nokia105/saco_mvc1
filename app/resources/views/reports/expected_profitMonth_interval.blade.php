 @extends('layouts.master')

      @section('content')
        
           @section('title', '| Month Interest')

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

       <form action="{{url('/reports/retrive_expected_profit')}}" method="post">

         {{csrf_field()}}
        <div class="box col-md-8 box-danger">
            <div class="box-header">
              <h3 class="box-title">Loan</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row">
            <div class="col-md-6">

            <table class="table">
  <thead>
    <tr>
      <th>Start date&nbsp;
        
      </th>
      <th>End date&nbsp;
       
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td >
        <div class="input-group ">
          <span class="input-group-addon" id="dp4" data-date-format="yyyy-mm-dd" data-date="2018-01-02"><i class="glyphicon glyphicon-calendar"></i></span>
        <input  class="form-control" type="text"  value=""  id="startDate" name="startDate" autocomplete="off">
      </div>  
      </td>
     
      <td><div class="input-group ">
          <span class="input-group-addon" id="dp5" data-date-format="yyyy-mm-dd" data-date="2018-01-02"><i class="glyphicon glyphicon-calendar"></i></span>
        <input  class="form-control" type="text"  value=""  id="endDate" name="endDate" autocomplete="off">
      </div>
    </tr>
  </tbody>
</table>

            </div>

            </div>
          </div>


         <div class="col-md-2">
              
              <div class="form-group">
                  <label for=""></label>
                  <input type="submit"  value="Find"  class="form-control btn btn-info pull-left">
              </div>
            </div>
      </div>
        </div>





    </form>


      @endsection

      @section('js')

      <script>
$(function(){
  // implementation of custom elements instead of inputs
  var startDate = new Date(2018, 1, 1);
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
</script>

      @endsection