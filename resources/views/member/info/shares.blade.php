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
                  <th>Last Date</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
              
                  <td><a href="{{route('allshares',$member->member_id)}}">{{number_format(($member->no_shares->where('state','in')->sum('amount')-$member->no_shares->where('state','out')->sum('amount')),2)}}</a></td>
                 <td>{{($member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares'))}}</td>
                     @if(count($member->no_shares))
                 <td>{{Carbon\carbon::parse($member->no_shares->last()->share_date)->format('d/m/y')}}</td>
                      @else  
                      <td>0000-00-00</td>
                      @endif
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