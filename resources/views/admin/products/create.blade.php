@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Pizza</h3>
                            </div>
                            <hr>

                            {{-- create your pizza start  --}}
                            <form action="{{ route('products#create') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text"
                                        class="form-control @error('name') is-invalid

                                    @enderror "
                                        aria-required="true" aria-invalid="false" placeholder="Pizza">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select name="category"
                                        class="form-control @error('category') is-invalid

                                    @enderror"
                                        >
                                        <option value="">Choose Your Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" name="category" >{{ $category->name }}</option>
                                        @endforeach

                                    </select>

                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea id="" cols="30" rows="10" name="description"
                                        class="form-control @error('description') is-invalid

                                    @enderror"
                                        ></textarea>

                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid

                                    @enderror"
                                        >

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Price</label>
                                    <input type="number" placeholder="Price"
                                        class="form-control @error('price') is-invalid

                                    @enderror"
                                        name="price">

                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Waiting Time</label>
                                    <input type="number" placeholder="Waiting Time"
                                        class="form-control @error('price') is-invalid

                                    @enderror"
                                        name="waitingTime">

                                    @error('waitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                            {{-- create your pizza end  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
