@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Booking</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bookings</li>
            </ol>
        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .item>* {
            margin-right: 10px;
        }

        .item button img {
            width: 20px;
            height: 20px;
        }

        .item select,
        .item input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>







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
                <form class="form-horizontal" method="POST" action="{{ route('bookings.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">




                        <label for="basic-url" class="form-label">Date</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ old('date') }}" name="date"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">End Time</label>
                        <div class="input-group mb-3">
                            <input type="time" class="form-control" value="{{ old('time') }}" name="time"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('time')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">Type</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="type">
                                        <option disabled selected>Choose type...</option>
                                        <option value="call">Call</option>
                                        <option value="video_call">Video Call</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('type')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



                        <label for="basic-url" class="form-label">Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Phone</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('phone')
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
                                        <option value="1">Active</option>
                                        <option value="0">Unactive</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



                        <button class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- End:: row-3 -->


    </div>
    </div>
    <!--APP-CONTENT CLOSE-->






@endsection
