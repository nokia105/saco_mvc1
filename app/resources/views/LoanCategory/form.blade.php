 
     @extends('layouts.master')
      @section('content')

       @section('title', '| Loan Category')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Loan <span>Categories</span></h3>
        </div>
        <div class="box-body">
            <table id="loancategory" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">Category Name</th>
                        <th>Category Code</th>
                        <th>Interest Rate</th>
                        <th>Duration</th>
                        <!-- <th>status</th> -->
                        <th>Repayment Penalty</th>
                        <th>Grace Period</th>
                        <th>Maximum Amount</th>
                        <th>Minimum Amount</th>

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
        
    #example{
        width:100%;
        background-color: #fff;
    }
    th {
        font-size: 12px;
    }
    </style>

      @endsection

      @section('js')

      <script type="text/javascript">
          
          var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('loancat')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#loancategory",
        fields: [ {
                label: "Category Name:",
                name: "category_name"
            }, {
                label: "Interest Rate:",
                name: "interest_rate"
            }, {
                label: "Default Duration:",
                name: "default_duration"
            }, 
            {
                label: "Category Code:",
                name: "category_code"
            },
            {
                label: "Repayment Penalty:",
                name: "repayment_penalty"
            },
            {
                label: "Grace Period:",
                name: "grace_period"
            },
            {
                label: "Minimum Amount:",
                name: "min_amount"
            },
             {
                label: "Maxmum Amount:",
                name: "max_amount"
            }

           /* {
                label: "Status:",
              name: "status"
            } */ 
        ]
    } );
 

    $('#loancategory').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('loancat')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "category_code"},
            { data: "category_name" },   
            { data: "interest_rate" },
            { data: "default_duration" },
            { data: "repayment_penalty" },
            { data: "grace_period" },
             { data: "min_amount" },
             { data: "max_amount" }
        ],
        select: true,
        severSide:true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
} );


      </script>

      @endsection




    
