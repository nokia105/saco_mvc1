@extends('layouts.outreceipttemplate')
    
      @section('receiptcontent')
 
          @foreach($loans as $loan)
        <div id="div" class="box col-md-12 box-primary ">

            <div class="container">
              <div class="row">
              <div class="col-md-6">
                
              <h4 style="color:blue">LOANEE DETAILS</h4>
              <label>Full Name:   </label>
               <h5>{{ucfirst($loan->member->first_name)}} {{ucfirst($loan->member->middle_name)}} {{ucfirst($loan->member->last_name)}}</h5>
               <label>Gender:  </label>
               <h5>{{$loan->member->gender}}</h5>
               <label>Reg #:  </label>
               <h5>{{$loan->member->registration_no}}</h5>
               <label>Joining Date:</label>
               <h5>{{$loan->member->joining_date}}</h5>
               <label>Status:  </label>
               <h5>{{$loan->member->status}}</h5>
            </div>
                 <div class="col-md-6 ">
                   <h4 style="color:blue">LOAN DETAILS</h4>
                    <label>Reqested Date</label>
                    <h5>{{$loan->loanInssue_date}}</h5>
                    <label>Collateral(s)</label>
                       @if(count($loan->collaterals))
                    @foreach($loan->collaterals as $collateral)
                    <h5>Name: <strong>{{$collateral->colateral_name}} </strong></h5>
                    <h5> Value: <strong>{{number_format($collateral->colateral_value,2)}}</strong></h5>
                    @endforeach
                    @else
                     <h5>NONE</h5>
                     @endif
                    <label>Amount(Tsh)</label>
                    <h5>{{number_format($loan->principle,2)}}</h5>
                     <label>Interest(Tsh)</label>
                    <h5>{{number_format($loan->mounthlyrepayment_interest,2)}}</h5>
                    <label>Duration</label>
                    <h5>{{$loan->duration}} Month(s)</h5>
                       
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <h4 style="color:blue">SHARES AND SAVINGS</h4>
                   <label> Total Shares(Tshs)</label>
                    <h5>{{ number_format($loan->member->no_shares->sum('amount'),2)}}</h5>
                    <label>Current Share contribution (Tshs)</label>
                    <h5>{{number_format($loan->member->monthshare,2)}}</h5> 

                    <label> Total Savings(Tshs)</label>
                    <h5>{{number_format($loan->member->savingamount->sum('amount'),2)}}</h5>
                    <label>Current Saving contribution (Tshs)</label>
                    <h5>{{number_format($loan->member->monthsaving,2)}}</h5>      
                </div>

                  <div class="col-md-6 ">
                  <h4 style="color:blue">MEMBER COLLATERAL(S)</h4>
                    @if(count($loan->member->collateral))
                    @foreach($loan->member->collateral as $collateral)
                  <label>Collateral Name: {{$collateral->colateral_name}}</label>
                  <h5>Collatreal Value: {{number_format($collateral->colateral_value,2)}}</h5>
                   @endforeach
                   @else
                   <label>NONE</label>
                   @endif
                            
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <h4 style="color:blue">PREVIOUS LOAN STATUS</h4>
                   <label>Penalty:</label>
                   <h5>NONE</h5>
                </div>
                <div class="col-md-6">
                  <h4 style="color:blue">COMMENTS</h4>
                  <label>Accountant Comment</label>
                 <h5>{{$loan->board_reason}}</h5>
                 <label>Officer Comment</label>
                 <h5>{{$loan->firstprocessed_reason}}</h5>  
                </div>
                
              </div>
            </div>      
              </div> 
              @endforeach 
      @endsection

     