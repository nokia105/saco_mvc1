 @extends('layouts.master')
       @section('title', '| Loan Time Range')
      @section('content')
       

      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
           <div class="box-header">
              
                       
                 <h3 class="box-title">From:  <strong>{{\Carbon\carbon::parse($startDate)->format('d/m/Y')}}</strong> <br> <br>To : <strong>{{\Carbon\carbon::parse($endDate)->format('d/m/Y')}}</strong></h3>         
            </div>
            <!-- /.box-header -->
                                  <div class="col-md-6 col-md-offset-5">
                                          <h3 class="box-title">Loan Report</h3>
                                     </div>

                                <div class="col-md-6 col-md-offset-3">
          <a ><button class="btn btn-default col-xs-3 print" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
           <a  href="{{ url()->previous() }}"><button class="btn btn-info col-xs-2 pull-right"><i style="color:red; font-size:15px" class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button></a>
    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>Loan Code</th>
                  <th>Principle</th>
                  <th>Interest</th>
                  <th>Fee</th>
                   <th>Request Date</th>
                 
                   <th>Status</th>
                </tr>
                </thead>
                <tbody>
                   @foreach($loans as $loan)
                <tr>
                  <td>{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</td>
                  <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member->member_id}}</a></td>
                  <td>{{number_format($loan->mounthlyrepayment_principle*$loan->duration,2)}}</td>
                   <td>{{number_format($loan->mounthlyrepayment_interest*$loan->duration,2)}}</td>
                  <td>{{number_format($loan->loan_fees->sum('fee_value'),2)}}</td>
                   <td>{{\Carbon\carbon::parse($loan->loanInssue_date)->format('d/m/Y')}}</td>
                
                  <td>{{strtoupper($loan->loan_status)}}</td>
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