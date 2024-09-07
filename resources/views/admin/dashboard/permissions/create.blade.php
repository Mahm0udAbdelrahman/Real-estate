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
            <form class="form-horizontal" method="POST" action="{{ route('permissions.store') }}">
                @csrf
            <div class="card-body">

                <label for="basic-url" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>

                @enderror

                <label for="basic-url" class="form-label">Type</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old('type')}}" name="type" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('type')
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
