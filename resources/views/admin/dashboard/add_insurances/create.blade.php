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
            <h2 class="main-content-title fs-24 mb-1">Create Add Insurance </h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Insurances</li>
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
        .btn-container {
            display: flex;
            gap: 10px; /* يمكنك تعديل هذا القيم لتغيير المسافة بين الأزرار */
        }

        .btn-container .form-control {
            flex: 1; /* هذا يضمن أن الأزرار تأخذ نفس العرض */
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
                <form class="form-horizontal" method="POST" action="{{ route('add_insurances.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">


                        <div class="form-group ">
                            <div class="row row-sm">
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('Add insurances') }}</label>
                                </div>
                                <div class="col-md-9">

                                    <select class="form-select" name="insurance_id">
                                        <option disabled selected>{{ __('Choose insurance...') }}</option>
                                        @foreach (DB::table('translations')->where('language_id', $lang->id)->where('model_type', 'Insurance')->where('attribute','name')->get() as $insurance)
                                            @if ($insurance->model_type == 'Insurance')
                                                <option value="{{ $insurance->model_id }}">{{ $insurance->translate }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('insurance_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="basic-url" class="form-label">Birthday</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ old('birthday') }}" name="birthday"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('birthday')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">Insurance number</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ old('insurance_card_number') }}" name="insurance_card_number"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('insurance_card_number')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        <label for="basic-url" class="form-label">Insurance expiry date</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" value="{{ old('insurance_expiry_date') }}" name="insurance_expiry_date"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('insurance_expiry_date')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror


                        <label for="basic-url" class="form-label">image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ old('image') }}" name="image"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('image')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror



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


                        <div id="container">
                            <div class="item">
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <label class="form-label">Language</label>
                                        </div>
                                        <div class="col-md-9">
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
                                @error('language_id')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <label class="form-label">Attribute</label>
                                        </div>
                                        <div class="col-md-9">

                                            <select class="form-select" name="attribute[]">
                                                <option disabled selected>Choose status...</option>
                                                <option value="name">name</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @error('attribute')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror

                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-4">
                                            <label class="form-label">Translate</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="{{ old('translate') }}"
                                                name="translate[]" id="basic-url" aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>
                                @error('translate')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror

                                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>










                        <div class="btn-container">
                            <button class="form-control btn btn-primary">Create</button>
                            <button class="form-control btn btn-primary">Skip</button>
                        </div>

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
