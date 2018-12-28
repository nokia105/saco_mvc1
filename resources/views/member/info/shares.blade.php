@extends('member.member_template')
@section('memberinfo')

 @section('title', '| Shares')

  <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
             
                  <th>Amount (Tsh)</th>
                  <th>No: Share</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($member->no_shares as $share)
                <tr>
              
                  <td><a href="{{route('allshares',$member->member_id)}}">{{number_format($share->amount,2)}}</a></td>
                  <td>{{$share->No_shares}}</td>
                   <td>{{\Carbon\carbon::parse($share->share_date)->format('d/m/y')}}</td>
            
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