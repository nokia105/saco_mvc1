 @extends('layouts.master')
   @section('title', '|Roles Member')
      @section('content')


       


           <div class="row">
        <div class="col-lg-10 col-lg-offset-1">

          <div class="box" >
            <div class="box-header" style="text-align: center">
              <h1 class="box-title" ><i class="fa fa-key"></i> Roles</h1>
              <a href="{{ route('Admin_member.index') }}" class="btn btn-default pull-right" style="margin-left:20px;">Members</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    

    
    <hr>
    <div class="table-responsive">
        <table  id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>

                    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-default pull-right" role="menu">
         <li><a href="{{ URL::to('roles/'.$role->id.'/edit') }}">
        <i class="fa fa-edit" style="color:blue; font-size:15px;"></i>Edit </a></li>

         <li> {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Add Role</a>

</div>

</div>
</div>
</div>
</div>




      @endsection