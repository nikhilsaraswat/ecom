@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" id="flash-message">
  {{session('success')}}
</div>
@elseif(session('failure'))
<div class="alert alert-danger" id="flash-message">
  {{session('failure')}}
</div>
@endif
<div class="container-fluid">
  <div class="row"  style="height:75vh">
  @include("../../components/sidebar")

    <div class="col-md-10" style="65vh">
      <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <span>Category List</span>
      <div>
        <a href="{{ route('admincategorypanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>


      <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="{{ route('admincategorypanelcreationpost') }}" >
  @csrf
  @method('Post')
  <div class="form-group mb-2 ">
    <label for="name" class="form-label text-right mr-2 " >Category:</label>
    <input type="text" name="name" id="name" class="form-control px-3 py-2 rounded-md" required>
  </div>
  <div class="form-group mb-2">
    <label for="image" class="form-label text-right mr-2">Image: (Optional) </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
        @error('image')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
    <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
</div>

  <button type="submit" class="btn btn-primary">Create Category</button>
</form>

      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                    <script>
$(document).ready(function() {
  $("#image").on("change", function() {
    $('#image-preview').removeClass('d-none');
    $('#image-previous').addClass('d-none');
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image-preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  });
});
</script>
<script>
  widnow.onload=function(){
    setTimeout(function(){
      $("#flash-message").fadeOut();
      
    },5000);
  };
</script>
    </div>
  </div>
</div>
@endsection