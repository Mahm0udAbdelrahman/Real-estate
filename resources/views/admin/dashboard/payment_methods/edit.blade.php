@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->


    <!-- Page Header -->

    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create payment-methods</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">payment-methods</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('payment-methods.update', $paymentMethod->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">


                        <label for="basic-url" class="form-label">Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{  $paymentMethod->name }}" name="name" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror











                        <label for="basic-url" class="form-label">image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" value="{{ $paymentMethod->image }}" name="image"
                                id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        @error('image')
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
                                        <option @if ($paymentMethod->status == '1') selected @endif value="1">
                                            {{ __('Active') }}
                                        </option>
                                        <option @if ($paymentMethod->status == '0') selected @endif value="0">
                                            {{ __('Unactive') }}
                                        </option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        @error('status')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror

                        @foreach ($translations as $translation )

                        <div id="container">
                            <div class="item">


                                <div class="form-group">
                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <label class="form-label">Attribute</label>
                                        </div>
                                        <div class="col-md-9">
                                           
                                            <input type="text" class="form-control"
                                                value="{{ $translation->attribute }}" name="attribute[]" id="basic-url"
                                                aria-describedby="basic-addon3">
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
                                            <input type="text" class="form-control"
                                                value="{{ $translation->translate }}" name="translate[]" id="basic-url"
                                                aria-describedby="basic-addon3">
                                        </div>
                                    </div>
                                </div>
                                @error('translate')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror

                                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>

                        @endforeach


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
                            <label class="form-label">Attribute</label>
                        </div>
                        <div class="col-md-9">
                          <input type="text" class="form-control"  name="attribute[]" id="basic-url" aria-describedby="basic-addon3">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row row-sm">
                        <div class="col-md-4">
                            <label class="form-label">Translate</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
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
            container.appendChild(newItem); // Add new item at the end
        }

        function removeItem(btn) {
            const item = btn.closest('.item'); // Find the closest item container
            item.remove(); // Remove the item
        }
        function handleAttributeChange(selectElement) {
            const item = selectElement.closest('.item');
            const translateContainer = item.querySelector('.translate-container');

            if (selectElement.value === 'content') {
                translateContainer.innerHTML = '<textarea class="form-control" name="translate[]" id="basic-url" aria-describedby="basic-addon3">{{ old('translate') }}</textarea>';
            } else {
                translateContainer.innerHTML = '<input type="text" class="form-control" value="{{ old('translate') }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">';
            }
        }


    </script>






@endsection
