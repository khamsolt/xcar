@extends('adminlte::page')

@section('title', 'Model')

@section('content_header')

    <h1>@lang('Model')</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">@lang('Full Description')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.model.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-plus"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>@lang('Name')</dt>
                        <dd>{{ $model->name }}</dd>

                        <dt>@lang('Brand')</dt>
                        <dd>{{ $model->brand->name }}</dd>

                        <dt>@lang('Status')</dt>
                        <dd>{{ $model->status === 0 ? 'Default' : 'Other' }}</dd>

                        <dt>@lang('Created')</dt>
                        <dd>{{ $model->created_at }}</dd>

                        <dt>@lang('Updated')</dt>
                        <dd>{{ $model->updated_at }}</dd>

                        @if(!empty($model->deleted_at))
                            <dt>@lang('Deleted')</dt>
                            <dd>{{ $model->deleted_at }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

@stop
