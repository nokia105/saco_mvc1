@extends('member.member_template')
@section('memberinfo')

 

  <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Collaterals</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
             
                  <th>Name</th>
                  <th>Collateral Type</th>
                  <th>Value</th>
                  <th>Evaluation Date</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($member->collateral as $collateral)
                <tr>
              
                  <td>{{ucfirst($collateral->colateral_name)}}</td>
                  <td>{{ucfirst($collateral->colateral_type)}}</td>
                  <td>{{number_format($collateral->colateral_value,2)}}</td>
                  <td>{{\Carbon\carbon::parse($collateral->colateralevalution_date)->format('d/m/y')}}</td>
            
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