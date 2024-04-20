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
      <span>Product Create</span>
      <div>
        <a href="{{ route('adminproductpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>


      <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="{{ route('adminproductpanelcreationpost') }}" >
  @csrf
  @method('Post')
  <div class="form-group mb-2 ">
    <label for="product" class="form-label text-right mr-2 " >Title:</label>
    <input type="text" name="product" id="product" class="form-control px-3 py-2 rounded-md" required>
    @error('product')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="category" class="form-label text-right mr-2 " >Category:</label>
    <select name="category" id="category" class="form-control px-3 py-2 rounded-md" required>
    <option value="" class="form-control px-3 py-2 rounded-md">Select</option>
    @foreach($categoryList as $id=>$category)
        <option value="{{ $id }}">{{ $category }}</option>
    @endforeach
</select>
<div class="form-group mb-2 ">
    <label for="subcategory" class="form-label text-right mr-2 " >Sub Category:</label>
    <select name="subcategory" id="subcategory" class="form-control px-3 py-2 rounded-md">
    <option value="" class="form-control px-3 py-2 rounded-md">Select</option>
    @foreach($subcategoryList as $id=>$subcategory)
        <option value="{{ $id}}">{{ $subcategory}}</option>
    @endforeach
</select>
  </div>
  <div class="form-group mb-2 ">
    <label for="productshortdescription" class="form-label text-right mr-2 " >Short Description:</label>
    <textarea name="productshortdescription" cols="40" rows="2" id="productshortdescription" class="form-control px-3 py-2 rounded-md" required></textarea>
    @error('productshortdescription')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="description" class="form-label text-right mr-2 " >Description:</label>
    <textarea name="description" cols="40" rows="5" id="description" class="form-control px-3 py-2 rounded-md" required></textarea>
    @error('description')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="actualPrice" class="form-label text-right mr-2 " >Actual Price:</label>
    <input type="number" name="actualPrice" id="actualPrice" class="form-control px-3 py-2 rounded-md" required>
    @error('actualPrice')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
  <label for="actualPrice" class="form-label text-right mr-2 " >Tick to provide discount value in percentage</label>
  <input id="selectedpercentage" name="percentage" type="checkbox">
  </div>
  <div class="form-group mb-2 ">
    <label for="discount" class="form-label text-right mr-2 " >Discounted Value:</label>
    <input type="number" name="discount" id="discount" class="form-control px-3 py-2 rounded-md" required>
    @error('discount')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2">
    <label for="sellingPrice" class="form-label text-right mr-2 " >Sale Price</label>
    <input type="number" name="sellingPrice" id="sellingPrice" class="form-control px-3 py-2 rounded-md" required>
    @error('sellingPrice')
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
    <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
</div>
<div class="form-group mb-2">
    <label for="images" class="form-label text-right mr-2">Gallery: (Optional) </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images" name={} multiple accept="image/png, image/jpeg, image/gif, image/jpg">
        @error('images')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <!-- <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
    <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous"> -->
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
      alert(e.target.result)
      $('#image-preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(this.files[0]);
  });
//   $("#images").on("change", function() {
//     var reader = new FileReader();
//     reader.onload = function(e) {
//       alert(e.target.result)
//       $('#image-preview').attr('src', e.target.result);
//     };
//     reader.readAsDataURL(this.files[0]);
//   });
// });
</script>
<script>
$(document).ready(function() {
  $("#actualPrice, #discount").on("input", function() {
      let sellingprice =  $('#actualPrice').val() - $('#discount').val();
      $('#sellingPrice').attr('value', sellingprice);
  });
  

  $("#selectedpercentage").on("change", function() {
    if ($("#selectedpercentage").prop("checked")) {
      // Perform action when checkbox is checked
      let actualPrice = $('#actualPrice').val();
      let discount = $('#discount').val();
      let discountprice = discount*actualPrice/100;
      let sellingprice = actualPrice - discountprice;
      $('#sellingPrice').attr('value', sellingprice);
    } else {
      let actualPrice = $('#actualPrice').val();
      let discount = $('#discount').val();
      let sellingprice = $('#actualPrice').val()-$('#discount').val();
      $('#sellingPrice').attr('value', sellingprice);
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
  };
</script>
    </div>
  </div>
</div>
@endsection