<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

class GlaccountController extends Controller
{
    //

    function __construct(){

       return $this->middleware('auth:member');
     }


    function db()
      {
        include(app_path()."\connection.php" );
        return $db = new \DataTables\Database( $sql_details );

      }

    public function index(){

     Editor::inst($this->db(),'glaccounts','id')
    ->fields(
        Field::inst('glaccounts.code')->validator('Validate::notEmpty' ),
        Field::inst('glaccounts.name')->validator('Validate::notEmpty' ),
        Field::inst('glaccounts.categoryaccount_id')
        ->options( 'categoryaccounts', 'id','name'),             
        Field::inst( 'categoryaccounts.name' )
    )   
     ->leftJoin('categoryaccounts','categoryaccounts.id','=', 'glaccounts.categoryaccount_id' ) 
    ->process( $_GET )
    ->json();
    }
}
