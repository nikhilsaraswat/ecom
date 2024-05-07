<div class="col-md-2">
    <div class="d-flex pr-10 flex-column">
      <input type=text id="clickstatusdraftorpreview" name="clickbutton" class="d-none"/>
    <div class="card-header p-2" style="background-color:white;">
      <h5 class="" style="border-bottom: 2px solid #acacac;">
        <b >
          Publish
        </b>
      </h5>
    </div>
  <div class="card-body p-2" style="background-color:white;">
    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-dark"
      id="savedraft"
        style="color: blue; border-color: blue;"
        onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
        onmouseout="$(this).addClass('bg-light');">
          Save Draft
      </button>
      <button type="submit" class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700"
      id="preview"
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
          <b id="statusset">Draft </b><a href="#" id="editstatus">Edit</a>
          <div id="statusrighttoshow" class="d-none">
          <select name="statustype" id="statustype" style="width:6vw; cursor:pointer;" >
            <option value="Pending Review" class="form-control rounded-md">Pending Review</option>
            <option value="Draft"  selected>Draft</option>
        </select>
        <a type="button" id="ok_status_change"
                    class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_edit_permalink"
                    style="color: blue; border-color: blue;"
                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                    onmouseout="$(this).addClass('bg-light');">OK</a>
                <a class=" to_view_on_edit_permalink" id="cancel_status_change" href="#">cancel</a></div>
               

        
        </label>
      </div>
    </br>
    <div class="form-check form-check-inline">
    {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
      <i class="fa fa-eye form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
      <label class="form-check-label " for="shopAndSearch">Visibility: 
        <b id="publicset">Public </b>
        <a href="#" id="editpublic">Edit</a>
        
        <div id="publicrighttoshow" class="d-none">
            <label><input type="radio" name="Public" id="Public" value="Public"
                    class=" px-3 py-1 rounded-md" onclick="handleRadioButtonClick(this)">Public</label>
                    <br/>
                    <label><input type="radio" name="password_protected" id="passProtect" value="passProtect"
                      class=" px-3 py-1 rounded-md" onclick="handleRadioButtonClick(this)">Password protected</label>
                      <br/>
                      <label for="upsell" class="form-label text-right d-none toshowonprotectvisible"
                                style="margin-right:8vw">
                                Password
                            </label>
                            <input type="text" name="passvisible" id="passvisible" style="width:60.5%;"
                                 class="mb-0 rounded-md d-none toshowonprotectvisible">  <br class="d-none toshowonprotectvisible"/>
                      <label><input type="radio" name="private" id="private" value="private"
                        class=" px-3 py-1 rounded-md" onclick="handleRadioButtonClick(this)">Private</label>
                        <br/>
        <a type="button" id="ok_public_change"
                    class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_edit_permalink"
                    style="color: blue; border-color: blue;"
                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                    onmouseout="$(this).addClass('bg-light');">OK</a>
                <a class=" to_view_on_edit_permalink" id="cancel_public_change" href="#">cancel</a></div>
                

      </label>
    </div>
    </br>
   
    <div class="form-check form-check-inline">
      {{-- <input class="form-check-input " style="cursor:pointer" type="radio" name="catalogVisibility" id="shopAndSearch" value="shopAndSearch" checked> --}}
      <i class="fa fa-calendar form-check-input" aria-hidden="true" style="color: #acacac;  border: none;"></i>
      <label class="form-check-label " for="shopAndSearch">Publish: <b id="timeset">immediately </b><a href="#" id="edittime">Edit</a>
        <div id="timerighttoshow" class="d-none">
          <select name="monthtype" id="monthtype" style="width:3.1vw; cursor:pointer; font-size: smaller;" >
            <option value="Jan" class="form-control rounded-md" style="font-size: smaller;">01-Jan</option>
            <option  value="Feb" style="font-size: smaller;">02-Feb</option>
            <option value="Mar" style="font-size: smaller;">03-Mar</option>
            <option  value="Apr" style="font-size: smaller;">04-Apr</option>
            <option  value="May" style="font-size: smaller;">05-May</option>
            <option  value="Jun" style="font-size: smaller;">06-Jun</option>
            <option  value="Jul" style="font-size: smaller;">07-Jul</option>
            <option  value="Aug" style="font-size: smaller;">08-Aug</option>
            <option  value="Sep" style="font-size: smaller;">09-Sep</option>
            <option  value="Oct" style="font-size: smaller;">10-Oct</option>
            <option  value="Nov" style="font-size: smaller;">11-Nov</option>
            <option  value="Dec" style="font-size: smaller;">12-Dec</option>
        </select>
        <input type="number" name="daytype" id="daytype" style="width:10.5%;font-size: smaller;"
        placeholder="05" min=1 max=31 class="mb-0 p-0 rounded-md number-text">,
        <input type="number" name="yeartype" id="yeartype" style="width:15.5%;font-size: smaller;"
        placeholder="2024" min=0 max=10000 class="mb-0 p-0 rounded-md number-text">at
        <input type="number" name="hrtype" id="hrtype" style="width:10.5%;font-size: smaller;"
        placeholder="16" min=0 max=24 class="mb-0 rounded-md number-text">:
        <input type="number" name="mintype" id="mintype" style="width:10.5%;font-size: smaller;"
        placeholder="39" min=0 max=30 class="mb-0 rounded-md number-text">
                      <br/>
      <a type="button" id="ok_time_change"
                  class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_edit_permalink"
                  style="color: blue; border-color: blue;"
                  onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                  onmouseout="$(this).addClass('bg-light');">OK</a>
              <a class=" to_view_on_edit_permalink" id="cancel_time_change" href="#">cancel</a></div>
      </label>
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
    <label for="image" class="form-label text-right mr-2">Catalog visibility: <b id="catalogset">Shop and search results</b> 
      <a href="#" id="editcatalog">Edit</a> 
        {{-- working start --}}
      <div id="catalogrighttoshow" class="d-none">
        <label><input type="radio" name="SSER" id="SSER" value="Shop and search results"
                class=" px-3 py-1 rounded-md" onclick="handleRadioButtonCatClick(this)">Shop and search results</label>
                <br/>
                <label><input type="radio" name="SO" id="SO" value="Shop only"
                  class=" px-3 py-1 rounded-md" onclick="handleRadioButtonCatClick(this)">Shop only</label>
                  <br/>
                  <label><input type="radio" name="SRO" id="SRO" value="Search results only"
                    class=" px-3 py-1 rounded-md" onclick="handleRadioButtonCatClick(this)">Search results only</label>
                    <br/>
                    <label><input type="radio" name="hid" id="hid" value="Hidden"
                      class=" px-3 py-1 rounded-md" onclick="handleRadioButtonCatClick(this)">Hidden</label>
                      <br/>
                      <div class="form-check form-check-inline">
                        
                        <input type="checkbox" style="cursor: pointer;" name="featured" id="featured"
                            value="featured" class="form-check-custom">
                            <label for="featured" class="form-check-label">This is a featured product</label>
                    </div>
                    <br/>
    <a type="button" id="ok_catlog_change"
                class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_edit_permalink"
                style="color: blue; border-color: blue;"
                onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                onmouseout="$(this).addClass('bg-light');">OK</a>
            <a class=" to_view_on_catalog_permalink" id="cancel_catalog_change" href="#">cancel</a></div>
            {{-- working end --}}
    </label>
    <div style="width:100%;" class="d-flex container-fluid justify-content-end">
    <button type="submit" class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-dark"
    id="publish"
    style="color: blue; border-color: blue;"
    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
    onmouseout="$(this).addClass('bg-light');">
      Publish
  </button></div></div>
    
     <!-- Content for the second column goes here -->
     <div class="form-group mb-2 p-2" style="background-color:white;">
      <label for="image" class="form-label text-right mr-2">Product Image: (Optional) </label>
      <div class="custom-file">
          <input type="file" class="custom-file-input @error('image') is-invalid @enderror d-none" id="image" name="image" accept="image/png, image/jpeg, image/gif, image/jpg"  >
      </div>
      <div><a href="#" id="displayImageLink">Display Product Image</a></div>
      <img id="image-preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Preview">
      <div><a href="#" id="hiddenImageLink" class="d-none">Remove Product Image</a></div>
      {{-- <img src="{{ asset('storage/images/1713428191.png') }}" id="image-previous" class="img-thumbnail mt-2" style="max-width: 150px;" alt="previous"> --}}
  </div>
  <div class="form-group mb-2 p-2" style="background-color:white">
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
  <div class="form-group mb-2 p-2" style="background-color:white">
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
<div class="form-group p-2" style="background-color:white">
  <label style=" cursor:pointer;" for="category" class="form-label text-right m-0 " onclick="this.setAttribute('style','color:blue')" >All categories</label>
  <label style=" cursor:pointer;" for="category" class="form-label text-right m-0" onclick="this.setAttribute('style','color:blue')" >Most Used</label>
  <br/>
  {{-- @foreach($categoryList as $id=>$category)
  <input type="checkbox" name="category" id="category" style="cursor: pointer;" name="featured" id="featured"
  value="{{ $id }}" class="form-check-custom">
  <label for="featured" class="form-check-label">{{ $category }}</label></br>
  @foreach($subcategoryList as $subcategoryList)
  <input type="checkbox" class="{{ $subcategoryList->category_id}} displaynone d-none" name="subcategory" id="subcategory" style="cursor: pointer;" name="featured" id="featured"
  value="{{ $subcategoryList->id}}" class="form-check-custom">
<label for="featured" class="{{ $subcategoryList->category_id}} displaynone d-none" class="form-check-label">{{ $subcategoryList->subcategory}}</label>
@endforeach
  @endforeach --}}
  <div style=" margin:0;">
  @foreach($categoryList as $id=> $category)
  <input type="checkbox" name="category{{$id}}" id="{{ $category }}" style="cursor: pointer;" value="{{ $id }}" onchange="changeCat(this.value, this.id )" class="{{ $id}} form-check-custom makecheck">
  <label for="category" class="form-check-label"><b>{{ $category }}</b></label><br>
  @foreach($subcategoryList as $subcategory )
  @if($subcategory->category_name == $category && $subcategory->subcategory !==null )
  <div><input type="checkbox" class="{{$category }} displaynone makecheck" name="subcategory{{$subcategory->id}}" id="subcategory{{$subcategory->id}}" style="cursor: pointer;" value="{{ $subcategory->id }}" class="form-check-custom">
    <label for="subcategory" class="{{$category }}  form-check-label displaynone">{{ $subcategory->subcategory }}</label></div>
  @endif
    @endforeach
  @endforeach
</div>
</div>

</div>
  </div>
  <style>
   .number-text {
  -moz-appearance: textfield; /* Firefox */
  appearance: textfield; /* Other browsers */
}

/* Optional: additional styling for the specific input fields */
.number-text::-webkit-inner-spin-button,
.number-text::-webkit-outer-spin-button {
  -webkit-appearance: none; /* Webkit browsers */
  margin: 0; /* Remove default margin */
}
    </style>