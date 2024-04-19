@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row"  style="height:75vh">
  @include("../components/sidebar")

    <div class="col-md-10" style="65vh">
      <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <span>User Update</span>
      <div>
        <a href="{{ route('adminpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>
      <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="/admin/useredit/{{ $userlistfromdatabase->id }}" >
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
  <div class="form-group mb-2">
    <label for="image" class="form-label text-right mr-2">Image:</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
        @error('image')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
    <img src="{{ asset('storage/images/' . $userlistfromdatabase->image) }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
</div>

  <button type="submit" class="btn btn-primary">Update Info</button>
</form>

      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                    <script>
$(document).ready(function() {
  $("#image").on("change", function() {
    $('#image-preview').removeClass('d-none');
    $('#image-previous').addClass('d-none');
    document.getElementById('image-preview').style.display = "block"
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image-preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  });
});
</script>
    </div>
  </div>
</div>
@endsection



