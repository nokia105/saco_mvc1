@extends('layouts.master')

      @section('content')
        
           @section('title', '|duration Payments')

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

       <form action="{{route('payments_list')}}" method="post">

         {{csrf_field()}}
        <div class="box col-md-8 box-danger">
            <div class="box-header">
              <h3 class="box-title">Payments</h3>
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
        <input   type="text"   class="datepicker form-control"  id="startDate" name="startDate" autocomplete="off">
      </div>  
      </td>
     
      <td><div class="input-group ">
          <span class="input-group-addon" id="dp5" data-date-format="yyyy-mm-dd" data-date="2018-01-02"><i class="glyphicon glyphicon-calendar"></i></span>
        <input   type="text"  class="datepicker form-control "   id="endDate" name="endDate" autocomplete="off">
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

      @endsection

  
         
   
     

       


     
 

