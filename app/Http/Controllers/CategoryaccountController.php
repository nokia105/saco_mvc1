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

class CategoryaccountController extends Controller
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

         $mm=Editor::inst($this->db(),'categoryaccounts','id')
    ->fields(
        Field::inst('code')->validator( 'Validate::notEmpty' ),
        Field::inst('name')->validator( 'Validate::notEmpty' )
    )   
    ->process( $_GET )
    ->json();
    
    }


     public function accountstypes(){

     Editor::inst($this->db(),'categoryaccountstypes','id')
    ->fields(
        Field::inst('categoryaccountstypes.code')->validator('Validate::notEmpty' ),
        Field::inst('categoryaccountstypes.name')->validator('Validate::notEmpty' ),
        Field::inst('categoryaccountstypes.categoryaccount_id')
        ->options( 'categoryaccounts', 'id','name'),             
        Field::inst( 'categoryaccounts.name' )
    )   
     ->leftJoin('categoryaccounts','categoryaccounts.id','=', 'categoryaccountstypes.categoryaccount_id' ) 
    ->process( $_GET )
    ->json();
    }
}
