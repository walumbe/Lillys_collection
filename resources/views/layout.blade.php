
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lillys Collection</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="./css/styles.css" rel="stylesheet" />
    </head>
    <body>
                <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary text-white fixed-top">
                <div class="container px-4 px-lg-5">
                    <a class="navbar-brand text-white" href="/">Lillys Collection</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li> -->
                            {{-- <li class="nav-item"><a class="nav-link text-white" href="#!">About</a></li> --}}
                            
                            @guest
                                <li class="nav-item"><a class="nav-link text-white" href="/register">Register</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="/login       ">Login</a></li>
                            @endguest
                            
                            
                        </ul>
                            @auth
                            <span class="mx-3">
                                Welcome {{auth()->user()->name}}
                            </span>
                            @endauth
                        
                        <form class="d-flex">
                            <button class="btn btn-outline-light bg-light" type="submit">
                                <a href="/cart"  style="text-decoration:none">
                                    <i class="bi-cart-fill me-1"></i>
                                    Cart
                                    <span class="badge bg-light cart-count text-primary ms-1 rounded-pill">0</span>
                                </a>
                            </button>
                        </form>
                        @auth
                        <form method="POST" class="inline" action="/logout">
                            @csrf
                            <button class="btn btn-outline-light bg-light text-dark mx-3" type="submit">
                                <i class="fa-solid fa-door-closed">
                                </i>Logout
                            </button>
                        </form>
                        @endauth 
  
                    </div>
                </div>
            </nav>
            <div>
               
                    @include('flash-message')
                    @yield('content')
                
            </div>
            <!-- Footer-->
            <footer class="py-2 bg-primary fixed-bottom">
                <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Lillys Collection {{date('Y')}}</p></div>
            </footer>
            <!-- JQuery-->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="./js/scripts.js"></script>
            <script>
                // Example using jQuery for AJAX request
                $(document).ready(function() {
                    $('.add-to-cart').click(function(e) {
                        e.preventDefault();
            
                        var productId = $(this).data('product-id');
            
                        // Send an AJAX request to addToCart route
                        $.ajax({
                            url: '/cart/add/' + productId,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Update the cart count on the page
                                // var currentCount = initialCartCount + response;
                            $('.cart-count').text(currentCount);
                                var currentCount = parseInt($('.cart-count').text());
                                var newCount = currentCount + 1;
                                $('.cart-count').text(newCount);
                            },
                            error: function() {
                                console.log("An error occurred");
                            }
                        });
                    });
                });
            </script>
</body>
</html>