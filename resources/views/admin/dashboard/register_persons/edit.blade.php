@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Update registerPerson</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">registerPersons</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('register_persons.update', $registerPerson->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">


                        <label for="basic-url" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" value="{{ old('email',$registerPerson->email) }}" name="email" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">Gender</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="gender">
                                        <option disabled selected>Choose status...</option>
                                        <option @if(old('gender',$registerPerson->gender) == 'male') selected @endif value="male">Male</option>
                                        <option @if (old('gender',$registerPerson->gender) == 'female') selected @endif value="female" value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Age</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('age',$registerPerson->age) }}" name="age" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('age')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror






                        <label for="basic-url" class="form-label">image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ $registerPerson->image }}" name="image"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('image')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Phone</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('phone',$registerPerson->phone) }}" name="phone" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>{{ __('Choose Status...') }}</option>
                                        <option @if (old('status',$registerPerson->status) == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if (old('status',$registerPerson->status) == '0') selected @endif value="0">
                                            {{ __('Unactive') }}
                                        </option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <div class="card hk-dash-type-1 overflow-hidden">
                            <div class="card-header pa-0">
                                <div class="nav nav-tabs nav-light nav-justified" id="dash-tab" role="tablist">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="tab-{{ $localeCode }}" data-toggle="tab" href="#pane-{{ $localeCode }}"
                                            role="tab" aria-controls="pane-{{ $localeCode }}"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @php
                                        $translations = $registerPerson->getTranslationsArray()[$localeCode] ?? [];
                                    @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="first_name-{{ $localeCode }}">{{ __('First Name') }} {{ $localeCode }}</label>
                                            <input type="text"
                                                value="{{ $translations['first_name'] ?? '' }}"
                                                name="{{ $localeCode }}[first_name]"
                                                id="first_name-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.first_name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name-{{ $localeCode }}">{{ __('Last Name') }} {{ $localeCode }}</label>
                                            <input type="text"
                                                value="{{ $translations['last_name'] ?? '' }}"
                                                name="{{ $localeCode }}[last_name]"
                                                id="last_name-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.last_name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <button class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- End:: row-3 -->


    </div>
    <!--APP-CONTENT CLOSE-->





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Initialize CKEditor for all textareas with class 'ck-editor'
        ClassicEditor
            .create(document.querySelectorAll('.ck-editor'))
            .catch(error => {
                console.error(error);
            });
    </script>






@endsection
