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


class InsurancesController extends Controller
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


   $user_id=Auth::guard('member')->user()->member_id;
  

// Build our Editor instance and process the data coming from _POST
Editor::inst($this->db(),'insurances','id')
    ->fields(
        Field::inst( 'insurance_date' )->validator( 'Validate::notEmpty' )
            ->validator('Validate::dateFormat', array(
                "format"  => Format::DATE_ISO_8601,
                "message" => "Please enter a date in the format yyyy-mm-dd"
            ) )
            ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),    
        Field::inst( 'name' )->validator( 'Validate::notEmpty' ),
      Field::inst( 'user_id' )->setValue($user_id),
     Field::inst( 'percentage_insurance' )->validator( 'Validate::notEmpty' )
 )
    ->process( $_GET )
    ->json();



     }
}
