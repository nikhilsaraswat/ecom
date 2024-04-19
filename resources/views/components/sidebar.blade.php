@if (request()->routeIs('adminpanel')||request()->routeIs('adminpaneluseredit'))
<div class="col-md-2 bg-dark text-white p-4">
      <ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link active px-3 py-2 rounded">User List</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link px-3 py-2 rounded">Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link px-3 py-2 rounded">Category Management</a>
        </li>
      </ul>
    </div>
@elseif (request()->routeIs('admincategorypanel')||request()->routeIs('admincategorypanelcreation')||request()->routeIs('adminpanelcategoryedit'))
<div class="col-md-2 bg-dark text-white p-4">
      <ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link px-3 py-2 rounded">User List</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link px-3 py-2 rounded">Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link active px-3 py-2 rounded">Category Management</a>
        </li>
      </ul>
    </div>
    @elseif (request()->routeIs('adminproductpanel'))
<div class="col-md-2 bg-dark text-white p-4">
      <ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link px-3 py-2 rounded">User List</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link active px-3 py-2 rounded">Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link px-3 py-2 rounded">Category Management</a>
        </li>
      </ul>
    </div>
@endif
