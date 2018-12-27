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



class PenaltyController extends Controller
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


Editor::inst($this->db(),'penalties','id')
    ->fields(      
        Field::inst( 'percentage_penalty' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'retirement_period' )->validator( 'Validate::notEmpty' ) 
        ) 
    ->process( $_GET )
    ->json();


        
      }



}
