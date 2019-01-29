
 
     @extends('layouts.master')
      @section('content')

        @section('title', '| Fee')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Fee <span>List</span></h3>
        </div>
        <div class="box-body">
            <table id="loan_fee" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">Category Name</th>
                        <th>Fee Code</th>
                        <th>Fee Name</th>
                        <th>Fee Value(%)</th>
                        

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
            

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('fee_category')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#loan_fee",
        fields: [ {
                label: "Fee Name:",
                name: "fee_name"
            }, {
                label: "Fee Code:",
                name: "fee_code"
            }, {
                label: "Fee value:",
                name: "fee_value"
            }
           
        ]
    } );
 

    $('#loan_fee').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('fee_category')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "fee_name"},
            { data: "fee_code" },   
            { data: "fee_code" },
            { data: "fee_value" }
        
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



    
