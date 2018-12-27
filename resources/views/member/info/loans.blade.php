@extends('member.member_template')
@section('memberinfo')

 @section('title', '|Loan')

   <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loan Code</th>
                  <th>Category</th>
                  <th>Principle</th>
                  <th>Amout payed</th>
                  <th>Pay per month</th>
                 
             
                  <th>Loan Period</th>

                  <th>Payment Startdate</th>
                  <th>End Date</th>
                 
                 
                </tr>
                </thead>
                <tbody>
                @foreach($memberloans as $loanlist)
                <tr>
                  <td><i><a href="{{ URL::to('member/'.$id.'/loan_info/' . $loanlist->id) }}">#{{$code+$loanlist->id+$id}}</a></i></td>
                  <td>{{$loanlist->loancategory->category_name}}</td>
                  <td>{{$loanlist->principle }} Tsh</td>
                   <td>{{$loanlist->loanrepayment->sum('amountpayed')}}</td>
    
                  <td>{{$loanlist->mounthlyrepayment_amount}} Tsh</td>

                  <td>{{  $loanlist->duration }} months</td>
                  <td>{{  $loanlist->repayment_date }}</td>
                  <td>@php 
                    echo $effectiveDate = date('Y-m-d', strtotime($loanlist->duration.' month', strtotime($loanlist->repayment_date)));
                @endphp
                  </td>    
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