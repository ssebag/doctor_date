@extends('layouts.app')
@section('content')
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <h1 class="tittle_form">Edit Department: </h1>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('department.update',$department->id)}}" novalidate>
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" value="{{$department->name}}" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>

            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Photo</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="url" rows="3" required>"{{$department->url}}"</textarea>
                       <div class="invalid-feedback">
                    Please provide a valid url.
                  </div></div>

                </div>
                  {{--<div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Photo</label>
                       <img class="card-img-top" src="({{$department->url}}" alt="Card image cap">
                       <div class="invalid-feedback">
                    Please provide a valid url.
                  </div></div>

                </div>--}}
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>

          <script>
          // Example starter JavaScript for disabling form submissions if there are invalid fields
          (function() {
            'use strict';
            window.addEventListener('load', function() {
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.getElementsByClassName('needs-validation');
              // Loop over them and prevent submission
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
          </script>
    </div>
   </div>
</div>
@endsection
