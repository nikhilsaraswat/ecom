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
@elseif (request()->routeIs('admincategorypanel')||request()->routeIs('admincategorypanelcreation')||request()->routeIs('adminpanelcategoryedit')||request()->routeIs('adminsubcategorypanel')||request()->routeIs('adminsubcategorypanelcreation')||request()->routeIs('adminpanelcategoryedit')||request()->routeIs('adminpanelsubcategoryedit'))
<div class="col-md-2 bg-dark text-white p-4">
<ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link px-3 py-2 rounded">User List</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link  px-3 py-2 rounded">Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link active px-3 py-2 rounded">Category Management</a>
          @if (request()->routeIs('admincategorypanel')||request()->routeIs('admincategorypanelcreation')||request()->routeIs('adminpanelcategoryedit'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2 active rounded mt-2">Category Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 py-2 rounded">Sub Category Management</a>
        </li>
          </ul>
          @elseif (request()->routeIs('adminsubcategorypanel')||request()->routeIs('adminsubcategorypanelcreation')||request()->routeIs('adminpanelsubcategoryedit'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2  rounded mt-2">Category Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 active py-2 rounded">Sub Category Management</a>
        </li>
          </ul>
          @endif
        </li>
      </ul>
    </div>
    @elseif (request()->routeIs('adminproductpanel')||request()->routeIs('adminproductpanelcreation')||request()->routeIs('adminpanelproductedit'))
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
          @if (request()->routeIs('adminproductpanel'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2 active rounded mt-2">Product Panel</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 py-2 rounded">Product Variation</a>
        </li>
          </ul>
          @elseif (request()->routeIs('adminvariationpanel'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2  rounded mt-2">Product Panel</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 active py-2 rounded">Product Variation</a>
        </li>
          </ul>
          @endif
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2 rounded">Category Management</a>
        </li>
      </ul>
     
    </div>
@endif
