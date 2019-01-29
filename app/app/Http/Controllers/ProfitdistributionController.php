<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include(app_path()."\datatable\Editor\php\DataTables.php" );
include(app_path()."\datatable\Editor\php\config.php" );
include(app_path()."\datatable\Editor\php\Bootstrap.php" );
use Auth;
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

class ProfitdistributionController extends Controller
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
  


// Build our Editor instance and process the data coming from _POST
Editor::inst($this->db(),'profitdisributions','id')
    ->fields(
     Field::inst('name' )->validator( 'Validate::notEmpty'),
     Field::inst('member_id')->setValue(Auth::guard('member')->user()->member_id),
     Field::inst('percentage' )->validator( 'Validate::notEmpty')         
 )
    ->process( $_GET )
    ->json();



}

}
