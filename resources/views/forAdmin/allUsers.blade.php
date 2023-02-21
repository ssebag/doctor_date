@extends('layouts.app')

@section('content')
<div class="container-fluid">
</div>
<div class="container">

    <table class="table">
        <thead class="thead-dark">
          <tr  style="" class="trrr">
            <th  scope="col" >Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>

            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

            @foreach ($users as $user )
             <tr class="trrr">
                <th scope="row">{{$user->name}}</th>
                <th scope="row">{{$user->email}}</th>
                <th scope="row">
                    @if ($user->role=='admin')
                    <a href="#">{{$user->role}}</a>
                    @else
                    <a href="{{route('doctorToUser',$user->id)}}">{{$user->role}}</a>
                    @endif
                </th>
                <th>
                @if ($user->role=='admin')
                  <a href="#"></a>
                @else
                    @if ($user->role=='manager')
                    <a href="{{route('doctors.edit',$user->id)}}" class="btn btn-success">Edit</a>
                    @else
                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-success">Edit</a>
                    @endif
                    <form method="POST" action="{{route('user.destroy',$user->id)}}" style="display: inline"  >
                        @method('Delete')
                         @csrf
                        <input type="submit" class="btn btn-danger" value="Delete" id="delete"  href="#"  >
                    </form>
                @endif
            </th>


            </tr>
        @endforeach

        </tbody>
      </table>

</div>
@endsection
