 @extends('layouts.master')

       @section('title', '| Inactive Member')

      @section('content')

        <div class="error" style="padding-top:50px; text-align:center;">


            @if (session('error'))
                    <div class="alert alert-danger">
                        <strong>Warning! </strong>{{ session('error') }}
                    </div>
                @endif
            
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

       
<div class="row">
       <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Inactive Members</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th style="width:20%;">Name</th>
                        <th>Reg No:#</th>
                         <th>Mobile</th>
                        <th>Email</th>
                        <th>Bank</th>
                        <th>A/C No</th>
                        <th>Joining Date</th>
                        <th>Status</th>
                        <th>update</th>
                        <th>delete</th>
                </tr>
                </thead>
                <tbody>

                 
                 @foreach($members as $member)
                  
                <tr>
                   <td><a href="{{route('member_profile',$member->member_id)}}">{{Ucfirst($member->first_name)}} {{Ucfirst($member->last_name)}}</a></td>
                   <td>{{$member->registration_no}}</td>
                   <td>{{$member->phone}}</td>
                  <td>{{$member->email}}</td>
                   <td>{{$member->bank_name}}</td>
                   <td>{{$member->account_number}}</td>
                  <td>{{\Carbon\carbon::parse($member->joining_date)->format('d/m/y')}}</td>
                  <th>{{$member->status}}</th>
                  <td><span class="label label-sm label-info"><a href="{{route('member.edit',$member->member_id)}}" style="color:#ffff">Edit</a></span></td>
                  <td><span class="label label-sm label-danger"><a style="color:#ffff; cursor:pointer;"  onclick="confirm_modal('{{route('member.delete',$member->member_id)}}')">Delete</a></span></td>   
                </tr>
                 @endforeach
                 
          
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

         @include('modal.popup_lib')

      @endsection