@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="#"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center ">Edit Your Pizzas</h3>
                            </div>

                             {{-- BACK BUTTON START  --}}
                             <button>
                                <div class="card-title ms-5" onclick="history.back()">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </div>
                            </button>

                            {{-- BACK BUTTON END  --}}
                            <hr>
                            <form action="{{ route('products#update') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-4 offset-1">
                                        {{-- IMAGE AND UPDATE PHOTO --}}
                                        <div class="form-group">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                            <input type="file" class="form-control mt-3 @error('image') is-invalid @enderror"
                                                name="image" value="{{ old('image', $product->image) }}">

                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Update</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $product->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Seafood...">

                                            <input type="hidden" value="{{ $product->id }}" name="id">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Category</label>
                                            <select name="category" id=""
                                                class="form-control @error('category') is-invalid @enderror">
                                                <option value="" name="" class="form-control">Chooese Category
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected

                                                    @endif name="category"
                                                        class="form-control">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Description</label>
                                            <textarea name="description" id="" cols="30" rows="10"
                                                class="form-control @error('description') is-invalid @enderror" value="" placeholder="Description">{{ old('description', $product->description) }}</textarea>

                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Price</label>
                                            <input type="number" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price', $product->price) }}"placeholder="****">

                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Waiting Time</label>
                                            <input type="number" value="{{ old('waitingTime', $product->waiting_time) }}"
                                                name="waitingTime" id=""
                                                class="form-control @error('waitingTime') is-invalid

                                            @enderror">

                                            @error('waitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">View Count</label>
                                            <input type="number" disabled value="{{old('viewCount',$product->view_count)}}" name="viewCount" class="form-control" >
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Created Date</label>
                                            <input type="text" name="created_at" value="{{$product->created_at->format('j F Y')}}" disabled class="form-control" >
                                        </div>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
