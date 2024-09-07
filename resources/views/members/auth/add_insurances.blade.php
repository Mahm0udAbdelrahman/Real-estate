<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item .form-group {
            margin-bottom: 0;
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
            gap: 10px;
        }

        .btn-container .form-control {
            flex: 1;
        }

        .form-group .row.row-sm > div {
            padding-left: 0;
            padding-right: 0;
        }

        .form-group .row.row-sm {
            margin-left: 0;
            margin-right: 0;
        }

        .card-default {
            max-width: 800px; /* تحديد العرض الأقصى للكارد */
            width: 100%;
        }
    </style>
</head>
<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9 col-md-10"> <!-- زيادة العرض -->
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                            <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                <a class="w-auto pl-0" href="/index.html">
                                    <img src="{{ asset('images/logo.png') }}" alt="Mono">
                                    <span class="brand-name text-dark">MONO</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">
                            <h4 class="text-dark text-center mb-5">Add Insurances</h4>
                            <form method="POST" action="{{ route('add_insurances.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">{{ __('Insurances') }}</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control input-lg" name="insurance_id">
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

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="date" class="form-control input-lg" id="birthday" name="birthday" value="{{ old('birthday') }}" aria-describedby="nameHelp" placeholder="birthday">
                                    </div>
                                    @error('birthday')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="text" class="form-control input-lg" id="insurance_card_number" name="insurance_card_number" value="{{ old('insurance_card_number') }}" aria-describedby="nameHelp" placeholder="insurance_card_number">
                                    </div>
                                    @error('insurance_card_number')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="date" class="form-control input-lg" id="insurance_expiry_date" name="insurance_expiry_date" value="{{ old('insurance_expiry_date') }}" aria-describedby="nameHelp" placeholder="insurance_expiry_date">
                                    </div>
                                    @error('insurance_expiry_date')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group col-md-12 mb-4">
                                        <input type="file" class="form-control input-lg" id="image" name="image" value="{{ old('image') }}" aria-describedby="nameHelp" placeholder="image">
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group col-md-12 mb-4">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">Status</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-control input-lg" name="status">
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
                                                            <option disabled selected>Choose attribute...</option>
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
                                                        <input type="text" class="form-control" value="{{ old('translate') }}" name="translate[]" id="basic-url" aria-describedby="basic-addon3">
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
                                        <button class="btn btn-primary btn-pill mb-4">Create</button>
                                        <button class="btn btn-secondary btn-pill mb-4">Skip</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <option disabled selected>Choose attribute...</option>
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
                <a onclick="addItem()"><i class="fa-solid fa-plus"></i></a>
                <a onclick="removeItem(this)"><i class="fa-solid fa-minus"></i></a>
            `;
            container.appendChild(newItem);
        }

        function removeItem(btn) {
            const item = btn.parentNode;
            item.parentNode.removeChild(item);
        }
    </script>
</body>
</html>
