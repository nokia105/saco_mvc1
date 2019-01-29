 @extends('loans.template')

       @section('title', '|Shares')
      @section('memberworkspace')
      <input type="hidden" value="{{$id=request()->route('id')}}" name=""> 
     <div class="col-md-12">
          <div class="box col-md-12">
            <div class="box-header">
              <h3 class="box-title">Shares</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="memberShare" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Amount</th>
                   <th>No of Shares</th>
                    <th>Last Date</th>
    
                </tr>
                </thead>
                <tbody>
                 <td><a href="{{route('member_allshare',$member->member_id)}}">{{number_format(($member->no_shares->where('state','in')->sum('amount')-$member->no_shares->where('state','out')->sum('amount')),2)}}</a></td>
                 <td>{{($member->no_shares->where('state','in')->sum('No_shares')-$member->no_shares->where('state','out')->sum('No_shares'))}}</td>
                     @if(count($member->no_shares))
                 <td>{{Carbon\carbon::parse($member->no_shares->last()->share_date)->format('d/m/Y')}}</td>
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

       

  
 


          </script>
       
    @endsection


