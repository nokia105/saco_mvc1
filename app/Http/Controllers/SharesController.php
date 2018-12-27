<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
include(app_path()."/datatable/Editor/php/DataTables.php" );
include(app_path()."/datatable/Editor/php/config.php" );
include(app_path()."/datatable/Editor/php/Bootstrap.php" );

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
    use Auth;
    use App\Member;
    //DataTables\Database\Database;


class SharesController extends Controller
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
$nn=Editor::inst($this->db(),'shares','share_id')
    ->fields(
        Field::inst( 'share_value' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'min_shares' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'max_shares' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'status' )->setValue('Active'),
        Field::inst( 'user_id' )->setValue($user_id)
        )  
    ->process( $_GET )
    ->json();

      }



      public function membershare($id){
       
          $member=Member::findorfail($id);
        
    
        return view('shares.membershares',compact('member'));

       

      }


      public function member_allshare($id){

         $allmembershares=Member::findorfail($id)->no_shares->where('state','in');

            return view('shares.member_allshare',compact('allmembershares'));
      }
}
