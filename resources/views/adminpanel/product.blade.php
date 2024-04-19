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
        <a href="{{ route('admincategorypanelcreation') }}" >
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create
</button>
        </a>
    </div>
</div>

      <div style="overflow-y: auto; height:65vh;"> 
      <table class="table table-striped" class="h-100">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
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
                <td>{{ $user->category }}</td>
                <td>
    <div class="card-body">
    <form method="post" action="/admin/categorydelete/{{ $user->id }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
        </form>
        <a href="/admin/{{ $user->id }}/categoryedit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
</div>
                  <!-- <div>
  <form method="post" action="/admin/userdelete/{{ $user->id }}">
    @csrf
      <i type="submit" class=" btn btn-sm btn-danger fas fa-trash-alt"></i>
  </form>
  <a href="/admin/{{ $user->id }}/useredit" class="btn btn-sm btn-primary">
    <i class="fas fa-edit"></i>
  </a></div> -->
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
      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
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