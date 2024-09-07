@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Citity </h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Countries</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('institutions.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Country') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="country_id">
                                        <option disabled selected>{{ __('Choose Country...') }}</option>
                                        @foreach ($countries as $country)
                                            <option value={{ $country->id }}>{{ $country->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror





                        {{--  @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Name Institution') }}
                                {{ $localeCode }}</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ old('name_institution') }}"
                                    name="{{ $localeCode }}[name_institution]" id="basic-url{{ $localeCode }}"
                                    aria-describedby="basic-addon3-{{ $localeCode }}">
                            </div>
                            @error("{{ $localeCode }}[name_institution]")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach  --}}

                        <label for="basic-url" class="form-label">{{ __('Phone') }}</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Address') }}
                                {{ $localeCode }}</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ old('address') }}"
                                    name="{{ $localeCode }}[address]" id="basic-url{{ $localeCode }}"
                                    aria-describedby="basic-addon3-{{ $localeCode }}">
                            </div>
                            @error("{{ $localeCode }}[address]")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Name Administrator') }}
                                {{ $localeCode }}</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ old('name_administrator') }}"
                                    name="{{ $localeCode }}[name_administrator]" id="basic-url{{ $localeCode }}"
                                    aria-describedby="basic-addon3-{{ $localeCode }}">
                            </div>
                            @error("{{ $localeCode }}[name_administrator]")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Description') }}
                                {{ $localeCode }}</label>
                            <div class="input-group mb-3">
                                <textarea type="text" class="form-control" value=""
                                    name="{{ $localeCode }}[description]" id="basic-url{{ $localeCode }}"
                                    aria-describedby="basic-addon3-{{ $localeCode }}">{{ old('description') }}</textarea>
                            </div>
                            @error("{{ $localeCode }}[description]")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Description') }}
                            {{ $localeCode }}</label>
                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control" value=""
                                name="{{ $localeCode }}[description]" id="basic-url{{ $localeCode }}"
                                aria-describedby="basic-addon3-{{ $localeCode }}">{{ old('description') }}</textarea>
                        </div>
                        @error("{{ $localeCode }}[description]")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endforeach







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
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                    role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                    <div class="form-group">
                                        <label for="basic-url{{ $localeCode }}" class="form-label">{{ __('Name') }}
                                            {{ $localeCode }}</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="{{ old('name_institution') }}"
                                                name="{{ $localeCode }}[name_institution]" id="basic-url{{ $localeCode }}"
                                                aria-describedby="basic-addon3-{{ $localeCode }}">
                                        </div>
                                        @error("{{ $localeCode }}[name_institution]")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="content-{{ $localeCode }}">{{ __('Content') }} {{ $localeCode }}</label>
                                        <textarea name="{{ $localeCode }}[content]"
                                            id="content-{{ $localeCode }}" class="form-control ck-editor"
                                            rows="5">{{ old($localeCode . '.content') }}</textarea>
                                        @error("$localeCode.content")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>




                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>{{ __('Choose Status...') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Unactive') }}</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror



                        <button class="form-control btn btn-primary">{{ __('Create') }}</button>
                    </div>

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
