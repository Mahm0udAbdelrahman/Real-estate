@extends('admin.layouts.app')
@section('content')
<!--APP-CONTENT START-->

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h2 class="main-content-title fs-24 mb-1">Create Consulting Service Company</h2>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Consulting Service Companies</li>
        </ol>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@push('cs')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endpush
<style>
    .item {
        background-color: #f1f1f1;
        padding: 10px;
        margin-bottom: 10px;

            {
                {
                -- display: flex;
                flex-direction: column;
                align-items: flex-start;
                border: 1px solid #ddd;
                border-radius: 5px;
                --
            }
        }
    }

        {
            {
            -- .item>* {
                margin-bottom: 10px;
            }

            .item select,
            .item input[type="text"],
            .item textarea {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
                width: 100%;
            }

            .item a {
                margin-right: 10px;
                cursor: pointer;
            }

            
        }
    }

</style>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Page Header Close -->
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
            <form class="form-horizontal" method="POST" action="{{ route('ConsultingServiceCompany.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Specialty') }}</label>
                            </div>
                            <div class="col-md-9">

                                <select id="specialty" class="form-select" name="specialty_id">
                                    <option disabled selected>{{ __('Choose specialty...') }}</option>
                                    @foreach ($specialties as $specialty)
                                    <option @selected(old('specialty_id')==$specialty->id) value="{{ $specialty->id }}">
                                        {{ App::getLocale() == 'en' ? $specialty->getTranslationsArray()['en']['name'] : $specialty->getTranslationsArray()['ar']['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('specialty_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror




                    <div class="form-group ">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('Subspecialty') }}</label>
                            </div>
                            <div class="col-md-9">

                                <select id="subspecialty" class="form-select js-example-basic-multiple" name="subspecialty_id[]" multiple>
                                    <option disabled>{{ __('Choose Subspecialty...') }}</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    @error('subspecialty_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror


                    <label for="basic-url" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('email')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">Phone</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('phone')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror




                    <label for="basic-url" class="form-label">Location</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('location') }}" name="location" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('location')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">Number Of Employees</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('number_of_employees') }}" name="number_of_employees" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_employees')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">Number Of Branches</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('number_of_branches') }}" name="number_of_branches" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('number_of_branches')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror

                    <label for="basic-url" class="form-label">Number Of Experience</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ old('year_of_experience') }}" name="year_of_experience" id="basic-url" aria-describedby="basic-addon3">
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


                    <label for="basic-url" class="form-label">chamber_of_commerce_certificate</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ old('chamber_of_commerce_certificate') }}" name="chamber_of_commerce_certificate" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('chamber_of_commerce_certificate')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <label for="basic-url" class="form-label">company_profile</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" value="{{ old('company_profile') }}" name="company_profile" id="basic-url" aria-describedby="basic-addon3">
                    </div>
                    @error('company_profile')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror


                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Heart</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="heart">
                                    <option disabled selected>Choose heart...</option>
                                    <option value="not_favorite">Not Favorite</option>
                                    <option value="favorite">Favorite</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('heart')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror









                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="status">
                                    <option disabled selected>Choose status...</option>
                                    <option value="not_favorite">Active</option>
                                    <option value="0">Unactive</option>
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
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $localeCode }}" data-toggle="tab" href="#pane-{{ $localeCode }}" role="tab" aria-controls="pane-{{ $localeCode }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $properties['native'] }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}" role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                <div class="form-group">
                                    <label for="name-{{ $localeCode }}">{{ __('Company Name') }}
                                        {{ $localeCode }}</label>
                                    <input type="text" value="{{ old($localeCode . '.company_name') }}" name="{{ $localeCode }}[company_name]" id="name-{{ $localeCode }}" class="form-control">
                                    @error("$localeCode.company_name")
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bio-{{ $localeCode }}">{{ __('Bio') }}
                                        {{ $localeCode }}</label>
                                    <textarea name="{{ $localeCode }}[bio]" id="bio-{{ $localeCode }}" class="form-control ck-editor" rows="5">{{ old($localeCode . '.bio') }}</textarea>
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
</div>
<!--APP-CONTENT CLOSE-->


{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  --}}
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
                url: '/admin/get-subspecialties/' + specialtyId
                , type: 'GET'
                , success: function(data) {
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
