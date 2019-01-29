@extends('layouts.master')
      @section('content')
      
        @section('title', '|Pending Voucher')

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
              <h3 class="box-title">Pending Vouchers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>L.Code</th>
                  <th>Voucher #</th>
                  <th>Amount(Tsh)</th>
                  <th>Payment Mode</th>
                  <th>Status</th>
                  <th>generated Date</th>
                   @role('Chair|Vice Chair','member')
                   <th>Action</th>
                   @endrole
                </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                 <tr>
                 <td>{{ucfirst($voucher->loan->member->first_name)}} {{ucfirst($voucher->loan->member->last_name)}}</td> 
                 <td><a href="{{route('loan_info',$voucher->loan->id)}}">#{{$code+$voucher->loan->id+$voucher->loan->member_id}}</a></td>     
                <td>{{$voucher->voucher_no}}</td>
                <td>{{number_format($voucher->amount,2)}}</td>
                <td>{{strtoupper($voucher->mode_payment)}}</td>
                <td>{{strtoupper($voucher->status)}}</td>
                <td>{{\Carbon\Carbon::parse($voucher->date)->format('d/m/y')}}</td>
               


             @role('Chair|Vice Chair','member')
                        <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('approve_voucher',$voucher->loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>approve</a> </li>
                               
         </ul>
         </div>
  </td>
@endrole
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

                     @include('modal.popup_lib')


      @endsection

 

