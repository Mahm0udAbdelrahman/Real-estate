@extends('admin.layouts.app')

@section('content')
    <!--APP-CONTENT START-->
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
        .item input[type="text"],
        .ck-editor__editable_inline {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .nav-tabs .nav-item .nav-link {
            font-size: 18px;
            padding: 10px 20px;
            color: #555;
        }

        .nav-tabs .nav-item .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .nav-tabs .nav-item .nav-link:hover {
            background-color: #0056b3;
            color: white;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
        }

        .ck-editor__editable {
            min-height: 200px;
            max-width: 100%;
            font-size: 16px;
        }

        .btn-create {
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }
    </style>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">{{ __('Create Supplier') }}</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Suppliers') }}</li>
            </ol>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start:: row-1 -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ __('Add New') }}
                    </div>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('suppliers.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Country') }}</label>
                                </div>
                                <div class="col-md-9">

                                    <select id="country" class="form-select" name="country_id">
                                        <option disabled selected>{{ __('Choose Country...') }}</option>
                                        @foreach ($countries as $country)
                                            <option @selected(old('country_id') == $country->id) value="{{ $country->id }}">
                                                {{ App::getLocale() == 'en' ? $country->getTranslationsArray()['en']['name'] : $country->getTranslationsArray()['ar']['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('City') }}</label>
                                </div>
                                <div class="col-md-9">

                                    <select id="city" class="form-select" name="city_id">
                                        <option disabled selected>{{ __('Choose Country...') }}</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="basic-url" class="form-label">Location</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('location') }}" name="location"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('location')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror




                        <label for="basic-url" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('email')
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



                        <label for="basic-url" class="form-label">Year Of Experience</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('year_of_experience') }}" name="year_of_experience"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('year_of_experience')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Supplied Material</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('supplied_material') }}" name="supplied_material"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('supplied_material')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror




                        <label for="basic-url" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('image') }}" name="image"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('image')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror







                        <div class="form-group">
                            <div class="row">
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
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="name-{{ $localeCode }}">{{ __('Company Name') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ old($localeCode . '.name') }}"
                                                name="{{ $localeCode }}[name]" id="name-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-create">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End:: row-1 -->

    <!--APP-CONTENT CLOSE-->

    <script>
    $(document).ready(function() {
        $('#country').change(function() {
            var countryId = $(this).val();
            $.ajax({
                url: '/admin/get-cities/' + countryId,
                type: 'GET',
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $('#city').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });
                }
            });
        });
    });
</script>
    {{--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  --}}
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
