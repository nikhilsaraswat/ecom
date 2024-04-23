@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row"  style="height:75vh">
  @include("../components/sidebar")

    <div class="col-md-10" style="65vh">
    <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <span>Category update</span>
      <div>
        <a href="{{ route('adminproductpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>
    <div style="overflow-y: auto; height:75vh;">
      <div class="h-100">
    <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="/admin/productedit/{{ $productlistfromdatabase->id }}" >
  @csrf
  @method('PUT')
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
    <label for="slug" class="form-label text-right mr-2 " >Slug:</label>
    <input type="text" name="slug" value="{{ $productlistfromdatabase->slug }}" id="slug" class="form-control px-3 py-2 rounded-md">
    @error('slug')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  @php
  $values = json_decode($productlistfromdatabase->tag);
  $values = implode(",",$values);
@endphp
  <div class="form-group mb-2 ">
    <label for="tags" class="form-label text-right mr-2 " >Tag (separated with ","):</label>
    
    <input type="text" name="tags" value="{{$values}}"
     id="tags" class="form-control px-3 py-2 rounded-md" onkeydown="keyDown(event)">

    @error('tags')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
<div>
  <div class="form-group mb-2 ">
    <label for="category" class="form-label text-right mr-2 " >Category:</label>
    <select name="category" id="category" value="{{ $productlistfromdatabase->category_id }}" class="form-control px-3 py-2 rounded-md" required>
    <option class="form-control px-3 py-2 rounded-md" disabled>{{ $productlistfromdatabase->category_name }}</option>
    <option disabled>-*-----*Select*------*-</option>
    @foreach($categoryList as $category=>$id)
        <option value="{{ $id }}">{{ $category}}</option>
    @endforeach
</select>
  </div>
  <div class="form-group mb-2 ">
    <label for="subcategory" class="form-label text-right mr-2 " >Sub Category:</label>
    <select name="subcategory" id="subcategory" value="{{ $productlistfromdatabase->subcategory_id }}" class="form-control px-3 py-2 rounded-md">
    <option value="" class="form-control px-3 py-2 rounded-md" disabled>{{ $productlistfromdatabase->subcategory_name }}</option>
    <option disabled>-*-----*Select*------*-</option>
    @foreach($subcategoryList as $subcategory)
        <option class="{{ $subcategory->category_id}} displaynone d-none" value="{{ $subcategory->id}}">{{ $subcategory->subcategory}}</option>
    @endforeach
</select>
  </div>
  <div class="form-group mb-2 ">
    <label for="productshortdescription" class="form-label text-right mr-2 " >Short Description (Optional):</label>
    <textarea name="productshortdescription" value="{{ $productlistfromdatabase->productshortdescription }}" cols="40" rows="2" id="productshortdescription" class="form-control px-3 py-2 rounded-md" >{{ $productlistfromdatabase->productshortdescription }}</textarea>
  </div>
  <div class="form-group mb-2 ">
    <label for="description" class="form-label text-right mr-2 " >Description (Optional):</label>
    <textarea name="description" cols="40" value="{{ $productlistfromdatabase->description }}" rows="5" id="description" class="form-control px-3 py-2 rounded-md" >{{ $productlistfromdatabase->description }}</textarea>
  </div>
  <div class="form-group mb-2 ">
    <label for="producttype" class="form-label text-right mr-2 " >Product Type:</label>
    <select name="producttype" id="producttype" class="form-control px-3 py-2 rounded-md" required>
    <option value="" class="form-control px-3 py-2 rounded-md">Select</option>
    @if($productlistfromdatabase->producttype=="Simple")
    <option value="Simple" selected>Simple</option>
    <option value="Grouped">Grouped</option>
    <option value="Variable">Variable</option>
    @elseif($productlistfromdatabase->producttype=="Grouped")
    <option value="Grouped" selected>Grouped</option>
    <option value="Simple">Simple</option>
<option value="Variable">Variable</option>
    @elseif($productlistfromdatabase->producttype=="Variable")
    <option value="Variable" selected>Variable</option>
    <option value="Grouped">Grouped</option>
    <option value="Simple">Simple</option>
    @endif
