@extends('layouts.master')
      @section('content')
      

         @section('title', '| Approved Loan')
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
              <h3 class="box-title">Approved Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Code</th>
                   
                   <th>Principle(Tsh)</th>
                   <th>Interest(Tsh)</th>
                   <th>Duration</th>
                    <th>Status</th>
                   <th>Requesting Date</th>            
                   <th>Approved Date</th>
                   <th>startdate</th>      
                    @role('Accountant','member')
                   <th>Voucher</th>
                    @endrole
                 
                
                </tr>
                </thead>
                <tbody>
                    @foreach($approved_loans as $loan)
                 <tr>
                 <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member_id}}</a></td>    
                <td>{{number_format($loan->principle,2)}}</td>
                <td>{{number_format(($loan->mounthlyrepayment_interest)*$loan->duration,2)}}</td>
                <td>{{number_format($loan->duration,2)}}</td>
                <td>{{strtoupper($loan->loan_status)}}</td>
                <td>{{$loan->loanInssue_date}}</td>
                 <td>{{\Carbon\Carbon::parse($loan->chair_date)->format('d/m/y')}}</td>
                 <td>{{\Carbon\Carbon::parse($loan->chair_date)->format('d/m/y')}}</td>
                            
         @role('Accountant','member')
        <td class="center">
             
              <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('voucher',$loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>generate</a> </li>
                               
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
                
                       <h4><h4>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
          

      @endsection

         @include('modal.popup_lib')

       
       @section('js')






          

