@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Advertisement</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Advertisement</li>
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
            {{--  display: flex;
            flex-direction: column;
            align-items: flex-start;
            border: 1px solid #ddd;
            border-radius: 5px;  --}}
        }

        {{--  .item>* {
            margin-bottom: 10px;
        }

        .item button img {
            width: 20px;
            height: 20px;
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
        }  --}}
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
                <form class="form-horizontal" method="POST" action="{{ route('advertisements.update', $advertisement->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">

                        <label for="basic-url" class="form-label">Price</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $advertisement->price }}" name="price"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('price')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Start</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $advertisement->from }}" name="from"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('from')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">End</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $advertisement->to }}" name="to"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('to')
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
                                        <option @if ($advertisement->status == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if ($advertisement->status == '0') selected @endif value="0">
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
                                $translations = $advertisement->getTranslationsArray()[$localeCode];
                                @endphp
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $localeCode }}"
                                        role="tabpanel" aria-labelledby="tab-{{ $localeCode }}">
                                        <div class="form-group">
                                            <label for="title-{{ $localeCode }}">{{ __('Title') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ $translations['title'] }}"
                                                name="{{ $localeCode }}[title]" id="title-{{ $localeCode }}"
                                                class="form-control">
                                            @error("$localeCode.title")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address-{{ $localeCode }}">{{ __('Address') }} {{ $localeCode }}</label>
                                            <input type="text" value="{{ $translations['address'] }}"
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
                                                rows="5">{{ $translations['description'] }}</textarea>
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

    <script>
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
                        <div class="col-md-9">
                            <select class="form-select" name="language_id[]">
                                <option disabled selected>Choose languages...</option>
                                ${languages.map(language => `<option value="${language.id}">${language.name}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-5">
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-select" name="attribute[]" onchange="handleAttributeChange(this)">
                                <option disabled selected>{{ __('Choose Attribute...') }}</option>
                                <option value="name">{{ __('name') }}</option>
                                <option value="address">{{ __('address') }}</option>
                                <option value="description">{{ __('description') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control ckeditor" name="translate[]" id="basic-url" aria-describedby="basic-addon3"></input>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-12">
                            <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
                            <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newItem);

            ClassicEditor.create(newItem.querySelector('.ckeditor'))
                .catch(error => {
                    console.error(error);
                });
        }

        function removeItem(btn) {
            const item = btn.closest('.item');
            item.remove();
        }

        function handleAttributeChange(selectElement) {
            const item = selectElement.closest('.item');
            const translateContainer = item.querySelector('.form-group .row.row-sm .col-md-9');
            const translateInput = translateContainer.querySelector('input[name="translate[]"], textarea[name="translate[]"]');
            const attribute = selectElement.value;

            if (attribute === 'description' || attribute === 'address') {
                if (translateInput.tagName.toLowerCase() === 'input') {
                    const textarea = document.createElement('textarea');
                    textarea.className = 'form-control ckeditor';
                    textarea.name = 'translate[]';
                    textarea.id = 'basic-url';
                    textarea.ariaDescribedby = 'basic-addon3';
                    textarea.value = translateInput.value;
                    translateContainer.replaceChild(textarea, translateInput);

                    ClassicEditor.create(textarea)
                        .catch(error => {
                            console.error(error);
                        });
                }
            } else {
                if (translateInput.tagName.toLowerCase() === 'textarea') {
                    ClassicEditor.instances[translateInput.id].destroy()
                        .then(() => {
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control';
                            input.name = 'translate[]';
                            input.id = 'basic-url';
                            input.ariaDescribedby = 'basic-addon3';
                            input.value = translateInput.value;
                            translateContainer.replaceChild(input, translateInput);
                        });
                }
            }
        }
    </script>
@endsection
