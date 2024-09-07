@extends('admin.layouts.app')
@section('content')

<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Permission</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
        </ol>
    </div>

</div>

{{--  @if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif  --}}
<!-- Page Header Close -->

<!-- Start:: row-1 -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                   Add new
                </div>

            </div>
            <form class="form-horizontal" method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                @csrf
            <div class="card-body">

                <label for="basic-url" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>

                @enderror

                <label for="basic-url" class="form-label">Emial</label>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" value="{{old('email')}}" name="email" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('email')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>

                @enderror

                <label for="basic-url" class="form-label">Phone</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old('phone')}}" name="phone" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('phone')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>
                @enderror

                <div class="form-group ">
                    <div class="row row-sm">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="status">
                                <option disabled selected>Choose status...</option>
                                <option value="1">Active</option>
                                <option value="0">Unactive</option>
                            </select>

                        </div>
                    </div>
                </div>

                @error('status')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>
                @enderror


                <div class="form-group ">
                    <div class="row row-sm">
                        <div class="col-md-3">
                            <label class="form-label">Role</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="role" onchange="roleFunction()" id="role">
                                <option disabled selected>Choose role...</option>
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                              @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                @error('role')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>
                @enderror

                <label for="basic-url" class="form-label">Password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" value="{{old('password')}}" name="password" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('password')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>
                @enderror

                <label for="basic-url" class="form-label">Image</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" value="{{old('image')}}" name="image" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('image')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>
                @enderror



                <button class="form-control btn btn-primary">Create</button>
            </div>

        </div>
    </div>



    <!-- End:: row-3 -->


</div>
<!--APP-CONTENT CLOSE-->

@endsection
