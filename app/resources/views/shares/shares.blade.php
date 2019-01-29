
 
     @extends('layouts.master')
          @section('title', '|Shares')
      @section('content')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Shares</h3>
        </div>
        <div class="box-body">
            <table id="shares" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Share Value</th>
                        <th>Minimum Shares</th>
                        <th>Maximum Shares</th>
                        <th>Status</th>
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
        
    #shares{
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
        url     : "{{route('shareCreate')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#shares",
        fields: [ {
                label: "Share Value:",
                name: "share_value"
            }, {
                label: "Minimum Shares:",
                name: "min_shares"
            }, {
                label: "Maximum Shares:",
                name: "max_shares"
            }             
           /* {
                label: "Status:",
              name: "status"
            } */ 
        ]
    } );
 

    $('#shares').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('shareCreate')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
            { data: "share_value"},
            { data: "min_shares" },   
            { data: "max_shares" },
             { data: "status" }
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



    
