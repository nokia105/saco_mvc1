      @extends('layouts.master')

      @section('content')
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
                  <th>Saving Date</th>
                  <th>Member ID</th>
                  <th>Amount</th>
                  <th>Saving Code</th>                  
                </tr>
                </thead>
                <tbody>
                
                @foreach($savings as $saving)

                    <tr>
                  <td>{{$saving->saving_date}}</td>
                  <td>{{$saving->member_id}}</td>
                  <td>{{$saving->amount}}</td>
                  <td>{{$saving->saving_code}}</td>

                 
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