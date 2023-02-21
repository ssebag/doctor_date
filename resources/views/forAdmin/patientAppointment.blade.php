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
                <p class="mx-2"><i>{{$patient->name}}</i></p>
            </div>
            <div class="form-group col-md-4">
                <p class="tittle_form">Email :</p>
                <p class="mx-1"><i>{{$patient->email}}</i></p>
            </div>
            <div class="form-group col-md-4">
                <p class="tittle_form">Phone :</p>
                <p class="mx-1"><i>{{$patient->phone}}</i></p>
            </div>
        </div>
        <div class="form-inline">
            <div class="form-group col-md-4">
                <p class="tittle_form">City :</p>
                <p class="mx-2"><i>{{$patient->city}}</i></p>
            </div>
            <div class="form-group col-md-4">
                <p class="tittle_form">Address :</p>
                <p class="mx-1"><i>{{$patient->address}}</i></p>
            </div>

        </div>

       </div>

    </div>
    <div class="card-body">

        <table class="table">
            <thead class="thead-dark">
              <tr class="trrr" style="align-content: start">
                <th scope="col"></th>
                <th scope="col">Day</th>
                <th scope="col">Hour</th>
                <th scope="col">Type</th>
                <th scope="col">Done</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($appointment as $app )
                 <tr class="trrr">
                    <th scope="row"></th>
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
                    <td>
                    @if (Auth::user()->role== 'manager')
                        @if ( $app->status == 'yet')
                        <a href="{{route('add.status',$app->id)}}" style="text-decoration: none; color:red; font-weight:bold">{{$app->status}}</a>
                       @else
                       <a href="{{route('add.status',$app->id)}}" style="text-decoration: none; ">{{$app->status}}</a>

                       @endif
                       @else
                       {{$app->status}}
                       @endif

                    </a></td>
                    <td>
                       @if (Auth::check())
                       @if (Auth::user()->role=="manager")
                        <a href="{{route('appointment.edit',$app->id)}}" class="btn btn-success">Edit</a>

                       @endif


                       @endif
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







