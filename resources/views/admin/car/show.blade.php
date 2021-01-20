@extends('adminlte::page')

@section('title', 'Car')

@section('content_header')

    <h1>@lang('Car')</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-widget widget-user">
                @if(isset($photo))
                    <div class="widget-user-header text-white"
                         style="background: url('{{ $photo ?? '' }}') center center;">
                        <h3 class="widget-user-username text-right">@lang('Full Description')</h3>
                    </div>
                @else
                    <div class="card-header ">
                        <h3 class="card-title">@lang('Full Description')</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.car.create') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-plus"></i>
                            </a>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="card-footer">
                    <dl>
                        <dt>@lang('Name')</dt>
                        <dd>{{ $car->name }}</dd>

                        <dt>@lang('Model')</dt>
                        <dd>{{ $car->model->name }}</dd>

                        <dt>@lang('Transmission')</dt>
                        <dd>{{ $car->transmission }}</dd>

                        <dt>@lang('License Plate')</dt>
                        <dd>{{ $car->license_plate }}</dd>

                        <dt>@lang('Color')</dt>
                        <dd>{{ $car->color }}</dd>

                        <dt>@lang('Date Creation')</dt>
                        <dd>{{ $car->getDateCreation() }}</dd>

                        <dt>@lang('Rental Type')</dt>
                        <dd>{{ $car->rental_type }}</dd>

                        <dt>@lang('Rental Price')</dt>
                        <dd>{{ $car->getRentalPrice() }}$</dd>

                        <dt>@lang('Status')</dt>
                        <dd>{{ $car->status === 0 ? 'Default' : 'Other' }}</dd>

                        <dt>@lang('Created')</dt>
                        <dd>{{ $car->created_at }}</dd>

                        <dt>@lang('Updated')</dt>
                        <dd>{{ $car->updated_at }}</dd>

                        @if(!empty($car->deleted_at))
                            <dt>@lang('Deleted')</dt>
                            <dd>{{ $car->deleted_at }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

@stop
