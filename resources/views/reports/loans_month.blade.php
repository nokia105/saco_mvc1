 @extends('layouts.master')

      @section('content')

      @section('title', '| Month Loan')
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

       <form action="{{route('dataloans_month')}}" method="post">

         {{csrf_field()}}
        <div class="box col-md-8 box-danger">
            <div class="box-header">
              <h3 class="box-title">Loans Per Month</h3>
            </div>
            <!-- /.box-header -->
         <div class="box-body">

          <div class="row">
            <div class="col-md-3">
     <label>Select Month:</label>
    <div class="row  date form-group" id="dpMonths" data-date-format="mm/yyyy" data-start-view="year" data-min-view="year">
   
 
  <div class="small-10 columns">
        <span class="prefix"><i class="fa fa-calendar"></i></span>

    <input size="50" type="text"  class="form-control" name="month"  autocomplete="off">  
  
  </div>
  
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


    </form>


      @endsection

      @section('js')
            
      <script>
$(function(){
  $('#dpMonths,#form').fdatepicker();
});
</script>
      @endsection