@extends('layouts.backend.app')
@section('title','Backups')

<!-- push external head elements to head -->
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/DataTables/datatables.min.css') }}">
    {{--    sweet alert--}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@3.2.0/wordpress-admin/wordpress-admin.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Backup')}}</h5>
                            <span>{{ __('Project backup with database')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">@yield('title','')</a>
                            </li>
                        </ol>
                    </nav>
                    <div class="page-title-actions">
                        <div class="d-inline-block">
                            <button onclick="event.preventDefault();
                          document.getElementById('clean-old-backups').submit();"
                                    class="btn btn-danger" type="button">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-trash fa-w-20"></i>
                        </span>
                                {{ __('Clean Old Backups') }}
                            </button>
                            <form id="clean-old-backups" action="{{ route('settings.backups.clean') }}" method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button onclick="event.preventDefault();
                          document.getElementById('new-backup-form').submit();"
                                    class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                                {{ __('Create New Backup') }}
                            </button>
                            <form id="new-backup-form" action="{{ route('settings.backups.store') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- only those have manage_backup permission will get access -->
        @can('manage_backup')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-block">
                            {{--                            <h3>{{ __('Zero Configuration')}}</h3>--}}
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">
                                <table id="simpletable"
                                       class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">File Name</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($backups as $key=>$backup)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                <code>{{ $backup['file_name'] }}</code>
                                            </td>
                                            <td class="text-center">{{ $backup['file_size'] }}</td>
                                            <td class="text-center">{{ $backup['created_at'] }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm"
                                                   href="{{ route('settings.backups.download',$backup['file_name']) }}"><i
                                                        class="fas fa-download"></i>
                                                    <span>Download</span>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteData({{ $key }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <form id="delete-form-{{ $key }}"
                                                      action="{{ route('settings.backups.destroy',$backup['file_name']) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf()
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            </div>



            @endsection

            @push('js')
            <!-- push external js -->
                @push('script')
                    <script src="{{ asset('assets/backend/plugins/dropify/js/dropify.min.js') }}"></script>
                    <script src="{{ asset('assets/backend/plugins/DataTables/datatables.min.js') }}"></script>
                    <script src="{{ asset('assets/backend/js/datatables.js') }}"></script>

                    {{--    sweet alert--}}
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
                    <script src="{{ asset('assets/backend/js/script.js') }}"></script>
    @endpush
    @endpush
