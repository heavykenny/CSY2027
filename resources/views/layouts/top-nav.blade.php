<nav class="navbar custom-navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@eshop.com</a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:07366994971">07366994971</a>
            </div>
            <div>
                @if(auth()->user())
                    <span class="text-light"> Welcome {{auth()->user()->name}}</span>
                    @if(auth()->user()->role->name == "admin")
                        <a class="btn-warning btn-lg" style="text-decoration: none; margin: 10px"
                           href="{{route("admin.home")}}">
                            Admin Dashboard </a>
                    @elseif(auth()->user()->role->name == "client" && auth()->user()->vendor_id !== null)
                        <a class="btn-warning btn-lg" style="text-decoration: none; margin: 10px"
                           href="{{route("admin.home")}}">
                            Client Dashboard </a>
                    @endif
                    <a class="btn-success btn-lg" style="text-decoration: none; margin: 10px;" href="{{route("logout")}}">
                        Logout </a>
                @else
                    <a class="btn-success btn-lg" style="text-decoration: none; " href="{{route("login")}}"> Login /
                        Register </a>
                @endif
            </div>
        </div>
    </div>
</nav>
