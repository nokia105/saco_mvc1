@extends('member.member_template')
@section('memberinfo')

 @section('title', '|Savings')

  <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Savings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Saving Code</th>
                  <th>Amount (Tsh)</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($member->savingamount as $saving)
                <tr>
              
                  <td >{{$saving->saving_code}}</td>
                  <td><a href="{{route('allsavings',$member->member_id)}}">{{number_format($saving->amount,2) }}</a></td>

                   <td>{{\Carbon\carbon::parse($saving->saving_date)->format('d/m/y')}}</td>
            
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