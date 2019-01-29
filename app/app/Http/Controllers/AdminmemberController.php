<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;


class AdminmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


function __construct(){

       return $this->middleware('auth:member');
     }

    public function index()
    {
        //
          $members=Member::all();   

          return view('Adminmember.index',compact('members'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

          $roles = Role::get();
        return view('Adminmember.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


         $this->validate(request(),[
          'first_name'=>'required',
           'middle_name'=>'required',
            'last_name'=>'required',
             'email'=>'required|email',
             'registration_no'=>'required'
         ]);

               //dd($request->registration_no);

             $member=Member::create([
              'first_name'=>$request->first_name,
               'middle_name'=>$request->middle_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'registration_no'=>$request->registration_no,
                'password'=>bcrypt('password')

             ]);



              $roles = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $member->assignRole($role_r); //Assigning role to member
            }
        }        
    //Redirect to the users.index view and display message
        return redirect()->route('Admin_member.index')
            ->with('flash_message',
             'User successfully added.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

           return redirect('Admin_member');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

           $member =Member::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('Adminmember.edit', compact('member', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


           $this->validate(request(),[
          'first_name'=>'required',
           'middle_name'=>'required',
            'last_name'=>'required',
             'email'=>'required|email',
             'registration_no'=>'required'
         ]);
         $member = Member::findOrFail($id);


        $input = $request->only(['first_name', 'middle_name','last_name', 'email', 'registration_no']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $member->fill($input)->save();

        if (isset($roles)) {        
            $member->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $member->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('Admin_member.index')
            ->with('flash_message',
           'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
          
        $member = Member::findOrFail($id); 
          //dd($member);
        $member->delete();

        return redirect()->route('Admin_member.index')
            ->with('flash_message',
             'Member successfully deleted.');
    }
}
