<div class="col-md-10">
    <div class="form-group mb-2">
        <input type="text" name="product" id="product" placeholder="Product name"
            class="form-control px-3 py-2 rounded-md beautify-input"
            style="
        background-color:white;
        font-weight: bold;
  font-size: 20px;
  color: #333; 
        "
            required>
        <div id="display_on_product_name_change" class="d-none">
            <p style="display:inline-block">
                <b>Permalink:</b>
                <a href="#">https://demo.com/product/</a>
                <a href="#" id="slugshouldbehere" class="to_view_on_cancel_permalink"></a>
                <input type="text" name="slug" id="slug" class=" to_view_on_edit_permalink d-none">
                <a href="#" class="">/</a>
                <a type="button"
                    class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 to_view_on_cancel_permalink"
                    style="color: blue; border-color: blue;"
                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                    onmouseout="$(this).addClass('bg-light');">Edit</a>
                <a type="button" id="ok_permalink_manual"
                    class="btn btn-outline-secondary me-2 btn-sm bg-light hover:bg-gray-700 d-none to_view_on_edit_permalink"
                    style="color: blue; border-color: blue;"
                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                    onmouseout="$(this).addClass('bg-light');">OK</a>
                <a class="d-none to_view_on_edit_permalink" id="cancel_permalink_manual" href="#">cancel</a>
            </p>
        </div>


        @error('product')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
    <div class="card mb-1 bg-white">
        <div class="card-header bg-white" style="height:4vh">
            <label for="description" class="form-label text-right mr-2"><b>Product Description:</b></label>
        </div>
        <div class="card-body bg-white">
            <textarea name="description"></textarea>
        </div>
    </div>

    <div class="card mb-1 bg-white">
        <div class="card-header bg-white" style="height:4vh">
            <label for="productshortdescription" class="form-label text-right mr-2"><b>Product short
                    description:</b></label>
        </div>
        <div class="card-body bg-white">
            <textarea name="productshortdescription"></textarea>
        </div>
        @error('slug')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror

    </div>

    <div class="card mb-1 bg-white">
        <div class="card-header bg-white" style="height:4vh">
            <label for="productshortdescription" class="form-label text-right mr-2"><b>Product Data &mdash;</b></label>
            <select name="producttype" id="producttype" style="width:10vw" required>
                <option value="" class="form-control rounded-md">Select</option>
                <option value="Simple" selected>Simple</option>
                <option value="Grouped">Grouped</option>
                <option value="Variable">Variable</option>
            </select>
            <div class="form-check form-check-inline">
                <label for="shopAndSearchDesktop" class="form-check-label">Virtual:</label>
                <input type="checkbox" style="cursor: pointer;" name="catalogVisibility" id="shopAndSearchDesktop"
                    value="shopAndSearch" class="form-check-custom">
            </div>
            <div class="form-check form-check-inline">
                <label for="shopAndSearchDesktop" class="form-check-label">Downloadable:</label>
                <input type="checkbox" style="cursor: pointer;" name="catalogVisibility" id="shopAndSearchDesktop"
                    value="shopAndSearch" class="form-check-custom">

            </div>
        </div>
        <div class="card-body  py-0 pl-0 bg-white">
            <div class="row py-0 ml-0" style="background-color:red; height:38vh; width:74.7vw;">
                @include('adminpanel.product.productcreatecomponents.subsidebar')

                <div class="col-md-9" style=" height:inherit; background-color:white;">
                    <div id="generalproduct"
                        class="mt-2 hiderestnonselectedinventory hiderestnonselectedshipping hiderestnonselectedlinked hiderestnonselectedattributes hiderestnonselectedadvanced hiderestnonselectedfacebook d-none">
                        <div>
                            <label for="actualPrice" class="form-label text-right" style="margin-right:4vw">Regular
                                price (₹)</label>
                            <input type="number" name="actualPrice" id="actualPrice" style="width:60%;"
                                class=" px-3 py-1 rounded-md">
                        </div>
                        <div><label for="sellingPrice" class="form-label text-right mr-2 "
                                style="margin-right:5.2vw; margin-top:2vh;">Sale price (₹)</label>
                            <input type="number" name="sellingPrice" id="sellingPrice" style="width:60%;"
                                class=" px-3 py-1 rounded-md">
                        </div>
                        <a id="scheduleset" style="margin-left:9.8vw; margin-top:2vh;" href="#">Schedule</a>
                        <div class=" d-none" id="showOnScheduleclick"><label for="actualPrice"
                                class="form-label text-right mr-2 " style="margin-right:4.3vw; margin-top:2vh;">Sale
                                price dates</label>
                            <input type="date" name="fromDate" id="fromDate" placeholder="From... YYY-MM-DD"
                                style="width:60%;" class=" px-3 py-1 rounded-md">
                            <input type="date" name="toDate" id="toDate" placeholder="To... YYY-MM-DD"
                                style="margin-left:9.8vw; width:60%;" class=" px-3 py-1 rounded-md">
                            <a id="schedulecancel" style="margin-left:9.8vw; margin-top:2vh;"
                                href="#">Cancel</a>

                        </div>

                    </div>
                    <div id="inventoryproduct"
                        class="mt-2 hiderestnonselectedgeneral hiderestnonselectedshipping hiderestnonselectedlinked hiderestnonselectedattributes hiderestnonselectedadvanced hiderestnonselectedfacebook d-none">
                        <div>
                            <label for="sku" class="form-label text-right" style="margin-right:10vw">SKU</label>
                            <input type="number" name="sku" id="sku" style="width:60%;"
                                class=" px-3 py-1 rounded-md">
                        </div>
                        <div>
                            <label for="stockmanagement" class="form-label text-right" style="margin-right:5vw">Stock
                                management</label>
                            <input type="checkbox" name="stockmanagement" id="stockmanagement"
                                style=" margin-top:2vh;" class=" rounded-md">
                            Track stock quantity for this product
                        </div>
                        <div>
                            <label for="stockstatus" class="form-label text-right" style="margin-right:7.4vw">Stock
                                status</label>
                            <input type="radio" name="stockstatus" id="stockstatus" class=" px-3 py-1 rounded-md"
                                checked>
                            In stock
                        </div>
                        <div>
                            <label><input type="radio" name="outofstock" id="outofstock"
                                    class=" px-3 py-1 rounded-md" style="margin-left:11.7vw"> Out of stock</label>
                        </div>
                        <div>
                            <label><input type="radio" name="onbackorder" id="onbackorder"
                                    class=" px-3 py-1 rounded-md" style="margin-top:1vh; margin-left:11.7vw"> On back
                                order</label>
                        </div>
                        <div>
                            <label for="soldind" class="form-label text-right" style="margin-right:6vw">Sold
                                individually</label>
                            <input type="checkbox" name="soldind" id="soldind" style=" margin-top:2vh;"
                                class=" rounded-md">
                            Limit purchases to 1 item per order
                        </div>
                        <div>
                            <label for="initnostock" class="form-label text-right" style="margin-right:4vw">Initial
                                number in stock</label>
                            <input type="number" name="initnostock" id="initnostock"
                                style="width:60%; margin-top:1vh;" class=" px-3 py-1 rounded-md">
                        </div>
                    </div>
                    {{-- work starts here for General --}}
                    <div id="shippingproduct"
                        class="mt-2 hiderestnonselectedgeneral hiderestnonselectedinventory hiderestnonselectedlinked hiderestnonselectedattributes hiderestnonselectedadvanced hiderestnonselectedfacebook d-none">
                        <div>
                            <label for="wtkg" class="form-label text-right" style="margin-right:8vw">Weight
                                (kg)</label>
                            <input type="number" name="wtkg" id="wtkg" style="width:60.5%;"
                                class=" px-3 py-1 rounded-md">
                        </div>
                        <div>
                            <label for="dim" class="form-label text-right" style="margin-right:6.4vw">Dimensions
                                (cm)</label>
                            <input type="number" name="len" id="len" style="width:20%;"
                                placeholder="Length" class=" px-3 py-1 rounded-md mt-3">
                            <input type="number" name="width" id="width" style="width:20%;"
                                placeholder="Width" class=" px-3 py-1 rounded-md">
                            <input type="number" name="ht" id="ht" style="width:20%;"
                                placeholder="Height" class=" px-3 py-1 rounded-md">
                        </div>
                        <label for="productship" class="form-label text-right" style="margin-right:7.15vw">Shipping
                            class</label>
                        <select name="productship" id="productship" style="width:33.25vw" class="mt-3 p-2" required>
                            <option value="" class="form-control rounded-md">No Shipping Class</option>
                        </select>
                    </div>

                    <div id="linkedproduct"
                        class="mt-2 hiderestnonselectedgeneral hiderestnonselectedinventory hiderestnonselectedshipping hiderestnonselectedattributes hiderestnonselectedadvanced hiderestnonselectedfacebook d-none">
                        <div>
                            <label for="upsell" class="form-label text-right"
                                style="margin-right:8vw">Upsells</label>
                            <input type="text" name="upsell" id="upsell" style="width:60.5%;"
                                placeholder="Search for a product..." class="mb-0 rounded-md">
                            <div style="background-color:white; width:60.5%; margin-left:10.7vw"
                                class=" p-1 mt-0 d-none" id="upsellList"></div>
                        </div>
                        <div>
                            <label for="xsell" class="form-label text-right"
                                style="margin-right:6.75vw ">Cross-sells</label>
                            <input type="text" name="xsell" id="xsell" style="width:60.5%;"
                                placeholder="Search for a product..." class=" px-3 py-1 mt-3 rounded-md">
                            <div style="background-color:white; width:60.5%; margin-left:10.7vw"
                                class=" p-1 mt-0 d-none" id="xsellList"></div>
                        </div>

                    </div>
                    {{-- may be require to work more in this--}}
                    <div id="attributesproduct"
                        class="mt-2 hiderestnonselectedgeneral hiderestnonselectedinventory hiderestnonselectedshipping hiderestnonselectedlinked hiderestnonselectedadvanced hiderestnonselectedfacebook d-none"
                        style=" height:30vh;">
                        <div class="d-flex container-fluid align-items-center justify-content-between"
                            style=" height:4vh; width:100%;border-left: .25vw solid #818589;">
                            <p class="m-0">Add descriptive pieces of information that customers can use to search
                                for this product on your store, such as “Material” or “Brand”.</p>
                            <p style="cursor:pointer;" class="mr-10"><i class="fas fa-times"></i></p>
                        </div>
                        <div class="mt-2 d-flex container-fluid align-items-center justify-content-between"
                            style=" height:4vh; width:100%">
                            <div style=" height:4vh; width:40%">
                                <button type="button"
                                    class="btn btn-outline-secondary me-2 p-2 btn-sm bg-light hover:bg-gray-700"
                                    style="color: blue; border-color: blue;" id="createEmpty"
                                    onmouseover="$(this).removeClass('bg-light').css('background-color', '#f2f2f2');"
                                    onmouseout="$(this).addClass('bg-light');">
                                    Add New
                                </button>
                                <input type="text" name="upsell" id="searchattr" style="width:50%;"
                                    placeholder="Add existing..." onkeyup="filterFunction()" class="rounded-md">
                                <div id="productattr"
                                    style="margin-left:4.35vw; background-color:white; width:10.7vw; cursor: pointer; z-index:1;"
                                    class="dropdown-content d-none">
                                    @foreach ($dataofvariables as $data)
                                        <option style=" background-color:white; border: none;
                                          width:100%;
                                          cursor: pointer;"
                                          value = "{{$data->attribute}}"
                                            onmouseover="this.style.backgroundColor='blue'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='white'; this.style.color='';"
                                            onclick="crefixvalattrspace('{{$data->attribute}}', '{{$data->value}}');">
                                            {{ $data->attribute }}</option>
                                    @endforeach
                                </div>
                            </div>
                            <a class="d-flex align-items-center justify-content-between" href="#"
                                style=" height:4vh; width:10%">
                                Expand / Close
                            </a>
                        </div>
                        <div id="container">
                            <!-- HTML will be created and appended here -->
                        </div>
                        <div style="z-index:4; position: absolute; top-0; right-0;"
                            class="mt-2 "><button class="btn btn-primary">Save attributes</button></div>
                    </div>
                    <div id="advancedproduct"
                        class="mt-2 hiderestnonselectedgeneral hiderestnonselectedinventory hiderestnonselectedshipping hiderestnonselectedlinked hiderestnonselectedattributes hiderestnonselectedfacebook d-none"
                        style=" height:30vh;">
                        <div class="d-flex container-fluid align-items-center"><label for="purchaseNote" class="form-label text-right"
                          style="margin-right:8vw">Purchase note</label>
                      <textarea name = "purchaseNote" style="width:50%; height:5vh;" class="rounded"></textarea></div>
                        <div class="mt-2"><label for="upsell" class="form-label text-right"
                                style="margin-right:8.6vw; padding-left:0.7vw;">Menu order</label>
                            <input type="text" name="upsell" id="upsell" style="width:49%;"
                                placeholder="Search for a product..." class="mb-0 rounded-md"></div>
                      </div>
                      {{-- may be require to work more in this--}}
                      <div id="facebookproduct"
                      class="mt-2 hiderestnonselectedgeneral hiderestnonselectedinventory hiderestnonselectedshipping hiderestnonselectedlinked hiderestnonselectedattributes hiderestnonselectedadvanced"
                      style=" height:30vh; background-color:violet;">
                      <label for="productship" class="form-label text-right" style="margin-right:10vw;padding-left:0.7vw;">Facebook sync</label>
                    <select name="productship" id="productship" style="width:33.25vw" class="mt-3 p-2" required>
                        <option value="" class="form-control rounded-md">Sync and show in catalog</option>
                        <option value="" class="form-control rounded-md">Sync and hide in catalog</option>
                        <option value="" class="form-control rounded-md">Do not sync</option>
                    </select>
                    <div class="d-flex container-fluid align-items-center mt-2"><label for="purchaseNote" class="form-label text-right"
                      style="margin-right:8vw">Facebook Description</label>
                  <textarea name = "purchaseNote" style="width:50%; height:5vh;" class="rounded "></textarea></div>
                  <div class="mt-2">
                    <label for="stockstatus" class="form-label text-right" style="margin-right:7.4vw;padding-left:0.7vw;">
                      Facebook Product Image</label>
                    <input type="radio" name="stockstatus" id="stockstatus" class=" px-3 py-1 rounded-md"
                        checked>
                        Use WC image
                </div>
                  <div>
                    <label><input type="radio" name="onbackorder" id="onbackorder"
                            class=" px-3 py-1 rounded-md" style="margin-top:1vh; margin-left:16.6vw"> Use custom image</label>
                </div>
                <div class="mt-2"><label for="upsell" class="form-label text-right"
                  style="margin-right:8.6vw; padding-left:0.7vw;">Custom Image URL</label>
              <input type="text" name="upsell" id="upsell" style="width:49%;"
                  placeholder="Search for a product..." class="mb-0 rounded-md"></div>
                   
                <div class="mt-2"><label for="upsell" class="form-label text-right"
                  style="margin-right:8.6vw; padding-left:0.7vw;">Facebook Price (₹)</label>
              <input type="input" name="upsell" id="upsell" style="width:49%;"
                  placeholder="Search for a product..." class="mb-0 rounded-md"></div>
                    </div>
                    {{-- work ends here --}}
                </div>
            </div>
        </div>
    </div>


    a
</div>
