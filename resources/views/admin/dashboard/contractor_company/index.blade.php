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
                            <a href="{{ route('ContractorCompany.create') }}" class="btn btn-primary">Create</a>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('membership_no') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Address') }}</th>                               
                                    <th>{{ __('Specialty') }}</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Number Of Hours') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Company Size') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Review') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Options') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractors as $contractor)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $contractor->membership_no  }}</td>
                                        <td>{{ $contractor->{'contractor_name' . app()->getLocale()} ?? $contractor->contractor_name }}</td>
                                        <td>{{ $contractor->{'contractor_address' . app()->getLocale()} ?? $contractor->contractor_address }}</td>


                                        <td>{{ $contractor->specialty->name ?? '' }}</td>
                                        <td>{{ $contractor->country->name ?? '' }}</td>
                                        <td>{{ $contractor->city->name ?? '' }}</td>

                                        <td>{{ $contractor->phone }}</td>
                                        <td>{{ $contractor->email }}</td>
                                        <td>{{ $contractor->number_of_hours }}</td>
                                        @foreach ($contractor->media as $imgs)
                                            <td>
                                                <img src="{{ $imgs->getUrl() }}" width="75" height="75"
                                                    alt="">
                                            </td>
                                        @endforeach

                                        <td>
                                            @if ($contractor->company_size == 'small')
                                                {{__('Small')}}
                                            @elseif($contractor->company_size == 'medium')
                                                {{__('Medium')}}
                                            @elseif($contractor->company_size == 'large')
                                                {{__('Large')}}
                                            @endif
                                        </td>
                                        <td>{{ $contractor->rate }}</td>
                                        <td>{{ $contractor->review }}</td>

                                        <td>
                                            @if ($contractor->status == 1)
                                              <span class="badge rounded-pill bg-primary">  {{__('Active')}}</span>
                                            @else
                                              <span class="badge rounded-pill bg-secondary">{{__('Unactive')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('ContractorCompany.edit', $contractor->id) }}"
                                                    class="btn btn-primary me-2"><i class="las la-edit"></i></a>
                                                <form method="POST" action="{{ route('ContractorCompany.destroy', $contractor->id) }}">
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
