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
                 <th>Balance Savings</th>

                  <th>Last Date</th>
                  
                </tr>
                </thead>
                <tbody>
              
                <tr>
              
                  <td><a href="{{route('allsavings',$member->member_id)}}">{{number_format(($member->savingamount->where('state','in')->sum('amount')-$member->savingamount->where('state','out')->sum('amount')),2)}}</a></td>
                     @if(count($member->savingamount))
                   <td>{{\Carbon\carbon::parse($member->savingamount->last()->saving_date)->format('d/m/Y')}}</td>
                      @else
                      <td>0000-00-00</td>
                       @endif
                </tr>
              
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