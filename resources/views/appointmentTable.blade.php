@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr class="trrr">
            <th scope="col"></th>
            <th scope="col">Patient Name</th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Day</th>
            <th scope="col">Hour</th>
            <th scope="col">Duraton</th>
            <th scope="col">Done</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($appointments as $appointment )
             <tr class="trrr">
                <th scope="row"></th>
                <td><a href="{{route('patient.show',$appointment->pa_id)}}">{{$appointment->user->name}}</a> </td>
                <td>
                    @if ($appointment->doctor->deleted_at != null)
                    <i style="color:red">  {{$appointment->doctor->name}}</i>
                    @else
                    {{$appointment->doctor->name}}
                    @endif

                   </td>
                <td>{{$appointment->day}}</td>
                <td>{{$appointment->begin_hour}}</td>
                <td>{{$appointment->duration}}</td>
                <td>{{$appointment->done}}</td>
                <td></td>
            </tr>
        @endforeach

        </tbody>
      </table>

</div>
@endsection
