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
    <span>Category List</span>
    <div>
        <a href="{{ route('adminsubcategorypanelcreation') }}" >
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> Create
</button>
        </a>
    </div>
</div>

      <div style="overflow-y: auto; height:65vh;"> 
      <table id="myTable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Sub-Category</th>
            <th scope="col">Category</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody >
          @forelse ($dataofsubcategory as $subcategoryinfo)
          
              <tr>
                <td><img
                            src="{{ asset('storage/images/' . $subcategoryinfo->image) }}"
                            alt="Example Image"
                            class="rounded-circle img-thumbnail"
                            style="width: 40px; height: 40px;"
                        ></td>
                
                <td>{{ $subcategoryinfo->subcategory }}</td>
                <td>{{ $subcategoryinfo->category_name }}</td>
                <td>
    <div class="card-body">
    <form method="post" action="/admin/subcategorydelete/{{ $subcategoryinfo->id }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
        </form>
        <a href="/admin/{{ $subcategoryinfo->id }}/subcategoryedit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
</div>
</td>

              </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center">No users found!</td>
            </tr>
          @endforelse
        </tbody>
      </table>
</div>

      <script src="../../js/adminpanel/forchartusinggoogle.js"></script>
      <script>
                    window.onload = function() {  // Use window.onload instead of $(document).ready()
                        setTimeout(function() {
                            $("#flash-message").fadeOut();
                        }, 5000); // 5 seconds in milliseconds
                    };
                    </script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
                <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
                <script>
                  let table = new DataTable('#myTable');
                  </script>
    </div>
  </div>
</div>
@endsection