 @extends('layouts.master')
      @section('content')




	    <div class="row">
       <div class='col-lg-4 col-lg-offset-4'>

          <div class="box">
            <div class="box-header">
             

    <h1><i class='fa fa-user-plus'></i> Add Members</h1>
    <hr>

    {{ Form::open(array('url' => 'Admin_member')) }}

    <div class="form-group">
        {{ Form::label('firstname', 'First Name') }}
        {{ Form::text('first_name', '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('middlename', 'Middle Name') }}
        {{ Form::text('middle_name', '', array('class' => 'form-control')) }}
    </div>
     <div class="form-group">
        {{ Form::label('lastname', 'Last Name') }}
        {{ Form::text('last_name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

   

    <div class="form-group">
        {{ Form::label('rgistration_no', 'Registration No') }}<br>
        {{ Form::text('registration_no','', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
</div>
</div>
</div>

@endsection

     