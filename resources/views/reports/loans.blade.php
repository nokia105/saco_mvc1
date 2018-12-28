 @extends('layouts.master')

      @section('content')

       @section('title', '| ')
<div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Month</th>
                  <th>No: Loans</th>
                  <th>Total Principle</th>
                  <th>Total Interest</th>
                </tr>
                </thead>
                <tbody>

                 
                 @foreach($loans as $loan)
                  
                <tr>
                   <td>@php $month=date('m',strtotime($loan->monthloan));
               echo DateTime::createFromFormat('!m',$month)->format('F');
         @endphp</td>
                   <td>{{$loan->numberloan}}</td>
                  <td>{{$loan->principle}}</td>
                  <td>{{$loan->interest}}</td>

                   
                   
                </tr>
                 @endforeach
                 
                 




                
                
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