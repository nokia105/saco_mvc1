@extends('layouts.master')
      @section('content')
      
@section('title', '| Payment List')

       <div class="row">
       <div class="col-xs-12">


         <div class="error" style="text-align:center">


            @if (session('error'))

          
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>

    
                @endif
            
            @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                  <th>Amount</th>
                  <th>Narration</th>
                   <th>State</th>
                   <th>Date</th>

                 
                
                </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                 <tr>
              
                <td>{{number_format($payment->amount,2)}}</td>
                <td>{{ucfirst($payment->narration)}}</td>
                <td>{{strtoupper($payment->state)}}</td>
                <td>{{\Carbon\carbon::parse($payment->date)->format('d/m/y')}}</td>

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






          

