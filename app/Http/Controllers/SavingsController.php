<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
include(app_path()."/datatable/Editor/php/DataTables.php" );
include(app_path()."/datatable/Editor/php/config.php" );
include(app_path()."/datatable/Editor/php/Bootstrap.php" );

//require( 'ssp.class.php' );
/*
include(app_path()."\datatable\Editor\php\Editor\Editor.php" );
include(app_path()."\datatable\Editor\php\Editor\Field.php" );
include(app_path()."\datatable\Editor\php\Editor\Format.php" );
include(app_path()."\datatable\Editor\php\Editor\Join.php" );
include(app_path()."\datatable\Editor\php\Editor\Mjoin.php" );
include(app_path()."\datatable\Editor\php\Editor\Upload.php" );
include(app_path()."\datatable\Editor\php\Editor\Validate.php" );*/


// Alias Editor classes so they are easy to use
use Auth;
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;
    use App\Membersaving;
    use App\Member;


    
    //DataTables\Database\Database;


class SavingsController extends Controller
{
    //


  
     function __construct(){

       return $this->middleware('auth:member');
     }

   function db()
      {
        include(app_path()."/connection.php" );
        return $db = new \DataTables\Database( $sql_details );

      }




      public function index(){

     $user_id=Auth::guard('member')->user()->member_id;


// Build our Editor instance and process the data coming from _POST
Editor::inst($this->db(),'savings','saving_id')
    ->fields(
        Field::inst( 'savings.saving_date' )->validator( 'Validate::notEmpty' )
            ->validator( 'Validate::dateFormat', array(
                "format"  => Format::DATE_ISO_8601,
                "message" => "Please enter a date in the format yyyy-mm-dd"
            ) )
            ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
            ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),    
        Field::inst( 'savings.amount' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'savings.saving_code' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'savings.member_id' )
           ->options( 'members', 'member_id', 'first_name' ),
                   
        Field::inst( 'members.first_name' ),
        Field::inst( 'members.last_name' )
        )
    ->leftJoin( 'members','members.member_id','=', 'savings.member_id' ) 
    ->process( $_GET )
    ->json();


        
      }



      public function membersavings($id)

      {

           $member=Member::findorfail($id);

           return view('savings.membersavings',compact('member'));
      }

      public function member_allsavings($id){

            $allmembersavings=Member::findorfail($id)->savingamount->where('state','in');

          return view('savings.member_allsavings',compact('allmembersavings'));
      }
}
