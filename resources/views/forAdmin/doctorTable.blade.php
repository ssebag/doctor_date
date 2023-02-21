@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{route('doctor.create')}}" class="btn btn-primary my-4" target="_blank" rel="noopener noreferrer">
        Add new Doctor
     </a>
</div>
<div class="container-fluid">

    <table class="table">
        <thead class="thead-dark">
          <tr  style="" class="trrr">
            <th scope="col"></th>
            <th class="trrr" scope="col" >Name</th>
            <th scope="col">Department</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Photo</th>
            <th scope="col">Patients</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($doctors as $doctor )
             <tr class="trrr">
                <th scope="row"></th>
                <td><a href="{{route('doctor.show',$doctor->user_id)}}" style="text-decoration: none">{{$doctor->name}}</a></td>
                <td>@if ($doctor->depa->deleted_at != Null)
                     <a href="not found" style="text-decoration: none; color:red">{{$doctor->depa->name}}</a>
                @else
                <a href="{{route('department.doctors',$doctor->depa->name)}}" style="text-decoration: none">{{$doctor->depa->name}}</a>

                @endif
                   </td>
                <td>{{$doctor->user->email}}</td>
                <td><a href="{{route('doctorToUser',$doctor->id)}}">{{$doctor->user->role}}</a></td>
                <td><img src="{{asset('img/'.$doctor->photo)}}" alt="" height="100rem" width="80rem"></td>
                <td><a style="text-decoration: none; color=blue" href="{{route('doctor.patient',$doctor->name)}}">Show</a></td>
                 <td><a href="{{route('doctors.edit',$doctor->id)}}" class="btn btn-success">Edit</a>
                    <form method="POST" action="{{route('doctor.destroy',$doctor->id)}}" style="display: inline"  >
                        @method('Delete')
                         @csrf
                        <input type="submit" class="btn btn-danger" value="Delete" id="delete"  href="#"  >
                    </form></td>
            </tr>
        @endforeach

        </tbody>
      </table>

</div>
@endsection
