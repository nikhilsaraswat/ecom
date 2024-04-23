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
  <div class="row" style="height:75vh">
  @include("../components/sidebar")
    <div class="col-md-10">
    <div class="border-bottom px-4 py-2 font-bold text-xl d-flex justify-content-between align-items-center">
    <span>Product List</span>
    <div>
        <a href="{{ route('adminproductpanelcreation') }}" >
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create
</button>
        </a>
    </div>
</div>

      <div style="overflow-y: auto; height:65vh;"> 
      <table class="table table-striped" class="h-100">
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
              <tr>
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
                            class="rounded-circle img-thumbnail"
                            style="width: 40px; height: 40px;"
                        >
                      @endforeach</td></a>
                      @php
                      $tags = json_decode($user->tag);

                  @endphp
                <td>{{ $user->product }}</td>
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
      <!-- <script src="../../js/adminpanel/forchartusinggoogle.js"></script> -->
      <script>
                    window.onload = function() {  // Use window.onload instead of $(document).ready()
                        setTimeout(function() {
                            $("#flash-message").fadeOut();
                        }, 5000); // 5 seconds in milliseconds
                    };
                    </script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    </div>
  </div>
</div>
@endsection