@extends('layouts.app')
@section('content')
@if (session('alert'))
<div class="alert alert-primary"  >
   {{session('alert')}}

</div>
@endif
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <div class="part1">
        <div class="form-inline">
            <div class="form-group col-md-4">
                <p class="tittle_form">Doctor Name:</p>
                <p class="mx-2"><i><a href="{{route('doctor.show',$doctor->id)}}" style="text-decoration: none">{{$doctor->name}}</a></i></p>
            </div>
            <div class="form-group col-md-8">
                <p class="tittle_form">Department:</p>

                @if ($doctor->depa->deleted_at != null)
                <p class="mx-1"><i><a  href="#" style="text-decoration: none; color:red">{{$doctor->depa->name}}</a></i></p>
                @else
                    <p class="mx-1"><i><a href="{{route('department.doctors',$doctor->depa->name)}}" style="text-decoration: none">{{$doctor->depa->name}}</a></i></p>
                @endif
            </div>

        </div>
          <div class="form-inline">
            <div class="form-group col-md-12">
                <p class="tittle_form">Details:</p>
                <p class="mx-2"><i>{{$doctor->details}}</i></p>
            </div>
          </div>

       </div>
       <div class="part2">
        <img src="{{asset('img/'.$doctor->photo)}}" alt="">
       </div>
    </div>
    <div class="card-body">

        <table class="table">
            <thead class="thead-dark">
              <tr class="trrr" style="align-content: start">
                <th scope="col"></th>
                <th scope="col" >Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">City</th>

                <th scope="col">Apointment</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($patient as $pat )
                 <tr class="trrr">
                    <th scope="row"></th>
                    <td>{{$pat->user->name}}</td>
                    <td>{{$pat->user->email}}</td>
                    <td>{{$pat->user->phone}}</td>
                    <td>{{$pat->user->city}}</td>

                    <td><a style="text-decoration: none; color=blue" href="{{route('patient.appointment', ['user_id'=> $pat->user->name ,'dr_id'=> $pat->dr_id]) }}">Show</a></td>

                </tr>
            @endforeach

            </tbody>
          </table>

    </div>
   </div>
</div>
@endsection






