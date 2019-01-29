@extends('member.member_template')
  @section('title', '|Loan')
@section('memberinfo')


    <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loan list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="loanlist" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loan Code</th>
                  <th>Category</th>
                  <th>Principle(Tsh)</th>
                  <th>Amount payed(Tsh)</th>
                  <th>Month Payment</th>
        
                  <th>Period</th>
                  <th>Req Date</th>
                  <th>Payment Startdate</th>
                  <!-- <th>End Date</th> -->
                   <th>Status</th>
                <!--   <th>Edit</th> -->
                 
                </tr>
                </thead>
                <tbody>
                   
                @foreach($loanlists as $loanlist )
                <tr>
                  <td><i><a href="{{ URL::to('member/'.$id.'/loan_info/' . $loanlist->id) }}">#{{$code+$loanlist->id+$id}}</a></i></td>
                  <td>{{  $loanlist->loancategory->category_name}}</td>
                  <td>{{  number_format($loanlist->principle,2) }} </td>
                   <td>{{ number_format($loanlist->loanrepayment->sum('amountpayed'),2)}}</td>
                  <td>{{ number_format($loanlist->mounthlyrepayment_amount,2)}}</td>
                  <td>{{  $loanlist->duration }} Months</td>
                  <td >{{ \Carbon\carbon::parse($loanlist->request_date)->format('d/m/Y') }}</td>
                  <td >{{ \Carbon\carbon::parse($loanlist->repayment_date)->format('d/m/Y') }}</td>
                  
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


@endsection
@section('js')
        <script type="text/javascript">
          
        $('#loanlist').DataTable({
      dom: 'Bfrtip',
buttons: [   'print',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
             {extend: 'pdfHtml5',
           }             
    ],

       order: [[ 7, 'desc' ], [ 0, 'asc' ]]
 
    });
        </script>
      @endsection