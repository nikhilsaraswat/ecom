@if (request()->routeIs('adminpanel')||request()->routeIs('adminpaneluseredit'))
<div class="col-md-1 bg-dark text-white p-4">
      <ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link active px-3 py-2 rounded"><i class="px-2 fa-solid fa-user"></i>Users</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link px-3 py-2 rounded"><i class="x-2 fab fa-product-hunt"></i>Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link px-3 py-2 rounded"><i class="px-2 fa fa-list-alt" aria-hidden="true"></i>Category Management</a>
        </li>
      </ul>
    </div>
@elseif (request()->routeIs('admincategorypanel')||request()->routeIs('admincategorypanelcreation')||request()->routeIs('adminpanelcategoryedit')||request()->routeIs('adminsubcategorypanel')||request()->routeIs('adminsubcategorypanelcreation')||request()->routeIs('adminpanelcategoryedit')||request()->routeIs('adminpanelsubcategoryedit'))
<div class="col-md-2 bg-dark text-white p-4">
<ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link px-3 py-2 rounded"><i class="px-2 fa-solid fa-user"></i>Users</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link  px-3 py-2 rounded"><i class="x-2 fab fa-product-hunt"></i>Product Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link active px-3 py-2 rounded"><i class="px-2 fa fa-list-alt" aria-hidden="true"></i>Category Management</a>
          @if (request()->routeIs('admincategorypanel')||request()->routeIs('admincategorypanelcreation')||request()->routeIs('adminpanelcategoryedit'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2 active rounded mt-2"><i class="px-2 fa fa-list-alt" aria-hidden="true"></i>Category Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 py-2 rounded"><i class="px-2 fas fa-th"></i>Sub Category Management</a>
        </li>
          </ul>
          @elseif (request()->routeIs('adminsubcategorypanel')||request()->routeIs('adminsubcategorypanelcreation')||request()->routeIs('adminpanelsubcategoryedit'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2  rounded mt-2"><i class="px-2 fa fa-list-alt" aria-hidden="true"></i>Category Management</a>
        </li>
        <li class="nav-item">
          <a href="/admin/subcategory" class="nav-link mt-2 px-3 active py-2 rounded"><i class="px-2 fas fa-th"></i>Sub Category Management</a>
        </li>
          </ul>
          @endif
        </li>
      </ul>
    </div>
    @elseif (request()->routeIs('adminproductpanel')||request()->routeIs('adminproductpanelcreation')||request()->routeIs('adminpanelproductedit')||request()->routeIs('adminvariationpanel')||request()->routeIs('adminvariationpanelcreate')||request()->routeIs('adminpanelvariableedit')||request()->routeIs('adminvariationproductpanel')||request()->routeIs('adminvariationproductpanelcreate')||request()->routeIs('adminvariationproductpanelcreationpost')||request()->routeIs('adminpanelvariationproductdelete')||request()->routeIs('adminpanelvariableproductedit')||request()->routeIs('adminpanelvariableproductupdate'))
<div class="col-md-1 bg-dark text-white " style="height:97vh;width:6.7vw;">
<ul class="nav flex-column nav-pills mb-auto">
        <li class="nav-item">
          <a href="/admin" class="nav-link px-3 py-2 rounded"><i class="fa-solid fa-user px-2"></i>Users</a>
        </li>
        <li class="nav-item">
          <a href="/admin/user" class="nav-link px-3 py-2 rounded">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product" class="nav-link active"><i class=" fab fa-product-hunt"></i>Products</a>
          @if (request()->routeIs('adminproductpanel')||request()->routeIs('adminproductpanelcreation'))
          <ul class="nav d-flex flex-column align-items-start nav-pills mb-auto my-1" style="background-color:#303030">
          <li class="nav-item">
          <a href="/admin/product" class="nav-link mt-2">All Products</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variations" class="nav-link  font-weight-bold text-white rounded" >Add New</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link rounded">Categories</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link rounded">Tags</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link rounded">Attributes</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link rounded">Reviews</a>
        </li>

          </ul>
          @elseif (request()->routeIs('adminvariationpanel')||request()->routeIs('adminvariationpanelcreate')||request()->routeIs('adminpanelvariableedit'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/product" class="nav-link  px-3 py-2  rounded mt-2"><i class="x-2 fab fa-product-hunt"></i>Product</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variations" class="nav-link mt-2 px-3 active py-2 rounded"><i class="fa fa-random" aria-hidden="true"></i>Product Variation Attributes</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link mt-2 px-3 py-2 rounded"><i class="fa fa-road" aria-hidden="true"></i>Product Variation</a>
        </li>
          </ul> 
          @elseif (request()->routeIs('adminvariationproductpanel')||request()->routeIs('adminvariationproductpanelcreate')||request()->routeIs('adminpanelvariableproductedit')||request()->routeIs('adminvariationproductpanelcreate')||request()->routeIs('adminvariationproductpanelcreationpost')||request()->routeIs('adminpanelvariationproductdelete')||request()->routeIs('adminpanelvariableproductedit')||request()->routeIs('adminpanelvariableproductupdate'))
          <ul class="nav d-flex flex-column align-items-end nav-pills mb-auto">
          <li class="nav-item">
          <a href="/admin/product" class="nav-link  px-3 py-2  rounded mt-2"><i class="x-2 fab fa-product-hunt"></i>Product</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variations" class="nav-link mt-2 px-3 py-2 rounded"><i class="fa fa-random" aria-hidden="true"></i>Product Variation Attributes</a>
        </li>
        <li class="nav-item">
          <a href="/admin/product/variationsproduct" class="nav-link mt-2 px-3 active py-2 rounded"><i class="fa fa-road" aria-hidden="true"></i>Product Variation</a>
        </li>
          </ul>
          @endif
        </li>
        <li class="nav-item">
          <a href="/admin/category" class="nav-link  px-3 py-2 rounded"><i class="px-2 fa fa-list-alt" aria-hidden="true"></i>Category Management</a>
        </li>
      </ul>
     
    </div>
@endif
