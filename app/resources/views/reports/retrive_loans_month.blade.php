 @extends('layouts.master')

      @section('content')

   @section('title', '| Month Loan')
      <div class="row">
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Month Report</h3>
                         <br>
                         <br>
                         <h3 class="box-title"> Month : {{\DateTime::createFromFormat('!m',$month)->format('F')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="loan_month" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Members</th>
                  <th>Loan Code</th>
                  <th>Total </th>
                  <th>Principle Due</th>
                   <th>Interest Due</th>
                   <th>Penalty</th>
                   <th>Due date</th>
                </tr>
                </thead>
                <tbody>

                    @php
                    
                    $sumtotal=0;
                     $sumprinciple=0;
                     $suminterest=0;
                     $sumpenalty=0
                      @endphp
                  @foreach($loanschedule as $loanschedule) 
                         @php
                      $sumtotal=$loanschedule->monthprinciple+$loanschedule->monthinterest+$sumtotal;
                      $sumprinciple=$loanschedule->monthprinciple+$sumprinciple;
                      $suminterest=$loanschedule->monthinterest+$suminterest;
                      $sumpenalty=\App\Monthpenaty::where('loanschedule_id','=',$loanschedule->id)->sum('amount_paid')+$sumpenalty;
                        @endphp
                <tr>
                	      
                 <td>{{$loanschedule->loan->member->first_name}} {{$loanschedule->loan->member->middle_name}} {{$loanschedule->loan->member->last_name}}</td>
                 <td>#{{$code+$loanschedule->loan->id+$loanschedule->loan->member->member_id}}</td>
                  <td>{{$loanschedule->monthprinciple+$loanschedule->monthinterest}}</td>
                 <td>{{$loanschedule->monthprinciple}}</td>
                  <td>{{$loanschedule->monthinterest}}</td>
                 <td>{{$sumpenalty}}</td>
                  <td>{{$loanschedule->duedate}}</td>
                   
                </tr>
                 @endforeach

                  <tr style="background-color:#e8eefc; font-size:20px; font-weight:bold; color:#000;">
                  
                  	 <td colspan="2" style="text-align:center">SUM</td>

                  	<td>{{$sumtotal}}</td>
                  	<td>{{$sumprinciple}}</td>
                  	<td>{{$suminterest}}</td>
                  	<td>{{$sumpenalty}}</td>
                    <td></td>

                  	

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

       @section('js')
          

        
      <script type="text/javascript">
        

          

   $(function () {
   
    $('#loan_month').DataTable({

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,

        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  });
            

      </script>


     @endsection