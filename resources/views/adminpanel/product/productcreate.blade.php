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
<div style="overflow-y: auto; height:75vh;">
  <div class="h-100">
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
        <label for="slug" class="form-label text-right mr-2 " >Slug:</label>
        <input type="text" name="slug" id="slug" class="form-control px-3 py-2 rounded-md">
        @error('slug')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
      </div>
      <div class="form-group mb-2 ">
        <label for="tags" class="form-label text-right mr-2 " >Tags (separated with ","):</label>
        <input type="text" name="tags" id="tags" class="form-control px-3 py-2 rounded-md" onkeydown="keyDown(event)">
        @error('tags')
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
  </div>
    <div class="form-group mb-2 ">
        <label for="subcategory" class="form-label text-right mr-2 " >Sub Category:</label>
        <select name="subcategory" id="subcategory" class="form-control px-3 py-2 rounded-md">
        <option value="" class="form-control px-3 py-2 rounded-md">Select</option>
        @foreach($subcategoryList as $subcategoryList)
            <option class="{{ $subcategoryList->category_id}} displaynone d-none" value="{{ $subcategoryList->id}}">{{ $subcategoryList->subcategory}}</option>
        @endforeach
    </select>
      </div>
      <div class="form-group mb-2 ">
        <label for="productshortdescription" class="form-label text-right mr-2 " >Short Description (Optional):</label>
        <textarea name="productshortdescription" cols="40" rows="2" id="productshortdescription" class="form-control px-3 py-2 rounded-md" ></textarea>
      </div>
      <div class="form-group mb-2 ">
        <label for="description" class="form-label text-right mr-2 " >Description (Optional):</label>
        <textarea name="description" cols="40" rows="5" id="description" class="form-control px-3 py-2 rounded-md" ></textarea>
      </div>
      <div class="form-group mb-2 ">
        <label for="producttype" class="form-label text-right mr-2 " >Product Type:</label>
        <select name="producttype" id="producttype" class="form-control px-3 py-2 rounded-md" required>
        <option value="" class="form-control px-3 py-2 rounded-md">Select</option>
        <option value="Simple" selected>Simple</option>
        <option value="Grouped">Grouped</option>
        <option value="Variable">Variable</option>
    </select>
    </div>
      <div class="form-group mb-2 tohideifnotsimpleproduct">
        <label for="actualPrice" class="form-label text-right mr-2 " >Actual Price:</label>
        <input type="number" name="actualPrice" id="actualPrice" class="form-control px-3 py-2 rounded-md">
        @error('actualPrice')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
      </div>
      <div class="form-group mb-2 tohideifnotsimpleproduct">
        <label for="sellingPrice" class="form-label text-right mr-2 " >Sale Price</label>
        <input type="number" name="sellingPrice" id="sellingPrice" class="form-control px-3 py-2 rounded-md">
        @error('sellingPrice')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
      </div>
      <div class="form-group mb-2 tohideifnotsimpleproduct">
      <label for="selectedpercentage" class="form-label text-right mr-2 " >Tick if providing discount value in percentage</label>
      <input id="percentage" name="percentage" value=1 type="checkbox">
      </div>
      <div class="form-group mb-2 tohideifnotsimpleproduct">
        <label for="discount" class="form-label text-right mr-2 " >Discounted Value:</label>
        <input type="number" name="discount" id="discount" class="form-control px-3 py-2 rounded-md">
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
        <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous">
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
        <div id="filesviewer"></div>
    </div>
    
      <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div></div>

    

      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
 
                    <script>
                       window.onload=function(){
    setTimeout(function(){
      $("#flash-message").fadeOut();
      
    },5000);
  };

$(document).ready(function() {
  $("#category").on("change",function(){
    var classes = $("#category").val();
    $(".displaynone").addClass('d-none');
    $("."+classes).removeClass('d-none');

  })

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

  $("#image").on("change", function() {
    $('#image-preview').removeClass('d-none');
    $('#image-previous').addClass('d-none');
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image-preview').attr('src', e.target.result);
    };
    
    reader.readAsDataURL(this.files[0]);
  });

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
      // Perform action when checkbox is checked   $(this).removeAttr('required');
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