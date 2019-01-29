 @extends('layouts.master')

      @section('content')

       @section('title', '| Loan Reports')
<div class="row">
<div class="row">
       <div class="col-xs-10">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Report name</th>
                  <th>Type</th>
                  <th>Category</th>
                  
                 
                </tr>
                </thead>
                <tbody>
                
                <tr>
                 
                   <td><a href="{{route('loans_time_range')}}">Loan time range</a></td>
                   <td>Table</td>
                   <td>Loan</td>
                  
                  
                </tr>


                <tr>
                   <td><a href="{{route('loans_month')}}">Loan  in month</a></td>
                   <td>Table</td>
                   <td>Loan</td>
                   <td></td>
                  
                </tr>

                <tr>
                   <td><a href="{{route('expected_profit')}}">Profit expected in time range</a></td>
                   <td>Table</td>
                   <td>Loan</td>
                   <td></td>
                  
                </tr>



                
                
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      @endsection