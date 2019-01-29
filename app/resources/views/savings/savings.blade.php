
     @extends('layouts.master')
               @section('title', '|Savings')

      @section('content')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Savings</h3>
        </div>
        <div class="box-body">
            <table id="savings" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Saving Date</th>
                        <th>Member ID</th>
                        <th>Amount</th>
                        <th>Saving Code</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
 </div>
</div>
    <style type="text/css">
        
    #savings{
        width:100%;
        background-color: #fff;
    }
    th {
        font-size: 12px;
    }
    </style>

      @endsection



    
