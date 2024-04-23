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
        <a href="{{ route('adminvariationpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>


      <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="{{ route('adminvariationpanelcreationpost') }}" >
  @csrf
  @method('Post')
  <div class="form-group mb-2 ">
    <label for="attribute" class="form-label text-right mr-2 " >Attribute:</label>
    <input type="text" name="attribute" id="attribute" class="form-control px-3 py-2 rounded-md" required>
    @error('attribute')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  <div class="form-group mb-2 ">
    <label for="value" class="form-label text-right mr-2 " >Value (separated with ","):</label>
    <input type="text" name="value" id="value" class="form-control px-3 py-2 rounded-md" onkeydown="keyDown(event)">
    @error('value')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>

  <button type="submit" class="btn btn-primary">Create Attribute</button>
</form>

      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
 
                    <script>
                       window.onload=function(){
    setTimeout(function(){
      $("#flash-message").fadeOut();
      
    },5000);
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