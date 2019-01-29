@extends('layouts.master')
   @section('content')
      
       <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Aging Loans</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Name</th>
                   <th>Loan #</th>
                   <th>Principle(Tsh)</th>
                   <th>Debt Amount</th>
                   <th>Start Date</th>
                   <th>Aging Days</th>          
                </tr>
                </thead>
                <tbody>
                    @foreach($loanschedules as $schedule)

                      @php
                              $formatted_dt=\Carbon\carbon::parse($schedule->duedate);
                               $daysdiffer=$formatted_dt->diffInDays(\Carbon\carbon::now());
                      @endphp
                 <tr>
                   <td>{{ucfirst($schedule->loan->member->first_name)}} {{ucfirst($schedule->loan->member->middle_name)}} {{ucfirst($schedule->loan->member->last_name)}}</td>
                    <td><a href="{{route('loan_info',$schedule->loan->id)}}">#{{$code+$schedule->loan->id+$schedule->loan->member_id}}</a></td> 
                    <td>{{number_format($schedule->loan->principle,2)}}</td>

                                @if($schedule->status=='incomplite')
                    <td>{{number_format(($schedule->monthprinciple+$schedule->monthinterest)-($schedule->monthrepayment->sum('amoutpayed')),2)}}</td>
                               @else
                          <td>{{number_format($schedule->sum('monthprinciple')+$schedule->sum('monthinterest'),2)}}</td>
                           @endif
                           <td>{{\Carbon\carbon::parse($schedule->duedate)->format('d/m/y')}}</td>     
                               @if($daysdiffer<=30)
                             <td><span class="label label-sm label-warning">{{$daysdiffer}}</span></td>
                              @elseif($daysdiffer >30 && $daysdiffer<=60)
                              <td><span class="label label-sm label-danger">{{$daysdiffer}}</span></td>
                                 @elseif($daysdiffer >60 && $daysdiffer<=90)
                              <td><span class="label label-sm label-danger"><{{$daysdiffer}}</span></td>
                               @else
                                 <td><span class="label label-sm label-danger">{{$daysdiffer}}</span></td>
                               @endif
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




     





          

