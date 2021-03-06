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
                  <th>Loan Code</th>
                  <th>Voucher No</th>
                   <th>Principle(Tsh)</th>
                   <th>Interest(Tsh)</th>
                   <th>Charges</th>
                   <th>Insurances</th>
                   <th>Given amount</th>
                   <th>Duration</th>
                   <th>Paid Date</th>
                   <th>Receipt</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($paid_vouchers as $voucher)
                 <tr>
                 <td>{{$voucher->loan->member->first_name}}  {{$voucher->loan->member->last_name}}</td> 
                 <td><a href="{{route('loan_info',$voucher->loan->id)}}">#{{$code+$voucher->loan_id+$voucher->loan->member_id}}</a></td>
                 <td>{{$voucher->voucher_no}}</td>     
                <td>{{number_format($voucher->loan->principle,2)}}</td>
                <td>{{number_format(($voucher->loan->mounthlyrepayment_interest)*$voucher->loan->duration,2)}}</td>
                <td>{{number_format($voucher->loan->loan_fees->sum('fee_value'),2)}}</td>
                <td>{{number_format(((($voucher->loan->insurances->percentage_insurance)/100)*$voucher->loan->principle),2)}}</td>
                <td>{{number_format(($voucher->loan->principle)-($voucher->loan->loan_fees->sum('fee_value')+(($voucher->loan->insurances->percentage_insurance)/100)*$voucher->loan->principle),2)}}</td>
                <td>{{$voucher->loan->duration}}</td>
                
                 @if($voucher->loan->voucher()->exists())
                <td>{{\Carbon\carbon::parse($voucher->paid_date)->format('d/m/Y')}}</td>
                @else
                <td></td>
                @endif
                <td><a href="{{ URL::to('receipt/' . $voucher->loan->id) }}"><button><i class="fa fa-print"></i></button></td>

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
