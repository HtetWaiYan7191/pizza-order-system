@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="card-title">
                                <h3 class="text-center ">Account Info</h3>
                            </div> --}}
                            {{-- BACK BUTTON START  --}}
                            <button>
                                <div class="card-title ms-5" onclick="history.back()">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </div>
                            </button>

                            {{-- BACK BUTTON END  --}}
                            <div class="row">
                                <div class="col-12">
                                    @if (session('updateSuccess'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('updateSuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">

                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                    {{-- edit button --}}
                                    <div class="mt-3 rounded">
                                        <a href="{{ route('products#edit',$product->id) }}">
                                            <button class="text-white btn bg-dark">
                                                <i class="fa-solid fa-pen-to-square mr-3"></i> Edit Pizza
                                            </button>
                                        </a>
                                    </div>
                                    {{-- edit button end  --}}
                                </div>

                                <div class="col-5 offset-1">
                                    <h4 class="text-danger  "><i class="fa-solid fa-pizza-slice text-danger mr-4"></i> {{$product->name}}
                                    </h4>
                                    <h4 class=" my-4 "><i class="fa-solid fa-money-bill  mr-4"></i> {{$product->price}} Kyats</h4>
                                    <h4 class=" my-4 "><i class="fa-solid fa-clock mr-4"></i> {{$product->waiting_time}} mins</h4>
                                    <h4 class=" my-4 "><i class="fa-solid fa-eye mr-4"></i> {{$product->view_count}}</h4>
                                    <h4 class=" my-4 "><i class="fa-solid fa-database mr-4"></i> {{$product->category_name}}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-message mr-4"></i><span>Description</span>
                                     </h4><span class="text-secondary">{{$product->description}}</span>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
