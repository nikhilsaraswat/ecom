@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">


  <!-- @include('../components/sidebar') -->
    <div class="col-md-10">
      <div class="border-bottom px-4 py-2 font-bold text-xl">User Update</div>
      <form method="POST" class="flex flex-column items-center space-y-2 p-3 bg-white" action="/admin/useredit/{{ $userlistfromdatabase->id }}">
  @csrf
  @method('PUT')
  <div class="form-group mb-2 ">
    <label for="name" class="form-label text-right mr-2 " >Name:</label>
    <input type="text" name="name" id="name" value="{{ $userlistfromdatabase->name }}" class="form-control px-3 py-2 rounded-md" required>
  </div>
  <div class="form-group mb-2">
    <label for="email" class="form-label text-right mr-2">Email:</label>
    <input type="email" name="email" id="email" value="{{ $userlistfromdatabase->email }}" class="form-control px-3 py-2 rounded-md" disabled>
  </div>
  <div class="form-group mb-2">
    <label for="password" class="form-label text-right mr-2 @error('password') is-invalid @enderror">New Password:</label>
    <input type="password" name="password" id="password" class="form-control px-3 py-2 rounded-md" autocomplete="new-password">
    @error('password')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
  </div>
  <div class="form-group mb-2">
    <label for="password-confirmation" class="form-label text-right mr-2">Confirm Password:</label>
    <input type="password" name="password_confirmation" id="password-confirmation" class="form-control px-3 py-2 rounded-md" autocomplete="new-password">
  </div>
  <button type="submit" class="btn btn-primary">Update Info</button>
</form>

      <div id="myChart" style="max-width:700px; height:400px;"></div>
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
    </div>
  </div>
</div>
@endsection



