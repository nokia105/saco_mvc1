@extends('layouts.master')
   @section('content')
      

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
              <h3 class="box-title">Submitted Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loan No:</th>
                  <th>Member</th>
                  <th>Submission Date</th>
                   <th>Principle(Tsh)</th>
                   <th>Interest(Tsh)</th>
  
                   <th>Time(month)</th>
                   <th>Status</th>
                   
                    @role('Accountant|Cashier','member')
                   <th>Action</th>
                   @endrole
                 
                
                </tr>
                </thead>
                <tbody>
                    @foreach($receivedloans as $loan)
                 <tr>
              <td><a href="{{route('loan_info',$loan->id)}}">#{{$code+$loan->id+$loan->member_id}}</a></td>  
                 <td>{{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->last_name)}}</td> 
                <td>{{ \Carbon\Carbon::parse($loan->loanInssue_date)->format('d/m/y') }}</td>
                <td>{{number_format($loan->principle,2)}}</td>
                <td>{{number_format(($loan->mounthlyrepayment_interest)*$loan->duration,2)}}</td>
                <td>{{$loan->duration}}</td>
                <td>{{strtoupper($loan->loan_status)}}</td>
                   @role('Accountant|Cashier','member')
                <td class="center">
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
        <li><a  onclick="showAjaxModal('{{route('agree',$loan->id)}}')" >
        <i class="fa fa-check-circle-o" style="color:green; font-size:15px;"></i>Review</a> </li>

         <li><a  onclick="showAjaxModal('{{route('reject',$loan->id)}}')" >
        <i class="fa fa-ban" style="color:red; font-size:15px;"></i>Deny</a> </li>

         <li><a  onclick="showAjaxModal('{{route('pending',$loan->id)}}')" >
        <i class="fa fa-clock-o" style="color:red; font-size:15px;"></i>Pending </a> </li>
                               
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





       <!--  <script>
       $(document).ready(function(){
       $('#modal_ajax').modal({show: true});
       }
        </script> -->

    <div class="modal fade" id="modal_ajax" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width:500px; text-align: ;">
            <div class="modal-content" ">
                
                <div class="modal-header modal-header-primary" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFF; z-index:1000;">X</button>
                    <h1></h1>
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




     





          

