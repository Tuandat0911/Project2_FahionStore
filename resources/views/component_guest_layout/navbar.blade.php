{{--navbar--}}

<div class="row align-items-center py-3 px-xl-5">
    <div class="col-lg-3 d-none d-lg-block">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">♕</span>Fashion</h1>
        </a>
    </div>
    <div class="col-lg-6 col-6 text-left">
        <form action="{{ route('searchByName') }}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="name">
                <div class="input-group-append">
                    <button class="input-group-text bg-transparent text-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3 col-6 text-right">
        <a href="" class="btn border">
            <i class="fas fa-heart text-primary"></i>
            <span class="badge">0</span>
        </a>
        <a href="{{ route('showCart') }}" class="btn border">
            <i class="fas fa-shopping-cart text-primary"></i>
            @php
            $total = 0;
            if(!empty($carts)) {
                foreach($carts as $cart) {
                $total += 1;
                }
            }
            @endphp
            <span class="badge">{{ $total }}</span>
        </a>
    </div>
</div>
