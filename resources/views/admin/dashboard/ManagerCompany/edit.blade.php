@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Update Register  ManagerCompany</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register  ManagerCompany</li>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Start:: row-1 -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Add new
                    </div>

                </div>
                <form class="form-horizontal" method="post" action="{{ route('ManagerCompany.update', $registerManagerCompany->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Specialty') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="specialty" class="form-select" name="specialty_id">
                                        <option disabled selected>{{ __('Choose Specialty...') }}</option>
                                        @foreach ($specialties as $specialty)
                                            <option @selected($registerManagerCompany->specialty_id == $specialty->id) value="{{ $specialty->id }}">
                                                {{ App::getLocale() == 'en' ? $specialty->getTranslationsArray()['en']['name'] : $specialty->getTranslationsArray()['ar']['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('specialty_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>





                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Subspecialty') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select id="subspecialty" class="form-select js-example-basic-multiple"
                                        name="subspecialty_id[]" multiple>
                                        <option disabled>{{ __('Choose Subspecialty...') }}</option>
                                        @foreach ($subs as $subspecialty)
                                            <option
                                                @foreach ($companySubs as $cs) @if ($subspecialty->subspecialty_id == $cs->subspecialty_id) selected @endif @endforeach
                                                value="{{ $subspecialty->id }}">
                                                {{ $subspecialty->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('subspecialty_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror








                        <label for="basic-url" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" value="{{ $registerManagerCompany->email }}" name="email" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Phone</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $registerManagerCompany->phone }}" name="phone" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror




                        <label for="basic-url" class="form-label">Location</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $registerManagerCompany->location }}" name="location" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('location')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">Number Of Employees</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $registerManagerCompany->number_of_employees }}" name="number_of_employees" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('number_of_employees')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">Number Of Branches</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $registerManagerCompany->number_of_branches }}" name="number_of_branches" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('number_of_branches')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Year Of Experience</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $registerManagerCompany->year_of_experience }}" name="year_of_experience" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('year_of_experience')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">commercial_registration_certificate</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('commercial_registration_certificate') }}" name="commercial_registration_certificate" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('commercial_registration_certificate')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">vat_certificate</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('vat_certificate') }}" name="vat_certificate" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('vat_certificate')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">social_insurance_certificate</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('social_insurance_certificate') }}" name="social_insurance_certificate" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('social_insurance_certificate')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">Number Of Employees</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('chamber_of_commerce_certificate') }}" name="chamber_of_commerce_certificate" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('chamber_of_commerce_certificate')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">Number Of Branches</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('company_profile') }}" name="company_profile" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('company_profile')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('heart') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="heart">
                                        <option disabled selected>{{ __('Choose heart...') }}</option>
                                        <option @if ($registerManagerCompany->heart == 'not_favorite') selected @endif value="not_favorite">
                                            {{ __('Not Favorite') }}
                                        </option>
                                        <option @if ($registerManagerCompany->heart == 'favorite') selected @endif value="favorite">
                                            {{ __('Favorite') }}
                                        </option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('heart')
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
                                        <option @if ($registerManagerCompany->status == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if ($registerManagerCompany->status == '0') selected @endif value="0">
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
                                $translations = $registerManagerCompany->getTranslationsArray()[$localeCode] ?? [];
                                @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="company_name-{{ $localeCode }}">{{ __('company_name') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ $translations['company_name'] ?? '' }}"
                                                name="{{ $localeCode }}[company_name]" id="company_name-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.company_name")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bio-{{ $localeCode }}">{{ __('Bio') }} {{ $localeCode }}</label>
                                            <textarea name="{{ $localeCode }}[bio]"
                                                id="bio-{{ $localeCode }}" class="form-control ck-editor"
                                                rows="5">{{ $translations['bio'] ?? '' }}</textarea>
                                            @error("$localeCode.bio")
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
    <script>
        $(document).ready(function() {
            $('#specialty').change(function() {
                var specialtyId = $(this).val();
                $.ajax({
                    url: '/admin/get-subspecialties/' + specialtyId,
                    type: 'GET',
                    success: function(data) {
                        $('#subspecialty').empty();
                        $('#subspecialty').append(
                            '<option value="">Select subspecialty</option>');
                        $.each(data, function(key, value) {
                            $('#subspecialty').append('<option value="' + value.id +
                                '">' +
                                value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>







@endsection
