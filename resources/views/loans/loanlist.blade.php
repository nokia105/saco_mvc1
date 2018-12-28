
     @extends('loans.template')
      @section('memberworkspace')
         @section('title', '| Loan List')
      <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loan Code</th>
                  <th>Category</th>
                  <th>Principle(Tsh)</th>
                  <th>Amount payed(Tsh)</th>
                  <th>Month Payment</th>
        
                  <th>Period</th>
                 
                  <th>Payment Startdate</th>
                  <th>End Date</th>
                   <th>Status</th>
                <!--   <th>Edit</th> -->
                 
                </tr>
                </thead>
                <tbody>
                    <div class="col-md-6 col-md-offset-3">
         <a  href="{{route('finished_loans',$id)}}"><button class="btn btn-success col-xs-3  " style="margin-right: 5px;">FINISHED</button></a>
          <a  href="{{route('ongoing_loans',$id)}}"><button class="btn btn-warning col-xs-3" style="margin-right: 5px;">PAID</button></a>
          <a ><button class="btn btn-default col-xs-3" style="margin-right: 5px;"><i style="color:red" class="fa fa-print" aria-hidden="true"></i> Print</button></a>
    </div>
                @foreach($loanlists as $loanlist )
                <tr>
                  <td><i><a href="{{ URL::to('profile/'.$id.'/schedule/' . $loanlist->id) }}">#{{$code+$loanlist->id+$id}}</a></i></td>
                  <td>{{  $loanlist->loancategory->category_name}}</td>
                  <td>{{  number_format($loanlist->principle,2) }} </td>
                   <td>{{ number_format($loanlist->loanrepayment->sum('amountpayed'),2)}}</td>
                  <td>{{ number_format($loanlist->mounthlyrepayment_amount,2)}}</td>
                  <td>{{  $loanlist->duration }} Months</td>
                  <td >{{ \Carbon\carbon::parse($loanlist->repayment_date)->format('d/m/Y') }}</td>
                  <td>{{$loanlist->loanschedule->duedate->last()->duedate}}
                  </td>
                   @if($loanlist->loan_status=='paid')
                         <td><span class="label label-sm label-warning">{{strtoupper($loanlist->loan_status)}}</span></td>
                          @else
                           <td><span class="label label-sm label-success">{{strtoupper($loanlist->loan_status)}}</span></td>
                          @endif 
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
      <!-- /.row -->
      @endsection