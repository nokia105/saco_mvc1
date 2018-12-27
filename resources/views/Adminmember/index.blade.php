 @extends('layouts.master')
      @section('content')

         
           <div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Members</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Registration No:</th>
                    <th>Full Name</th>
                   <th>Email</th>
                   <th>Member Roles</th>
                   <th>Action</th>
                   
                
                </tr>
                </thead>
                <tbody>
                  @foreach($members as $member)  
                 <tr>
                  <td>#{{$member->registration_no}}</td>   
                <td>{{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}</td>
                <th>{{$member->email}}</th>
                <th>{{  $member->roles()->pluck('name')->implode(' , ') }}</th>
                <td>
                                
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
         <li><a href="{{ route('Admin_member.edit', $member->member_id) }}">
        <i class="fa fa-edit" style="color:blue; font-size:15px;"></i>Edit </a></li>

         <li>{!! Form::open(['method' => 'DELETE', 'route' => ['Admin_member.destroy', $member->member_id] ]) !!}
                    {!! Form::submit('Delete',array('class' => 'fa fa-trash')) !!}
                    {!! Form::close() !!}
        </li>
                               
         </ul>
         </div>
</td>
                </tr>
                 @endforeach
               
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

           <a href="{{ route('Admin_member.create') }}" class="btn btn-success">Add Member</a>
        </div>
        <!-- /.col -->
      </div>


  @endsection    
