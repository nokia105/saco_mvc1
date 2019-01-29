<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
/*
include(app_path()."\datatable\Editor\php\Editor\Editor.php" );
include(app_path()."\datatable\Editor\php\Editor\Field.php" );
include(app_path()."\datatable\Editor\php\Editor\Format.php" );
include(app_path()."\datatable\Editor\php\Editor\Join.php" );
include(app_path()."\datatable\Editor\php\Editor\Mjoin.php" );
include(app_path()."\datatable\Editor\php\Editor\Upload.php" );
include(app_path()."\datatable\Editor\php\Editor\Validate.php" );*/


// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;
	//DataTables\Database\Database;


class TableController extends Controller
{
    //

  public function table(){
    


// Build our Editor instance and process the data coming from _POST

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
$sql_details = array(
	"type" => "Mysql",  // Database type: "Mysql", "Postgres", "Sqlite" or "Sqlserver"
	"user" => "root",       // Database user name
	"pass" => "",       // Database password
	"host" => "localhost",       // Database host
	"port" => "",       // Database connection port (can be left empty for default)
	"db"   => "datatable"     // Database name
	//"dsn"  => "charset=utf8"        // PHP DSN extra information. Set as `charset=utf8` if you are using MySQL
);
$db = new \DataTables\Database( $sql_details );


// Build our Editor instance and process the data coming from _POST
Editor::inst($db,'datatables_demo','id')
	->fields(
            Field::inst( 'id' )->set(false),
            Field::inst( 'first_name' ),
            Field::inst( 'email' )
        )
        ->on('postCreate',function( $editor, $id, $values, $row ) {
           
            
            $editor->db()
                ->query('update', 'datatables_demo')
                ->set('first_name',$id,false)
                ->where('id', $id)
                ->exec();
            
        }

       )


        ->process( $_POST )
        ->json();

   

  

     
  }

}
