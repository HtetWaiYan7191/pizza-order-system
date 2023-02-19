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
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-3 offset-4">
                                        <h3 class="text-center ">Change Role</h3>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <form action=" {{ route('admin#changeRole', $accounts->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($accounts->image == null)
                                            <img src="{{ asset('image/defaultUser.png') }}"
                                                class=" img-thumbnail shadow-sm " alt="">
                                        @else
                                            <img src="{{ asset('storage/'.$accounts->image) }}" alt="">
                                        @endif


                                        <div class="mt-3">
                                            <button class=" btn bg-dark text-white  col-12"><i
                                                    class="fa-solid fa-chevron-right mr-2" type="submit"></i>
                                                Change</button>
                                        </div>




                                    </div>

                                    <div class="col-6">
                                        {{-- <div>
                                            <div class="">
                                                <input type="file" class="form-control">
                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled  name="name" type="text"
                                                class="form-control @error('name') is-invalid

                                            @enderror"
                                                value="{{ $accounts->name }}" aria-required="true" aria-invalid="false"
                                                placeholder="UserName">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1 ">Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="admin"  @if ($accounts->role == 'admin') selected

                                                @endif class="form-control">Admin</option>
                                                <option value="user"  @if ($accounts->role == 'user') selected

                                                @endif class="form-control">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled  name="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $accounts->email }}" aria-required="true" aria-invalid="false"
                                                placeholder="email@address.com">

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror"  disabled id="">
                                                <option value="male" @if ($accounts->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($accounts->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>

                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" disabled  type="text"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ $accounts->phone }}" aria-required="true" aria-invalid="false"
                                                placeholder="09*********">

                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address"  disabled id="" cols="30" rows="10"
                                                class="form-control @error('address') is-invalid @enderror">{{ $accounts->address }}</textarea>

                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
