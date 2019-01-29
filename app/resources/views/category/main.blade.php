 @extends('layouts.master')
      @section('content')
<div class="row">
    <div class=" col-md-9 center">
     <div class="box">
          <div class="box-header">
            <h3 class="box-title"><stong>Main Accounts</span></stong></h3>
        </div>
        <div class=" center-1 box-body">
            <table id="mainaccounts" class="table display  table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>

                        <th>Code No:</th>
                        <th style="width:50%;">Account Name</th>
                        <th>Category Type</th>
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
        
   
    th {
        font-size: 12px;
    }

    .center{

        margin:0 auto;
        padding-left:80px;
    }

  .box-body{
    text-align: center;
  }
    
    </style>

      @endsection


       @section('js')


         <script type="text/javascript">
             var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "{{route('mainaccounts')}}",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#mainaccounts",
        fields: [  {
                label: "Code Number",
                name: "mainaccounts.account_no",
                
            },

            {
                label: "Account Name:",
                name: "mainaccounts.name",
                
            },

            {
                label: "Category name:",
                name: "mainaccounts.categoryaccountstype_id",
                type:"select",
               
                placeholder:"Select Category name"
               
            }
                         
        ]
    } );
 

    $('#mainaccounts').DataTable( {
        dom: "Bfrtip",

        ajax : {
        url:   "{{route('mainaccounts')}}", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 

        
        columns: [


             { data: "mainaccounts.account_no" },
             { data: "mainaccounts.name" },
             { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                name=data.categoryaccountstypes.name;
                return name
                 }
            }, 
             
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
