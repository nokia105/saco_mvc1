 @extends('layouts.master')

      @section('content')

      @section('title', '| Shares Reports')
       


       <form action="{{route('find_sharesreport')}}" method="post">

         {{csrf_field()}}
        <div class="box col-md-12 box-danger">
            <div class="box-header">
              <h2 class="box-title">Choose reports types</h2>
            </div>
            <!-- /.box-header -->
         <div class="box-body">
          <div class="row" style="padding-bottom:20px; ">
            <h3>Choose Period</h3>
            <div class="col-md-3">
             <div class="custom-control custom-radio">
  <input type="radio"  name="duration" class="custom-control-input" value="cummulative">
  <label class="custom-control-label" for="customRadio1">Commulatively</label>
</div>
</div>
 <div class="col-md-3">
<div class="custom-control custom-radio">
  <input type="radio"  name="duration" class="custom-control-input" value="month">
  <label class="custom-control-label" for="customRadio2">Monthly</label>
</div>
</div>
 <div class="col-md-3">
<div class="custom-control custom-radio">
  <input type="radio"  name="duration" class="custom-control-input" value="quatery">
  <label class="custom-control-label" for="customRadio2">Quatery</label>
</div>
</div>
 <div class="col-md-3">
<div class="custom-control custom-radio">
  <input type="radio" name="duration" class="custom-control-input" value="annualy">
  <label class="custom-control-label" for="customRadio2">Annually</label>
</div>
</div>
          </div>

          <div class="row">
            <div class="col-md-3" style="padding-top:20px">
              <label>Select Loan Report </label>
              <select class="form-group form-control" name="shares">
                <option>Select report type</option> 
                <option value="total_share">Total share</option> 
                <option value="refunded_share">Refunded shares</option>  
              </select>
            </div>

             <div class="col-md-3" id="year" style="padding-top:20px; display: none;">
              <label>Select Year </label>
              <select class="form-group form-control" name="year">
                <option>Select Year</option>
                 @for($i=0; $i< 17; $i++)
                <option value="{{2012+$i}}">{{2012+$i}}</option> 
                   @endfor
              </select>
            </div>
            <div class="col-md-3" id="month" style="display:none">
     <label>Select Month:</label>
    <div class="row  date form-group" id="dpMonths" data-date-format="mm/yyyy" data-start-view="year" data-min-view="year">
   
  <div class="small-10 columns">
        <span class="prefix"><i class="fa fa-calendar"></i></span>

    <input size="50" type="text"  class="form-control" name="month"  autocomplete="off">  
  </div> 
</div>
          </div>
              <div class="col-md-6 date_interval" style="display:none">

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

             <div class="col-md-3" id="quatery" style="padding-top:20px; display:none">
              <label>Select reports Quatery</label>
              <select class="form-group form-control" name="quatery">
                <option value="">Select quatery</option> 
                <option value="01-03">January---March</option> 
                <option value="04-06">April---June</option> 
                <option value="07-09">July---September</option> 
                <option value="10-12">October---December</option>
              </select>
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

     @include('reports.reportjs')





  