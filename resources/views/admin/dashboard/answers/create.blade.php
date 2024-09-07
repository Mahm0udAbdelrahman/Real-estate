@extends('admin.layouts.app')
@section('content')
    <!--APP-CONTENT START-->

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h2 class="main-content-title fs-24 mb-1">Create Answer</h2>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Answers</li>
            </ol>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .item {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 10px;
        }

        .hidden {
            display: none;
        }

        .custom-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .custom-textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 10px;
            height: 100px;
        }
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
                <form class="form-horizontal" method="POST" action="{{ route('answers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @foreach (DB::table('translations')->where('language_id', $lang->id)->where('model_type', 'Ask')->where('attribute','title')->get() as $ask)
                        <div class="form-group item">
                                    <h2><span>{{ $loop->index + 1 }} - </span>{{ $ask->translate }}</h2>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="answer[{{ $ask->id }}]" id="inlineRadio1_{{ $ask->id }}" value="no" onclick="toggleTextarea(false, {{ $ask->id }})">
                                        <label class="form-check-label" for="inlineRadio1_{{ $ask->id }}">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="answer[{{ $ask->id }}]" id="inlineRadio2_{{ $ask->id }}" value="yes" onclick="toggleTextarea(true, {{ $ask->id }})">
                                        <label class="form-check-label" for="inlineRadio2_{{ $ask->id }}">Yes</label>
                                    </div>
                                    <div class="form-group hidden" id="textarea-container-{{ $ask->id }}">
                                        <label for="textarea_{{ $ask->id }}">Answer Details</label>
                                        <textarea id="textarea_{{ $ask->id }}" name="answer_details[{{ $ask->id }}]" class="custom-textarea"></textarea>
                                    </div>
                                </div>
                        @endforeach

                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <button class="form-control btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--APP-CONTENT CLOSE-->

    <script>
        function toggleTextarea(show, id) {
            const container = document.getElementById(`textarea-container-${id}`);
            if (show) {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }
    </script>

@endsection
