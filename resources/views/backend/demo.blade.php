@extends('layouts.backend.app')
@section('title', 'Demo')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Roles')}}</h5>
                            <span>{{ __('Define roles of user')}}</span>
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
                                <a href="#">{{ __('Roles')}}</a>
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


        <!-- end message area-->
            <!-- only those have manage_demo permission will get access -->
            @can('manage_demo')


            @endcan
        </div>





    <!-- push external js -->
    @push('script')

    @endpush
@endsection
