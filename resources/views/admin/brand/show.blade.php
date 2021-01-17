@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')

    <h1>Brand</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">@lang('Full Description')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.brand.create') }}" class="btn btn-tool btn-sm">
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
                        <dd>{{ $brand->name }}</dd>

                        <dt>@lang('Status')</dt>
                        <dd>{{ $brand->status === 0 ? 'Default' : 'Other' }}</dd>

                        <dt>@lang('Created')</dt>
                        <dd>{{ $brand->created_at }}</dd>

                        <dt>@lang('Updated')</dt>
                        <dd>{{ $brand->updated_at }}</dd>

                        @if(!empty($brand->deleted_at))
                            <dt>@lang('Deleted')</dt>
                            <dd>{{ $brand->deleted_at }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

@stop
