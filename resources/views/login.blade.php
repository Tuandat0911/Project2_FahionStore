
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{ asset('login_form/style.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>
<div class="container">
    @if(session('success'))
        <script>
            window.onload = function() {
                alert("Register Success!");
            };
        </script>
    @endif

        @if(session('error'))
            <script>
                window.onload = function() {
                    alert("Email or password invalid!");
                };
            </script>
        @endif
    <div class="login-section">
        <form action="{{ route('login.loginHandling') }}" method="post">
            @csrf
            <div class="form-box Login">
                <h2>Sign In</h2>

                <div class="input-box">
                    <input type="email" required name="email" autocomplete="off">
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" required name="password" autocomplete="off">
                    <label for="">Password</label>
                </div>
                <div class="input-box">
                    <button class="btn" type="submit">Sign In</button>
                </div>

                <div class="account-login">
                    <label for="">Create an account?<a href="#" class="Register-link">Sign up</a></label>
                </div>
            </div>
        </form>

        <form action="{{ route('user.store')  . '?role_id=2' }}" method="post">
            @csrf
            <div class="form-box Register">
                <h2>Sign Up</h2>
                <div class="input-box">
                    @error('name')
                    <input type="text" required name="name" autocomplete="off" class="form-control @error('name') is-invalid @enderror" value="{{ $message }}">
                    <script>
                        window.onload = function() {
                            alert("Đăng ký không thành công");
                        };
                    </script>
                    @else
                        <input type="text" required name="name" autocomplete="off" class="form-control">
                    @enderror
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    @error('email')
                    <input type="text" required name="email" autocomplete="off" class="form-control @error('name') is-invalid @enderror" value="{{ $message }}">
                    <script>
                        window.onload = function() {
                            alert("Đăng ký không thành công");
                        };
                    </script>
                    @else
                        <input type="text" required name="email" autocomplete="off" class="form-control">
                        @enderror
                        <label for="">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" required name="password" autocomplete="off">
                    <label for="">Password</label>
                </div>
                <div class="input-box">
                    <input type="number" required name="phone" autocomplete="off">
                    <label for="">Phone</label>
                </div>
                <div class="input-box">
                    <input type="text" required name="address" autocomplete="off">
                    <label for="">Address</label>
                </div>
                <div class="input-box">
                    <button type="submit" class="btn">Register</button>
                </div>

                <div class="account-login">
                    <label for="">Already have an account?<a href="#" class="Login-link">Sign in</a></label>
                </div>
            </div>
        </form>


    </div>

    <div class="item">
        <div class="content">
            <!-- swipper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('login_form/image/login_bg_2.png') }}" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('login_form/image/login_bg.png') }}" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('login_form/image/login_bg_3.png') }}" alt="">
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
        },
    });

    const loginsec = document.querySelector('.login-section');
    const RegisterLink = document.querySelector('.Register-link');
    const LoginLink = document.querySelector('.Login-link');

    RegisterLink.addEventListener('click',()=>{
        loginsec.classList.add('active')
    })

    LoginLink.addEventListener('click',()=>{
        loginsec.classList.remove('active')
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>