</select>
</div>
  <div class="form-group mb-2 tohideifnotsimpleproduct ">
    <label for="actualPrice" class="form-label text-right mr-2 " >Actual Price:</label>
    <input type="number" name="actualPrice" value="{{ $productlistfromdatabase->actualPrice }}" id="actualPrice" class="form-control px-3 py-2 rounded-md" required>
    @error('actualPrice')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 tohideifnotsimpleproduct">
    <label for="sellingPrice" class="form-label text-right mr-2 " >Sale Price</label>
    <input type="number" name="sellingPrice" value="{{ $productlistfromdatabase->sellingPrice }}" id="sellingPrice"  class="form-control px-3 py-2 rounded-md" required>
    @error('sellingPrice')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 tohideifnotsimpleproduct">
  <label for="selectedpercentage" class="form-label text-right mr-2 " >Tick if provided discount value in percentage</label>
  @if($productlistfromdatabase->percentage == 1)
  <input id="percentage" name="percentage" value=1 type="checkbox" checked>
  @elseif($productlistfromdatabase->percentage == 0)
  <input id="percentage" name="percentage" value=1 type="checkbox" >
  @endif
  </div>
  <div class="form-group mb-2 tohideifnotsimpleproduct">
    <label for="discount" class="form-label text-right mr-2 " >Discounted Value:</label>
    <input type="number" name="discount" id="discount" value="{{ $productlistfromdatabase->discount }}" class="form-control px-3 py-2 rounded-md" required>
    @error('discount')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2">
    <label for="image" class="form-label text-right mr-2">Thumbnail Image: (Optional) </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/png, image/jpeg, image/gif, image/jpg">
        @error('image')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
    <img src="{{ asset('/storage/images/' . $productlistfromdatabase->image) }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
</div>
<div class="form-group mb-2">
    <label for="images" class="form-label text-right mr-2">Gallery: (Optional) </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/png, image/jpeg, image/gif, image/jpg">
        @error('images')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>
<div>
  <!-- 
@foreach ($productlistfromdatabase->images as $product)
<img src="{{ asset('/storage/images/' . $product) }}" id="image-preview" class="img-thumbnail mt-2" style="max-width: 150px;" alt="Preview">
@endforeach
</div> -->
  <button type="submit" class="btn btn-primary">Edit Product</button>
</form>
</div></div>
      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                    <script>
$(document).ready(function() {
  var classes = $("#category").val();
    $(".displaynone").addClass('d-none');
    $("."+classes).removeClass('d-none');
  $("#category").on("change",function(){
    var classes = $("#category").val();
    $(".displaynone").addClass('d-none');
    $("."+classes).removeClass('d-none');

  })

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
  if($("#producttype").value!="Simple"){
    $(".tohideifnotsimpleproduct").addClass('d-none');
  }
    else if($("#producttype").value!="Grouped"){
      $(".tohideifnotsimpleproduct").removeClass('d-none');
    }else if($("#producttype").value!="Variable"){
      $(".tohideifnotsimpleproduct").removeClass('d-none');
    }


$("#producttype").on("change",function(){
    if(this.value!="Simple"){
    $(".tohideifnotsimpleproduct").addClass('d-none');
  }
    else if(this.value!="Grouped"){
      $(".tohideifnotsimpleproduct").removeClass('d-none');
    }else if(this.value!="Variable"){
      $(".tohideifnotsimpleproduct").removeClass('d-none');
    }
  })
</script>
<script>
$(document).ready(function() {
  $("#actualPrice, #sellingPrice").on("input", function() {
    if ($("#percentage").prop("checked")) {
      let actualPrice = $('#actualPrice').val();
      let sellingPrice = $('#sellingPrice').val();
      let discountprice = ((actualPrice-sellingPrice)/actualPrice)*100;
      $('#discount').attr('value', discountprice);
    }else{
      let discountprice = $('#actualPrice').val()-$('#sellingPrice').val();
      $('#discount').attr('value', discountprice);}
  });

  $("#percentage").on("change", function() {
    if ($("#percentage").prop("checked")) {
      // Perform action when checkbox is checked
      let actualPrice = $('#actualPrice').val();
      let sellingPrice = $('#sellingPrice').val();
      let discountprice = ((actualPrice-sellingPrice)/actualPrice)*100;
      $('#discount').attr('value', discountprice);
    } else {
      let discountprice = $('#actualPrice').val()-$('#sellingPrice').val();
      $('#discount').attr('value', discountprice);
    }
  });
});
</script>
<script>
  window.onload=function(){
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
  function keyDown(e) { 
  var e = window.event || e;
  var key = e.keyCode;
  //space pressed
   if (key == 32) { //space
    e.preventDefault();
   }
         
}
</script>
    </div>
  </div>
</div>
@endsection
     