@extends('layouts.app')

@section('content')
@if (session('success'))
  <div class="alert alert-success" id="flash-message">
    {{ session('success') }}
  </div>
  @elseif (session('failure'))
  <div class="alert alert-danger" id="flash-message">
    {{ session('failure') }}
  </div>
@endif
<div class="container-fluid">
  <div class="row" style="height:90vh">
  @include("../components/sidebar")
    <div class="col-md-10">
    <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center" style="width:90vw;">
    <span>Product List</span>
    <div>
        <a href="{{ route('adminproductpanelcreation') }}" >
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create
</button>
        </a>
    </div>
</div>

      <div style="overflow-y: auto; height:65vh; width:90vw;"> 
        <b id="all" class="ml-2" style="cursor:pointer;">   All</b><b id="published" style="cursor:pointer">   Published</b><b id="draft" class="ml-2" style="cursor:pointer;">   Draft</b>
      <table id="myTable" class="table table-striped ">
        <thead>
          <tr>
            <th scope="col">Thumbnail Image</th>
            <th scope="col">Gallery:</th>
            <th scope="col">Product</th>
            <th scope="col">Category</th>
            <th scope="col">Sub-Category</th>
            <th scope="col">Tag</th>
            <th scope="col">Actual Price</th>
            <th scope="col">Discounted Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody >
          @forelse ($dataofuser as $user)
            @if($user->isadmin==0)
              <tr class="{{$user->statustype}}">
                <td><img 
                            src="{{ asset('storage/images/' . $user->image) }}"
                            alt="Example Image"
                            class="rounded-circle img-thumbnail"
                            style="width: 40px; height: 40px;"
                        ></td>
                <td>
                  <a href="#" class="pe-auto">
                @foreach ($user->images as $usim)
                <img
                            src="{{ asset('storage/images/' . $usim) }}"
                            alt="Example Image"
                            class="rounded-circle img-thumbnail "
                            style="width: 40px; height: 40px;"
                        >
                      @endforeach</td></a>
                      @php
                      $tags = json_decode($user->tag);

                  @endphp
                <td>{{ $user->product }} - {{ $user->statustype }}</td>
                <td>{{ $user->category_name }}</td>
                <td>{{ $user->subcategory_name }}</td>
                <td>

                  @foreach($tags as $tags)
                  {{ $tags }}
              @endforeach
                </td>
                <td>{{ $user->actualPrice }}</td>
                <td>{{ $user->sellingPrice }}</td>
                <td>
    <div class="card-body">
    <form method="post" action="/admin/productdelete/{{ $user->id }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
        </form>
        <a href="/admin/{{ $user->id }}/productedit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
</div>
</td>

              </tr>
            @endif
          @empty
            <tr>
              <td colspan="3" class="text-center">No users found!</td>
            </tr>
          @endforelse
        </tbody>
      </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                      <script>
                        window.onload = function() {  // Use window.onload instead of $(document).ready()
                            setTimeout(function() {
                                $("#flash-message").fadeOut();
                            }, 5000); // 5 seconds in milliseconds
                        };</script>
      <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
      <script>
        let table = new DataTable('#myTable');
        </script>
                      
                    
    </div>
  </div>
</div>
@endsection

@push('script')
<!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
<script src="{{ asset('storage/js/productcreate.js') }}"></script>
@endpush