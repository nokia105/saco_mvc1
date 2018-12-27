@extends('layouts.master')
      @section('content')
      
         @section('title', '| Paid Loan')

       <div class="row">
       <div class="col-xs-12">


         <div class="error" style="text-align:center">


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

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Paid Vouchers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                   <th>Principle(Tsh)</th>
                   <th>Interest(Tsh)</th>
                   <th>Charges</th>
                   <th>Insurances</th>
                   <th>Given amount</th>
                   <th>Duration</th>
                   <th>Requesting Date</th>
                   <th>Paid Date</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($paid_loans as $loan)
                 <tr>
                 <td>{{$loan->member->first_name}}  {{$loan->member->last_name}}</td> 
                 <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member_id}}</a></td>     
                <td>{{number_format($loan->principle,2)}}</td>
                <td>{{number_format(($loan->mounthlyrepayment_interest)*$loan->duration,2)}}</td>
                <td>{{number_format($loan->loan_fees->sum('fee_value'),2)}}</td>
                <td>{{number_format(((($loan->insurances->percentage_insurance)/100)*$loan->principle),2)}}</td>
                
                <td>{{number_format(($loan->principle)-($loan->loan_fees->sum('fee_value')+(($loan->insurances->percentage_insurance)/100)*$loan->principle),2)}}</td>
                <td>{{$loan->duration}}</td>
                <td>{{\Carbon\carbon::parse($loan->loanInssue_date)->format('d/m/y')}}</td>
                <td>{{$loan->voucher->paid_date}}</td>

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



 <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary" style="text-align:center;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                
                <div class="modal-body" style="margin:0px;"  >
                
                       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

          
      @endsection
