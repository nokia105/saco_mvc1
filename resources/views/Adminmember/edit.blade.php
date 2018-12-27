 @extends('layouts.master')
      @section('content')


         <div class="row">
       <div class='col-lg-6 col-lg-offset-3'>

          <div class="box">
            <div class="box-header">
             

    <h1><i class='fa fa-user-plus'></i> {{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}</h1>
    <hr>

    {{ Form::model($member, array('route' => array('Admin_member.update', $member->member_id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('firstname', 'First Name') }}
        {{ Form::text('first_name',null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('middlename', 'Middle Name') }}
        {{ Form::text('middle_name', null, array('class' => 'form-control')) }}
    </div>
     <div class="form-group">
        {{ Form::label('lastname', 'Last Name') }}
        {{ Form::text('last_name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

      <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

   

    <div class="form-group">
        {{ Form::label('rgistration_no', 'Registration No') }}<br>
        {{ Form::text('registration_no',null, array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
</div>
</div>
</div>

      @endsection