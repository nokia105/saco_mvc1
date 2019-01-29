
 
     @extends('layouts.master')
      @section('content')

      @section('title', '| Medhods')
<div class="row">
    <div  class=" center col-xs-8" style="margin:0 auto">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title">Fee <span>List</span></h3>
        </div>
        <div class="box-body">
            <table id="interest_method" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      
                        <th style="width:20%;">Interest method Name</th>
                         
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
        url     : "{{route('interestmethods')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#interest_method",
        fields: [ {
                label: "Interest method Name:",
                name: "method",
               
            }             
        ]
    } );
 

    $('#interest_method').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('interestmethods')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [


             { data: "method" },
              
             
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

  

    
