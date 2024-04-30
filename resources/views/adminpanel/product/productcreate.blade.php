@extends('layouts.app')

@section('content')
@include('adminpanel.product.productcreatecomponents.productsuccesserrorfailuredisplay');
<div >
  <div class="row"  style="height:75vh">
  @include('components.sidebar')

    <div class="col-md-10" style="height:95vh;width:94.5vw;background-color:#f2f2f2">
      <div class=" px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" style="background-color: white" >
      <b>Add New</b>
      <div>
        <a href="{{ route('adminproductpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>
<div style="overflow-y: auto; height:92vh; overflow-x: hidden; border-top: 0.5px solid white; /* Set the border color */">
  <div class="h-100" style="">
    <div class="col-md-10" style="height:95vh;width:94.5vw;">
      <div class=" px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <b style="font-size:1vw">Add New Product</b>
    </div>
    <form method="POST" enctype="multipart/form-data" id="productimageform" style="max-width:93vw" class="h-90 flex flex-column items-center space-y-2 " action="{{ route('adminproductpanelcreationpost') }}" >
      @csrf
      @method('Post')
        <div class="row container-fluid">
          @include("adminpanel.product.productcreatecomponents.middlecontent")
          @include("adminpanel.product.productcreatecomponents.rightsidecontent")
        </div></div>
       
      <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div></div>
<link rel="stylesheet" href="{{ asset('storage/css/imageandproductinvshipstyle.css') }}">
@stack('productcreate')
    </div>
  </div>
</div>
@endsection
@push('script')
<!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->


<script src="{{ asset('storage/js/productwindowload.js') }}"></script>
<script src="{{ asset('storage/js/productwindowload.js') }}"></script>
<script src="{{ asset('storage/js/productinventoryshipdisplay.js') }}"></script>
<script src="{{ asset('storage/js/productsearchupsell.js') }}"></script>
<script src="{{ asset('storage/js/productsearchxsell.js') }}"></script>
<script src="{{ asset('storage/js/productslugseo.js') }}"></script>
<script src="{{ asset('storage/js/producttags.js') }}"></script>
<script src="{{ asset('storage/js/productbulkimageuploader.js') }}"></script>
<script src="{{ asset('storage/js/attributeproduct.js') }}"></script>

<script>
// 


</script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'productshortdescription' );
</script>
@endpush