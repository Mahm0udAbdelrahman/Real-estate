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
                            <a href="{{ route('ManagerCompany.create') }}" class="btn btn-primary">Create</a>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Sub Specialty') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Location') }}</th>
                                    <th>{{ __('Number Of Employees') }}</th>
                                    <th>{{ __('Number Of Branches') }}</th>
                                    <th>{{ __('Number Of Experience') }}</th>
                                    <th>{{ __('commercial_registration_certificate') }}</th>
                                    <th>{{ __('vat_certificate') }}</th>
                                    <th>{{ __('social_insurance_certificate') }}</th>
                                    <th>{{ __('chamber_of_commerce_certificate') }}</th>
                                    <th>{{ __('company_profile') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Review') }}</th>
                                    <th>{{ __('Heart') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Options') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($register_companies as $register_company)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        {{ $register_company->company_name }}

                                    </td>
                                    <td>
                                        {{ $register_company->specialty->name ?? '' }}

                                    </td>
                                    <td>
                                        @php
                                        $sb=App\Models\ManagerComSub::where('manager_company_id',$register_company->id)->pluck('subspecialty_id');
                                        $subs=App\Models\SubspecialtyTranslation::whereIn('subspecialty_id',$sb)->where('locale',$lang)->get()
                                        @endphp
                                        @foreach ($subs as $s)
                                        <li>{{ $s->name}}</li>
                                        @endforeach
                                    </td>

                                        <td>

                                            {{ $register_company->email }}
                                        </td>
                                        <td>

                                            {{ $register_company->phone }}
                                        </td>

                                        <td>

                                            {{ $register_company->location }}
                                        </td>
                                        <td>
                                            {{ $register_company->number_of_employees }}
                                        </td>

                                        <td>
                                            {{ $register_company->number_of_branches }}
                                        </td>
                                        <td>
                                            {{ $register_company->year_of_experience }}
                                        </td>

                                        @foreach ($register_company->getMedia('commercial_registration_certificate') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75"
                                                    alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}"
                                                    download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_company->getMedia('vat_certificate') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75"
                                                    alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}"
                                                    download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_company->getMedia('social_insurance_certificate') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75"
                                                    alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}"
                                                    download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_company->getMedia('chamber_of_commerce_certificate') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75"
                                                    alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}"
                                                    download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                    @foreach ($register_company->getMedia('company_profile') as $file)
                                        <td>
                                            @if (Str::startsWith($file->mime_type, 'image'))
                                                <img src="{{ $file->getUrl() }}" width="75" height="75"
                                                    alt="{{ $file->file_name }}">
                                            @else
                                                <a href="{{ $file->getUrl() }}"
                                                    download="{{ $file->file_name }}">{{ $file->file_name }}</a>
                                            @endif
                                        </td>
                                    @endforeach

                                        <td>
                                            {{ $register_company->rate }}
                                        </td>
                                        <td>
                                            {{ $register_company->review }}
                                        </td>

                                        <td>
                                            @if ($register_company->status == 1)
                                                {{ __('Active') }}
                                            @else
                                                {{ __('Unactive') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($register_company->heart == 'not_favorite')
                                                {{ __('Not Favorite') }}
                                            @else
                                                {{ __('Favorite') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('ManagerCompany.edit', $register_company->id) }}"
                                                    class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('ManagerCompany.destroy', $register_company->id) }}">
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
