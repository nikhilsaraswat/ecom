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
<div class="container-fluid" style="width:100vw;">
  <div class="row" style="height:75vh;">
  @include("../components/sidebar")
    <div class="col-md-10">
      <div class="border-bottom px-4 py-2 font-bold text-xl" >Users List</div>
      <div style="height:65vh;"> 
      <table id="myTable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Profile</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($dataofuser as $user)
            @if($user->isadmin==0)
              <tr>
                <td><img
                            src="{{ asset('storage/images/' . $user->image) }}"
                            alt="Example Image"
                            class="rounded-circle img-thumbnail"
                            style="width: 40px; height: 40px;"
                        ></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
    <div class="card-body">
    <form method="post" action="/admin/userdelete/{{ $user->id }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
        </form>
        <a href="/admin/{{ $user->id }}/useredit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
      <!-- <div id="myChart" style="max-width:700px; height:400px;"></div> -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
                <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script>
                    window.onload = function() {  // Use window.onload instead of $(document).ready()
                        setTimeout(function() {
                            $("#flash-message").fadeOut();
                        }, 5000); // 5 seconds in milliseconds
                    };
                    let table = new DataTable('#myTable');
                    </script>
    </div>
  </div>
</div>
@endsection