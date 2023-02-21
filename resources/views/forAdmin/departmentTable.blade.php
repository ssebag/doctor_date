@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{route('department.create')}}" class="btn btn-primary my-4" target="_blank" rel="noopener noreferrer">
        Add new Department
     </a>
</div>
<div class="container">

    <table class="table">
        <thead class="thead-dark">
          <tr class="trrr">
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Url</th>
            <th scope="col" style="width: 10rem">Edit</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($departments as $department )
             <tr class="trrr">
                <th scope="row"></th>
                <td>{{$department->name}}</td>
                <td><img src="{{asset('img/'.$department->url)}}" alt="" height="100rem" width="100rem"></td>

                <td style="width: 15rem; "><a href="{{route('department.edit',$department->id)}}" class="btn btn-success">E</a>
                    <form style=" display:inline-block" method="POST" action="{{route('department.destroy',$department->id)}}" style="display: inline"  >
                        @method('Delete')
                         @csrf
                        <input type="submit" class="btn btn-danger" value="D" id="delete"  href="#"  >
                    </form></td>
            </tr>
        @endforeach

        </tbody>
      </table>

</div>
@endsection
