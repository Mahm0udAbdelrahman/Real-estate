@extends('admin.layouts.app')
@section('content')
    @push('cs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endpush
    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- Internal Datatables JS -->
        <script src="{{ asset('dashboard/assets/js/datatables.js') }}"></script>
    @endpush
    <!-- Start:: row-3 -->
    <div class="d-block align-items-center justify-content-between page-header-breadcrumb">

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Responisve Modal Datatable
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="responsivemodal-DataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <a href="{{ route('ConsultingServicePerson.create') }}" class="btn btn-primary">Create</a>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('full_name') }}</th>
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Subspecialty') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Age') }}</th>

                                    <th>{{ __('Year Of Experience') }}</th>
                                    <th>{{ __('Academic Degree') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('national_id') }}</th>
                                    <th>{{ __('freelance_license') }}</th>
                                    <th>{{ __('cv') }}</th>
                                    <th>{{ __('latest_academic_degree') }}</th>
                                    <th>{{ __('profile_photo') }}</th>
                                    <th>{{ __('Heart') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Options') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($register_persons as $register_person)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        {{ $register_person->full_name }}

                                    </td>
                                    <td>
                                        {{ $register_person->specialty->name ?? '' }}

                                    </td>
                                    <td>
                                        @php
                                        $sb=App\Models\ConsultingPersonSub::where('service_person_id',$register_person->id)->pluck('subspecialty_id');
                                        $subs=App\Models\SubspecialtyTranslation::whereIn('subspecialty_id',$sb)->where('locale',$lang)->get()
                                        @endphp
                                        @foreach ($subs as $s)
                                        <li>{{ $s->name}}</li>
                                        @endforeach
                                    </td>

                                        <td>
                                            {{ $register_person->email }}
                                        </td>
                                        <td>

                                            {{ $register_person->phone }}
                                        </td>
                                         <td>

                                            {{ $register_person->age }}
                                        </td>


                                        <td>

                                            {{ $register_person->year_of_experience }}
                                        </td>
                                        <td>

                                            {{ $register_person->academic_degree }}
                                        </td>

                                        <td>

                                            {{ $register_person->rate }}
                                        </td>
                                        @foreach ($register_person->getMedia('national_id') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75" alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_person->getMedia('freelance_license') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75" alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_person->getMedia('cv') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75" alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_person->getMedia('latest_academic_degree') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75" alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_person->getMedia('profile_photo') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75" alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach



                                        <td>
                                            @if ($register_person->status == 1)
                                                {{ __('Active') }}
                                            @else
                                                {{ __('Unactive') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($register_person->heart == 'not_favorite')
                                                {{ __('Not Favorite') }}
                                            @else
                                                {{ __('Favorite') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('ConsultingServicePerson.edit', $register_person->id) }}"
                                                    class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('ConsultingServicePerson.destroy', $register_person->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button onclick="if(!confirm('Are you sure?')){return false}"
                                                        class="btn btn-danger"><i class="bi bi-basket"></i></button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-3 -->
@endsection
