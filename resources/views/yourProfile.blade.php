@extends('layouts.app')
@section('content')
@if (session('alert'))
<div class="alert alert-primary"  >
   {{session('alert')}}

</div>
@endif
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardInformationheader">
       <div class="">
        <div class="form-inline">
            <div class="form-group col-md-4">
                <p class="tittle_form">Name:</p>
                <p class="mx-2"><i>{{$user->name}}</i></p>
            </div>
            <div class="form-group col-md-5">
                <p class="tittle_form">Email :</p>
                <p class="mx-1"><i>{{$user->email}}</i></p>
            </div>
            <div class="form-group col-md-3">
                <p class="tittle_form">Phone :</p>
                <p class="mx-1"><i>{{$user->phone}}</i></p>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-4">
                <p class="tittle_form">City :</p>
                <p class="mx-2"><i>{{$user->city}}</i></p>
            </div>
            <div class="form-group col-md-6">
                <p class="tittle_form">Address :</p>
                <p class="mx-1"><i>{{$user->address}}</i></p>
            </div>
            <div class="form-group col-md-2">
                @if(Auth::check())
                @if($user->id == Auth::id() || Auth::user()->role == 'admin')
                 <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary">edit</a>
                @endif
                @endif
            </div>

        </div>
       </div>

    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
              <tr  style="" class="trrr">
                <th scope="col"></th>

                <th scope="col">Doctor</th>
                <th scope="col">Department</th>
                <th scope="col">appointment</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($information as $info )
                    <tr class="trrr">
                        <th scope="row"></th>
                            @if ($info->doctor->depa->deleted_at != Null || $info->doctor->deleted_at != Null )
                            <td><a href="not found" style="text-decoration: none;color:red;">{{$info->doctor->name}}</a></td>
                            <td><a href="not found" style="text-decoration: none ;color:red;">{{$info->doctor->depa->name}}</a></td>
                            @else
                            <td><a href="{{route('doctor.show',$info->doctor->user_id)}}" style="text-decoration: none;">{{$info->doctor->name}}</a></td>
                           <td><a href="{{route('department.doctors',$info->doctor->depa->name)}}" style="text-decoration: none">{{$info->doctor->depa->name}}</a></td>


                            @endif
                    <td><a style="text-decoration: none; color=blue" href="{{route('patient.appointment',['user_id'=>$user->name , 'dr_id'=>$info->dr_id])}}">Show</a></td>
                    </tr>
                 @endforeach

            </tbody>
          </table>

    </div>
   </div>
</div>
@endsection



