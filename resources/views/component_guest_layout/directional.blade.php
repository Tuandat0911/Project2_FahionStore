<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
            <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
            @if(Auth::user())
            <a href="{{ route('orderStatus') }}" class="nav-item nav-link">Order Status</a>
            @endif
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{ route('showCart') }}" class="dropdown-item">Shopping Cart</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
        </div>
        <div class="navbar-nav ml-auto py-0">
            @if(Auth::check())
            <a href="#" class="nav-item nav-link">{{ Auth::user()->name }}</a>
            <a href="{{ route("login.logoutHandling") }}" class="nav-item nav-link">Log Out</a>
            @else
                    <a href="{{ route('login.index') }}" class="nav-item nav-link">Login</a>
            @endif
        </div>
    </div>
</nav>
