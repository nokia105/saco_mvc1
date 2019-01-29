
 
     @extends('layouts.master')

      @section('content')

       @section('title', '| Penalties')
      
<div class="row">
    <div class=" center col-xs-8 "  style="margin:0 auto;">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Penalty<span></span></h3>
        </div>
        <div class="box-body">
            <table id="penalty" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:20%;">% penalty</th>
                         <th>Retirement Period</th>
                       
                       

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


     div.DTE_Field_Type_radio.DTE_Field_Name_{myFieldName} div.DTE_Field_InputControl > div > div {
  float: left;
  width: 100%; 
  /* change as needed */
}
    </style>

      @endsection

      @section('js')

       <script type="text/javascript">
           
                 var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('penalty')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#penalty",
        fields: [ {
                label: "Percentage Interest:",
                name: "percentage_penalty"
               
            }, {
                label: "Retirement Period",
                name: "retirement_period"
            }, 
                        
           
        ]
    } );
 

    $('#penalty').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('penalty')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [
             
             { data: "percentage_penalty" },
             { data: "retirement_period" }
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



    
