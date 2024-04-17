@extends('layouts.app')

@section('content')
@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @elseif (session('failure'))
  <div class="alert alert-danger">
    {{ session('failure') }}
  </div>
@endif
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-dark text-white p-4">
      <ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link active px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">User List</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link px-3 py-2 rounded">Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link px-3 py-2 rounded">Category Management</a>
        </li>
      </ul>
    </div>

    <div class="col-md-10">
      <div class="border-bottom px-4 py-2 font-bold text-xl">Users List</div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($dataofuser as $user)
            @if($user->isadmin==0)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <!-- <td>
                <form action="/admin/delete/{{ $user->id }}" method="post">
                  <a class="btn btn-sm btn-danger" >
        <i type="submit" class="fas fa-trash-alt"></i>
                  </a></form>
                  <a href="/admin/{{ $user->id }}/useredit" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                  </a>
                </td> -->
                <td class="d-flex">
  <form method="post" action="/admin/userdelete/{{ $user->id }}">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger">
      <i class="fas fa-trash-alt"></i>
    </button>
  </form>
  <a href="/admin/{{ $user->id }}/useredit" class="btn btn-sm btn-primary">
    <i class="fas fa-edit"></i>
  </a>
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
      
      <div id="myChart" style="max-width:700px; height:400px;"></div>
      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script>
      $(document).ready(function() {
        // Prevent default form submission for delete button (optional, if needed)
        $('.delete-confirmation-btn').click(function(e) {
          e.preventDefault();
        });
      });

      </scrit>
    </div>
  </div>
</div>
@endsection