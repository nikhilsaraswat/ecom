<div class="col-md-2">
    <div class="d-flex pr-10 flex-column">
    <div class="card-header p-2" style="background-color:white;">
      <h5 class="" style="border-bottom: 2px solid #acacac;">
        <b>
          Publish
        </b>
      </h5>
    </div>
  <div class="card-body p-2" style="background-color:white;">
    <div class="d-flex justify-content-between">
      <button type="button" class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-dark"
        style="color: blue; border-color: blue;"
        onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
        onmouseout="$(this).addClass('bg-light');">
          Save Draft
      </button>
      <button type="button" class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700"
        style="color: blue; border-color: blue;"
        onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
        onmouseout="$(this).addClass('bg-light');">
          Preview
      </button>
      </div>
      <div class="form-check form-check-inline">
        {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
        <i class="fa fa-anchor form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
        <label class="form-check-label " for="shopAndSearch">Status: 
          {{-- working start --}}
          <b id="statusset">Draft </b><a href="#" id="editstatus">Edit</a>
          <div id="statusrighttoshow" class="d-none">
          <select name="statustype" id="statustype" style="width:6vw; cursor:pointer;" required>
            <option value="Pending Review" class="form-control rounded-md">Pending Review</option>
            <option value="Draft"  selected>Draft</option>
        </select>
        <a type="button" id="ok_status_change"
                    class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_edit_permalink"
                    style="color: blue; border-color: blue;"
                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                    onmouseout="$(this).addClass('bg-light');">OK</a>
                <a class=" to_view_on_edit_permalink" id="cancel_status_change" href="#">cancel</a></div>
        {{-- working end --}}
        </label>
      </div>
    </br>
    <div class="form-check form-check-inline">
    {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
      <i class="fa fa-eye form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
      <label class="form-check-label " for="shopAndSearch">Visibility: <b>Public </b><a href="#">Edit</a></label>
    </div>
    </br>
    <div class="form-check form-check-inline">
      {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
      <i class="fa fa-calendar form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
      <label class="form-check-label " for="shopAndSearch">Publish: <b>immediately </b><a href="#">Edit</a></label>
  </div>
  <div class="form-check form-check-inline">
    {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
    <i class="fa fa-rocket form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
    <label class="form-check-label " for="shopAndSearch"><a href="#">SEO</a>: <b>Not available </b></label>
  </div>
  <div class="form-check form-check-inline">
  {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
    <i class="fa fa-book form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
    <label class="form-check-label " for="shopAndSearch"><a href="#">Readibility</a>: <b>Not available </b></label>
  </div>
  </div>
  <div class="form-group mb-2 p-2" style="background-color:white;">
    <label for="image" class="form-label text-right mr-2">Catalog visibility: <b>Shop and search results</b> <a>Edit</a> </label></div>
     <!-- Content for the second column goes here -->
     <div class="form-group mb-2">
      <label for="image" class="form-label text-right mr-2">Product Image: (Optional) </label>
      <div class="custom-file">
          <input type="file" class="custom-file-input @error('image') is-invalid @enderror d-none" id="image" name="image" accept="image/png, image/jpeg, image/gif, image/jpg"  >
      </div>
      <div><a href="#" id="displayImageLink">Display Product Image</a></div>
      <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
      <div><a href="#" id="hiddenImageLink" class="d-none">Remove Product Image</a></div>
      {{-- <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous"> --}}
  </div>
  <div class="form-group mb-2 ">
    <label for="tags" class="form-label text-right mr-2 " >Tags (enter to add, remove with "x"):</label>
    <input type="text" name="tag" id="tags" class="form-control px-3 py-2 rounded-md mb-4" onkeydown="keyDown(event)">
    <input type="text" name="tags" id="tag" class="form-control px-3 py-2 rounded-md mb-4 d-none">
    <div id="tags-container"></div>
    @error('tags')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2">
    <label for="images" class="form-label text-right mr-2">Gallery: (Optional) </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('images') is-invalid @enderror d-none" id="images" name="images[]" multiple accept="image/png, image/jpeg, image/gif, image/jpg">
    </div>
  
    <div id="visible_on_gallery_display" class=" d-none" style="overflow-y: auto; overflow-x: auto; height:25vh; width:15vw;">
      <div id="filesviewer" class="h-100 w-100">
      </div>
    </div>
    <div><a href="#" id="displayImagesLink">Add product gallery images.</a></div>
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
    b
  </div>