@extends('user.layout.master')

@section('content')
    {{-- SHOP START --}}

    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>


                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#homePage')}}" class="text-dark"><label for="" class="">All</label></a>
                        </div>

                        @foreach ($categories as $category)
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter',$category->id)}}" class="text-dark"><label for="" class="">{{ $category->name }}</label></a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                {{--
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked id="color-all">
                                <label class="custom-control-label" for="price-all">All Color</label>
                                <span class="badge border font-weight-normal">1000</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-1">
                                <label class="custom-control-label" for="color-1">Black</label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-2">
                                <label class="custom-control-label" for="color-2">White</label>
                                <span class="badge border font-weight-normal">295</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-3">
                                <label class="custom-control-label" for="color-3">Red</label>
                                <span class="badge border font-weight-normal">246</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-4">
                                <label class="custom-control-label" for="color-4">Blue</label>
                                <span class="badge border font-weight-normal">145</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="color-5">
                                <label class="custom-control-label" for="color-5">Green</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                        </form>
                    </div> --}}


                <!-- Color End -->

                <!-- Size Start -->

                {{-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" checked id="size-all">
                                <label class="custom-control-label" for="size-all">All Size</label>
                                <span class="badge border font-weight-normal">1000</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="size-1">
                                <label class="custom-control-label" for="size-1">XS</label>
                                <span class="badge border font-weight-normal">150</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="size-2">
                                <label class="custom-control-label" for="size-2">S</label>
                                <span class="badge border font-weight-normal">295</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="size-3">
                                <label class="custom-control-label" for="size-3">M</label>
                                <span class="badge border font-weight-normal">246</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="size-4">
                                <label class="custom-control-label" for="size-4">L</label>
                                <span class="badge border font-weight-normal">145</span>
                            </div>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-control-input" id="size-5">
                                <label class="custom-control-label" for="size-5">XL</label>
                                <span class="badge border font-weight-normal">168</span>
                            </div>
                        </form>
                    </div> --}}
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->

            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-toggle="dropdown">Sorting</button> --}}
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Ascending</a>
                                            <a class="dropdown-item" href="#">Descending</a>
                                            <a class="dropdown-item" href="#">Best Rating</a>
                                        </div> --}}
                                    <select name="" id="sortingOption" class="form-control">
                                        <option value="">Choose Options</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span id="dataList" class="row">
                        @if (count($pizzas) != 0)
                        @foreach ($pizzas as $pizza)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/' . $pizza->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details',$pizza->id)}}"><i
                                                class="fa-solid fa-circle-info"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $pizza->price }}</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @else
                        <h1 class="text-center bg-warning fs-5 text-white p-4 col-6 offset-3 ">There is no Pizzas</h1>
                        @endif

                    </span>

                </div>
            </div>


            <!-- Shop Product End -->
        </div>
    </div>

    {{-- SHOP END  --}}
@endsection

@section('scriptSource')
    <script>
        // $(document).ready(function(){
        //     $.ajax({
        //         type : 'get',
        //         url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
        //         dataType : 'json',//essential
        //         success : function(response){
        //             console.log(response)
        //         }
        //     })
        // });


        $('#sortingOption').change(function() {
            $eventOption = $('#sortingOption').val();

            if ($eventOption == 'asc') {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                    data : {'status' : 'asc'},
                    dataType: 'json', //essential
                    success: function(response) {
                           $list = '';
                           for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                           }
                           $('#dataList').html($list);

                    }
                })
            } else if ($eventOption == 'desc') {
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                    data : {'status' : 'desc'},
                    dataType: 'json', //essential
                    success: function(response) {
                        $list = '';
                           for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                            <div class="product-item bg-light mb-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 230px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-solid fa-circle-info"></i></a>
                                        {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                           }
                           $('#dataList').html($list);
                    }
                })
            }
        })
    </script>
@endsection
