<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <title>Editor example - Multi-row editing</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="Editor/css/editor.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="Editor/examples/resources/syntax/shCore.css">
    <link rel="stylesheet" type="text/css" href="Editor/examples/resources/demo.css">
    <style type="text/css" class="init">
    
    </style>
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="Editor/js/dataTables.editor.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="Editor/examples/resources/syntax/shCore.js">
    </script>
    <script type="text/javascript" language="javascript" src="Editor/examples/resources/demo.js">
    </script>
    <script type="text/javascript" language="javascript" src="Editor/examples/resources/editor-demo.js">
    </script>
    <script type="text/javascript" language="javascript" class="init">
    


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/table",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },
 
        table: "#example",
        fields: [ {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Last name:",
                name: "last_name"
            }, {
                label: "Position:",
                name: "position"
            }, 
            {
                label: "Office:",
                name: "office"
            }, 
            {
                label: "Email:",
                name: "email"
            }, {
                label: "Extension:",
                name: "extn"
            }, {
                label: "Start date:",
                name: "start_date",
                type: "datetime"
            }, {
                label: "Salary:",
                name: "salary"
            }
        ]
    } );
 

    $('#example').DataTable( {
        dom: "Bfrtip",
        ajax : {
        url:   "/table", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        },   
        
        columns: [
            { data: "first_name" },
            { data: "last_name" },
            { data: "position" },
            { data: "office" },
            { data: "email" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
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
</head>
<body class="dt-example">
    <div class="container">
        <section>
            <h1>Editor example <span>Multi-row editing</span></h1>
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Email</th>
                        <th>Extn.</th>
                        <th>Start date</th>
                        <th>Salary</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                         <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Email</th>
                        <th>Extn.</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
            </table>


        </section>
    </div>
    
</body>
</html>