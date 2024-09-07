@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Advertisement</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Advertisements</li>
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
            {{-- display: flex;
             align-items: flex-start; /* Adjusted alignment */
            flex-wrap: wrap; /* Allow items to wrap */  --}}
        }

        {{--  .item > * {
            margin-right: 10px;
            margin-bottom: 10px; /* Added margin bottom */
        }

        .item button img {
            width: 20px;
            height: 20px;
        }

        .item select,
        .item input[type="text"],
        .item textarea {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .item .form-group {
            width: calc(50% - 5px); /* Adjust width to fit two items side by side */
        }

        .item .form-group:nth-child(2n+1) {
            margin-right: 10px; /* Add margin between language and attribute */
        }

        .item .form-group:last-child {
            width: 100%; /* Make translate input full width */
        }  --}}
    </style>

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
                <form class="form-horizontal" method="POST" action="{{ route('advertisements.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <label for="basic-url" class="form-label">Price</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('price') }}" name="price"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('price')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Start</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ old('from') }}" name="from"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('from')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">End</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ old('to') }}" name="to"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('to')
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
                                        <option value="1">Active</option>
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
                                            <label for="title-{{ $localeCode }}">{{ __('Title') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ old($localeCode . '.title') }}"
                                                name="{{ $localeCode }}[title]" id="title-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.title")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address-{{ $localeCode }}">{{ __('Address') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ old($localeCode . '.address') }}"
                                                name="{{ $localeCode }}[address]" id="address-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.address")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description-{{ $localeCode }}">{{ __('Description') }} {{ $localeCode }}</label>
                                            <textarea name="{{ $localeCode }}[description]"
                                                id="description-{{ $localeCode }}" class="form-control ck-editor"
                                                rows="5">{{ old($localeCode . '.description') }}</textarea>
                                            @error("$localeCode.description")
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
    {{--  <script>
        const languages = @json($languages); // Assuming $languages is available as a JSON variable

        function addItem() {
            const container = document.getElementById("container");
            const newItem = document.createElement("div");
            newItem.className = "item";
            newItem.innerHTML = `
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Language</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" name="language_id[]">
                                <option disabled selected>Choose languages...</option>
                                <!-- Render language options here -->
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-7">
                            <select class="form-select" name="attribute[]" onchange="handleAttributeChange(this)">
                                <option disabled selected>Choose status...</option>
                                <option value="name">name</option>
                                <option value="address">address</option>
                                <option value="description">description</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-7">
                            <input class="form-control" name="translate[]"></input>
                        </div>
                    </div>
                </div>
                <a href="#" onclick="removeItem(this); return false;"><i class="fa-solid fa-minus"></i></a>
                <a href="#" onclick="addItem(); return false;"><i class="fa-solid fa-plus"></i></a>
            `;
            container.appendChild(newItem);

            // Initialize CKEditor for the new textarea

        }

        function removeItem(btn) {
            const item = btn.closest('.item');
            item.remove();
        }

        function handleAttributeChange(selectElement) {
            const translateInput = selectElement.closest('.item').querySelector('input[name="translate[]"]');
            const translateTextarea = selectElement.closest('.item').querySelector('textarea[name="translate[]"]');

            if (selectElement.value === 'description' || selectElement.value === 'address') {
                if (translateInput) {
                    const textarea = document.createElement('textarea');
                    textarea.name = 'translate[]';
                    textarea.className = 'form-control ckeditor';
                    translateInput.replaceWith(textarea);
                    // Initialize CKEditor for the new textarea
                    ClassicEditor
                        .create(textarea)
                        .catch(error => {
                            console.error(error);
                        });
                }
            } else {
                if (translateTextarea) {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'translate[]';
                    input.className = 'form-control';
                    translateTextarea.replaceWith(input);
                }
            }
        }
    </script>  --}}

@endsection
