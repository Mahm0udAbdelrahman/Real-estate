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

        .item > * {
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

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">{{ __('Update contractor company project') }}</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('contractor company projects') }}</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('contractor_company_projects.update' , $project->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">


                        <div class="form-group">
                            <label for="logo" class="form-label">{{ __('Logo') }}</label>
                            <input type="file" class="form-control" value="{{ old('logo') }}" name="logo" id="logo"
                                aria-describedby="logoHelp">
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">{{ __('Image') }}</label>
                            <input type="file" class="form-control" value="{{ old('image') }}" name="image[]" id="image"
                                aria-describedby="imageHelp" multiple>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date" class="form-label">{{ __('Publish Date') }}</label>
                            <input type="date" class="form-control" value="{{ $project->date }}" name="date" id="date"
                                aria-describedby="dateHelp" >
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Status') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select" name="status">
                                        <option disabled selected>{{ __('Choose Status...') }}</option>
                                        <option @if ($project->status == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if ($project->status == '0') selected @endif value="0">
                                            {{ __('Unactive') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

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
                                $translations = $project->getTranslationsArray()[$localeCode] ?? [];
                                @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="title-{{ $localeCode }}">{{ __('Title') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ $translations['title'] ?? '' }}"
                                                name="{{ $localeCode }}[title]" id="title-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.title")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="content-{{ $localeCode }}">{{ __('Content') }} {{ $localeCode }}</label>
                                            <textarea name="{{ $localeCode }}[content]"
                                                id="content-{{ $localeCode }}" class="form-control ck-editor"
                                                rows="5">{{ $translations['content'] ??'' }}</textarea>
                                            @error("$localeCode.content")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-create">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End:: row-1 -->

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
