 @extends('layouts.master')

      @section('content')

        @section('title', '| Time Range')
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


       <form action="{{route('shares_reports_time')}}" method="post">

         {{csrf_field()}}
        <div class="box col-md-8 box-danger">
            <div class="box-header">
              <h3 class="box-title">Shares In Time Range</h3>
              <br/><br/>
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
        <div class="input-group{{ $errors->has('startDate') ? ' has-error' : '' }} ">
          <span class="input-group-addon" id="dp4" data-date-format="yyyy-mm-dd" ><i class="glyphicon glyphicon-calendar"></i></span>
        <input  class="form-control" type="text"  id="startDate" name="startDate" autocomplete="off" value="{{old('startDate')}}">
         <small class="text-danger">{{ $errors->first('startDate') }}</small>
      </div>  
      </td>
     
      <td><div class="input-group{{ $errors->has('endDate') ? ' has-error' : '' }} ">
          <span class="input-group-addon" id="dp5" data-date-format="yyyy-mm-dd" ><i class="glyphicon glyphicon-calendar"></i></span>
        <input  class="form-control" type="text"  value=""  id="endDate" name="endDate" autocomplete="off">
        <small class="text-danger">{{ $errors->first('endDate') }}</small>
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
                  <input type="submit"  value="Find"  class="form-control btn btn-info pull-left" >
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
  var startDate = new Date();
  var endDate = new Date();
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