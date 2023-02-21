@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr class="trrr">
            <th scope="col"></th>
            <th scope="col">Doctor Name</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">City</th>
            <th scope="col">Address</th>
            <th scope="col">Status</th>
            <th scope="col">Appointments</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient )
            <tr class="trrr">
            <th scope="row"></th>
                <td>{{$patient->doctor->name}}</td>
                <td>{{$patient->name}}</td>
                <td>{{$patient->email}}</td>
                <td>{{$patient->phone}}</td>
                <td>{{$patient->city}}</td>
                <td>{{$patient->address}}</td>
                <td>{{$patient->status}}</td>
                <td></td>
            </tr>
            @endforeach


        </tbody>
      </table>

</div>
@endsection
