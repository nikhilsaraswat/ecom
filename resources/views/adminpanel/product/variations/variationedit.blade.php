@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row"  style="height:75vh">
  @include("../components/sidebar")

    <div class="col-md-10" style="65vh">
    <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" >
      <span>Variable update</span>
      <div>
        <a href="{{ route('adminvariationpanel') }}" >
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-window-close" aria-hidden="true"></i> Close
</button>
        </a>
    </div>
    </div>
    <form method="POST" enctype="multipart/form-data" class="h-90 flex flex-column items-center space-y-2 p-3 bg-white" action="/admin/variableedit/{{ $variablelistfromdatabase->id }}" >
  @csrf
  @method('PUT')
  <div class="form-group mb-2 ">
    <label for="attribute" class="form-label text-right mr-2 " >Attribute:</label>
    <input type="text" name="attribute" value="{{ $variablelistfromdatabase->attribute }}" id="attribute" class="form-control px-3 py-2 rounded-md" required>
    @error('attribute')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
  @php
                                    $values = json_decode($variablelistfromdatabase->value);
                                    $values = implode(",",$values);
                                @endphp

  <div class="form-group mb-2 ">
    <label for="value" class="form-label text-right mr-2 " >Value (separated with ","):</label>
    
    <input type="text" name="value" value="{{$values}}"
     id="value" class="form-control px-3 py-2 rounded-md" onkeydown="keyDown(event)">

    @error('value')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
  </div>
<div>
  <button type="submit" class="btn btn-primary">Edit Variable</button>
</form>

      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

<script>
  widnow.onload=function(){
    setTimeout(function(){
      $("#flash-message").fadeOut();
      
    },5000);}

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
     