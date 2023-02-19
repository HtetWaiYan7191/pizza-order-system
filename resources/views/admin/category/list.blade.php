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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#create') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
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

                    @if (session('categoryDelete') && count($categories) == 1)
                        {{-- BOOTSTRAP ALERT BOX  --}}
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i> {{ session('categoryDelete') }}
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
                            <form action="{{ route('category#list') }}" method="GET">
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
                            <h3 class=""><i class="fa-solid fa-database "></i> <span>{{ $categories->total() }}</span>
                            </h3>
                        </div>
                    </div>
                    {{-- TOTAL BOX END --}}
                    <div class="table-responsive table-responsive-data2">
                        @if (count($categories) != 0)

                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CATEGORY NAME</th>
                                        <th>CREATED DATE</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow my-2">
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <span class="">{{ $category->name }}</span>
                                            </td>
                                            <td class="">{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Send">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </button>
                                                    <a href="{{route('category#edit',$category->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                            {{-- PAGINATOR UI START --}}

                            <div class=" mt-3">
                                {{ $categories->links() }}
                                {{-- {{$categories->appends(request()->query())->links()}} --}}
                            </div>

                            {{-- PAGINATOR UI END  --}}
                    </div>
                @else
                    <h1 class=" text-secondary text-center">There is no data</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
