@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row"  style="height:75vh">
  @include("../components/sidebar")

    <div class="col-md-10" style="65vh">
    <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <span>Category update</span>
      <div>
        <a href="{{ route('admincategorypanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>
    <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="{{ route('adminproductpanelcreationpost') }}" >
  @csrf
  @method('Post')
  <div class="form-group mb-2 ">
    <label for="product" class="form-label text-right mr-2 " >Product:</label>
    <input type="text" name="product" value="{{ $productlistfromdatabase->product }}" id="product" class="form-control px-3 py-2 rounded-md" required>
    @error('product')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="category" class="form-label text-right mr-2 " >Category:</label>
    <select name="category" id="category" value="{{ $productlistfromdatabase->category }}" class="form-control px-3 py-2 rounded-md" required>
    <option class="form-control px-3 py-2 rounded-md">{{ $productlistfromdatabase->category }}</option>
    @foreach($categoryListFromDatabase as $category)
        <option value="{{ $category['id'] }}">{{ $category['category'] }}</option>
    @endforeach
</select>

    @error('category')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="actualPrice" class="form-label text-right mr-2 " >Actual Price:</label>
    <input type="number" name="actualPrice" value="{{ $productlistfromdatabase->actualPrice }}" id="actualPrice" class="form-control px-3 py-2 rounded-md" required>
    @error('actualPrice')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
  <label for="actualPrice" class="form-label text-right mr-2 " >Tick to provide discount value in percentage</label>
  <input id="selectedpercentage" type="checkbox">
  </div>
  <div id="inpercentage" class="form-group mb-2 ">
    <label for="discountedvalue" class="form-label text-right mr-2 " >Discounted Value:</label>
    <input type="number" name="discountedvalue" value="{{ $productlistfromdatabase->discountedvalue }}" id="discountedvalue" class="form-control px-3 py-2 rounded-md">
    @error('discountedvalue')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div id="invalue" class="form-group mb-2  d-none">
    <label for="discountedvalueinpercentage" class="form-label text-right mr-2 " >Discounted Value in %:</label>
    <input type="number" name="discountedvalueinpercentage" value="{{ $productlistfromdatabase->discountedvalueinpercentage }}" id="discountedvalueinpercentage" class="form-control px-3 py-2 rounded-md">
    @error('discountedvalueinpercentage')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2">
    <label for="valueafterdiscount" class="form-label text-right mr-2 " >Sale Price</label>
    <input type="number" name="valueafterdiscount" id="valueafterdiscount" value="{{ $productlistfromdatabase->valueafterdiscount }}" class="form-control px-3 py-2 rounded-md" required>
    @error('valueafterdiscount')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
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
    <img src="{{ asset('/public/images/' . $productlistfromdatabase->image) }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
</div>

  <button type="submit" class="btn btn-primary">Create Product</button>
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
$(document).ready(function() {
  $("#selectedpercentage").on("change", function() {
    if ($("#selectedpercentage").prop("checked")) {
      // Perform action when checkbox is checked
      $('#inpercentage').addClass('d-none');
      $('#invalue').removeClass('d-none');
    } else {
      $('#inpercentage').removeClass('d-none');
      $('#invalue').addClass('d-none');
      // Perform action when checkbox is unchecked
      // You can add any action needed here
    }
  });
});
</script>
<script>
  widnow.onload=function(){
    setTimeout(function(){
      $("#flash-message").fadeOut();
      
    },5000);
    if($("#inpercentage").value){
      $("#selectedpercentage").checked = true;
    };
  };
</script>
<script>
  widnow.onload=function(){
    if($("#inpercentage").value){
      alert = "check if data";
      // $("#selectedpercentage").checked = true;
    };
  };
</script>
    </div>
  </div>
</div>
@endsection
     