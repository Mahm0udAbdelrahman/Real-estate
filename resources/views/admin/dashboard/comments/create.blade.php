@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->
    @php
        $session = session()->get('locale');
        $lang = App\Models\Language::where('abbreviations', $session)->first();
    @endphp

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
                <form class="form-horizontal" method="POST" action="{{ route('comments.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Country') }}</label>
                                </div>
                                <div class="col-md-9">

                                    <select class="form-select" name="language_id">
                                        <option disabled selected>{{ __('Choose Country...') }}</option>
                                        @foreach ($languages as $language)
                                            <option @selected(old('language_id')==$language->id ) value="{{ $language->id }}">
                                                {{ $language->name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                        </div>
                        @error('language_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <textarea name="description" id="" class="form-control" rows="5"></textarea>




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
                            <span class="text-danger">{{ $message }}</span>
                        @enderror












                        <button class="form-control btn btn-primary">Create</button>

                    </div>
                </form>

            </div>
        </div>



        <!-- End:: row-3 -->


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
                            <select class="form-select" name="attribute[]">
                                                    <option disabled selected>Choose status...</option>
                                                    <option value="name">name</option>
                                                    <option value="description">description</option>

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
                            <input type="text" class="form-control" value="{{ old('translate') }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                </div>
                <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
            `;
            container.appendChild(newItem);
        }

        function removeItem(btn) {
            const item = btn.parentNode;
            item.parentNode.removeChild(item);
        }
    </script>
@endsection
