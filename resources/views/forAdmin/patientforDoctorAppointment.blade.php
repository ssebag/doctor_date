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
        <p class="tittle_form">All Appointment :</p>
       </div>

    </div>
    <div class="card-body">

        <table class="table">
            <thead class="thead-dark">
              <tr class="trrr" style="align-content: start">
                <th scope="col"></th>
                <th scope="col" >Patient Name</th>
                <th scope="col">Status</th>
                <th scope="col">Day</th>
                <th scope="col">Hour</th>
                <th scope="col">Type</th>
                <th scope="col">Done</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($appointment as $app )
                 <tr class="trrr">
                    <th scope="row"></th>
                    <td><a href="{{route('patient.show',$app->user->id)}}" style="text-decoration: none">{{$app->user->name}}</a></td>
                    <td>
                        @if ( $app->status == 'yet')
                        <a href="{{route('add.status',$app->id)}}" style="text-decoration: none; color:red; font-weight:bold">{{$app->status}}</a>

                       @else
                       <a href="{{route('add.status',$app->id)}}" style="text-decoration: none; ">{{$app->status}}</a>

                       @endif

                    </td>

                    <td>{{$app->day}}</td>
                    <td>{{$app->begin_hour}}</td>
                    <td>{{$app->type}}</td>
                    <td>
                        @if (Auth::user()->role== 'manager')
                        <a href="{{route('appointment.done',$app->id)}}" style="text-decoration: none">{{$app->done}}</a>
                        @else
                        {{$app->done}}
                        @endif
                    </td>
                    <td><a href="{{route('appointment.edit',$app->id)}}" class="btn btn-success">Edit</a>
                        <form method="POST" action="{{route('appointment.destroy',$app->id)}}" style="display: inline"  >
                            @method('Delete')
                             @csrf
                            <input type="submit" class="btn btn-danger" value="Delete" id="delete"  href="#"  >
                        </form></td>
                </tr>
            @endforeach

            </tbody>
          </table>


    </div>
   </div>
</div>
@endsection







