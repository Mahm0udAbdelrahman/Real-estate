@extends('admin.layouts.app')
@section('content')

<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Update language</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">languages</li>
        </ol>
    </div>

</div>

@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
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
            <form class="form-horizontal" method="POST" action="{{ route("languages.update" , $language->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="card-body">


                <label for="basic-url" class="form-label">Name language</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{ $language->name}}" name="name"
                        id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('name')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror



               

                        <label for="basic-url" class="form-label">abbreviation</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $language->abbreviations}}" name="abbreviations"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('abbreviations')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



                        <label for="basic-url" class="form-label">flag</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control"  name="flag"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('flag')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>Choose status...</option>
                                        <option @if($language->status == '1') selected @endif value="1"> Active </option>
                                        <option @if($language->status == '0') selected @endif  value="0"> Unactive </option>

                                    </select>

                                </div>
                            </div>
                        </div>

                <button class="form-control btn btn-primary">Update</button>

            </div>

        </div>
    </div>



    <!-- End:: row-3 -->


</div>
<!--APP-CONTENT CLOSE-->

@endsection
