@extends('layout')
@section('content')

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5"> 

                 <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With lillys collection</p>
                </div> 
             </div>
        </header> 
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top h-50 w-100" src="{{asset('storage/'.$product->product_image)}}" alt="" class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$product->product_name}}</h5>

                                    {{-- product reviews --}}
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                   KES {{$product->price}}
                                </div>
                            </div>
                           <!-- Product actions-->
                           <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form method="POST" action="/cart/add/{{$product->id}}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    
                                    <button class="btn btn-primary add-to-cart" data-product-id="{{$product->id}}">Add to cart</button>
                                </form>
                
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>


            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end mx-4">
                  <li class="page-item {{ $products->currentPage() === 1 ? 'disabled' : '' }}">
                  <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                  </a>
                  </li>
                  @for ($i = 1; $i <= $products->lastPage(); $i++)
                      <li class="page-item {{ $products->currentPage() === $i ? 'active' : '' }}">
                          <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                      </li>
                  @endfor
                  <li class="page-item {{ $products->currentPage() === $products->lastPage() ? 'disabled' : '' }}">
                  <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                  </a>
                  </li>
              </ul>
              </nav>

        </section>
@endsection





