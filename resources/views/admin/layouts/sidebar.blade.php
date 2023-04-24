<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.home") }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Admin Actions</li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category-dropdown" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-paper-cut-vertical"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li style="display: none" class="nav-item"> <a class="nav-link" ></a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("categories.index") }}">All Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("categories.create") }}">Add Category</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product-dropdown" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-basket"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li style="display: none" class="nav-item"> <a class="nav-link" ></a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("products.index") }}">All Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("products.create") }}">Add Product</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#vendor-dropdown" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-cash"></i>
                <span class="menu-title">Vendors</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="vendor-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li style="display: none" class="nav-item"> <a class="nav-link" ></a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("vendor.index") }}">All Vendors</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("vendor.create") }}">Add Vendor</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#client-dropdown" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-clipboard-text"></i>
                <span class="menu-title">Clients</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="client-dropdown">
                <ul class="nav flex-column sub-menu">
                    <li style="display: none" class="nav-item"> <a class="nav-link" ></a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("client.index") }}">All Client</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route("permission.index") }}">Client Permission</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
