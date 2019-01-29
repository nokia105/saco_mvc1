 @extends('loans.template')

     @section('title', '|Savings')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Savings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="memberSaving" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Balance Savings</th>
                  <th>Last Date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><a href="{{route('member_allsavings',$member->member_id)}}">{{number_format(($member->savingamount->where('state','in')->sum('amount')-$member->savingamount->where('state','out')->sum('amount')),2)}}</a></td>
                    @if(count($member->savingamount))
                  <td>{{\Carbon\carbon::parse($member->savingamount->last()->saving_date)->format('d/m/Y')}}</td>
                  @else
                  <td>000-00-00</td>
                  @endif
                </tr>
                </tbody>

                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       
    @endsection