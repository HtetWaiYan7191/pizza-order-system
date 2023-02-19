@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('categorySuccess'))
                        {{-- BOOTSTRAP ALERT BOX  --}}
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('categorySuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        {{-- BOOTSTRAP ALERT BOX END  --}}
                    @endif

                    @if (session('productDelete'))
                        {{-- BOOTSTRAP ALERT BOX  --}}
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('productDelete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        {{-- BOOTSTRAP ALERT BOX END  --}}
                    @endif

                    {{-- SEARCH BOX START --}}
                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search key: <span class="text-success">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('products#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search"
                                        value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- SEARCH BOX END --}}

                    {{-- TOTAL BOX START  --}}
                    <div class="row">
                        <div class="col-5">
                            <h3 class=""><i class="fa-solid fa-database "></i> <span>Total -
                                    {{ $pizzas->total() }}</span>
                            </h3>
                        </div>
                    </div>
                    {{-- TOTAL BOX END --}}

                    {{-- UPDATE SUCCESS BOX START --}}
                    @if (session('updateSuccess'))
                        {{-- BOOTSTRAP ALERT BOX  --}}
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        {{-- BOOTSTRAP ALERT BOX END  --}}
                    @endif
                    {{-- UPDATE SUCCESS BOX END --}}

                    <div class="table-responsive table-responsive-data2">

                        @if (count($pizzas) != 0)
                            {{-- LIST TABLE START  --}}
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>Description</th>
                                        <th>PRICE</th>
                                        <th>CATEGORY</th>
                                        <th>View Count</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow my-2">
                                            <td class="col-2 img-thumbnail shadow-sm"><img
                                                    src="{{ asset('storage/' . $pizza->image) }}" alt=""></td>
                                            <td class="col-2">
                                                <span class="">{{ $pizza->name }}</span>
                                            </td>
                                            <td class="col-2 ">{{ $pizza->description }}</td>
                                            <td class="col-2">{{ $pizza->price }}</td>
                                            <td class="col-2">{{ $pizza->category_name }}</td>
                                            <td class="col-2"><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }}
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Send">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </button>
                                                    <a href="{{ route('products#edit', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#delete', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('products#view',$pizza->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- LIST TABLE END  --}}
                        @else
                            <h1 class=" text-secondary text-center">There is no data</h1>

                        @endif


                        {{-- PAGINATOR UI START --}}

                        <div class="mt-3">
                            {{ $pizzas->links() }}
                        </div>

                        {{-- PAGINATOR UI END  --}}
                    </div>



                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
