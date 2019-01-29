CONNECTION
The db connection is on the config.php on Editor/php/config.php

TABLE VIEW
1.The table view file (view.html) have table tag with id='example' on which js uses to display the content

2.The view file contains js scripts for editing and creating data.

PHP SCRIPT
The file (php_script.php) contains
 ->Table name and id(primary key)
         Editor::inst( $db, 'datatables_demo','id')

 ->Field instances declaration 
         Field::inst( 'first_name' )

 ->Field validation declaration(for the field having validation)s
         ->validator( 'Validate::notEmpty' )


