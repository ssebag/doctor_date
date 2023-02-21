@extends('layouts.app')
@section('content')
<div class="container">
   <div class="card cardAppointment">
    <div class="card-header cardAppointmentheader">
       <h1 class="tittle_form">Edit: </h1>
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('user.update',$user->id)}}" novalidate>
           @csrf
           @method('PUT')
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">Name</label>
                <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Name" value="{{$user->name}}" required>
                <div class="valid-feedback">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                  </div>
                  <input type="text" class="form-control" value="{{$user->email}}" name="email" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Please choose a username.
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="validationCustom05">Address</label>
                  <input type="text" class="form-control" value="{{$user->address}}" name="address" id="validationCustom05" placeholder="Address" required>
                  <div class="invalid-feedback">
                    Please provide a valid address.
                  </div>
                </div>

              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom05">Phone</label>
                  <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="validationCustom05" placeholder="Phone1" required>
                  <div class="invalid-feedback">
                    Please provide a valid phone.
                  </div>
                </div>

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
