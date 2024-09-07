@extends('admin.layouts.app')
@section('content')

<!--APP-CONTENT START-->


<!-- Page Header -->

<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Role</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
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
            <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                @csrf
            <div class="card-body">

                <label for="basic-url" class="form-label">Name</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="basic-url" aria-describedby="basic-addon3">
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert">{{ $message}}</div>

                @enderror

                <div class="row row-cols-4 row-sm">
                    @foreach ($permissions as $permission)
                    <div class="col">
                        <div class="card custom-card" style="height: 200px;">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    {{ $permission->type }}
                                </div>

                            </div>
                            <div class="card-body">
                                @foreach (DB::table('permissions')->where('type', $permission->type)->get() as $p)
                                    <div class="form-check mb-0">
                                        <input class="form-check-input form-checked-dark" type="checkbox"
                                            value="{{$p->name}}" id="darkChecked" name="permissions_id[]">
                                        <label class="form-check-label" for="darkChecked">
                                            {{$p->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                    @endforeach
                </div>



                <button class="form-control btn btn-primary">Create</button>
            </div>

        </div>
    </div>



    <!-- End:: row-3 -->


</div>
<!--APP-CONTENT CLOSE-->

@endsection
