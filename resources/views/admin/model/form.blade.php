@extends('adminlte::page')

@section('title', 'Models')

@section('content_header')

    <h1>@lang('Models')</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">@lang('Add New Model')</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $route }}" method="{{ isset($get) ? 'GET' : 'POST' }}">
                        @csrf
                        @if(isset($method))
                            @method($method)
                        @endif
                        <div class="form-group">
                            <label for="modelNameID">@lang('Model Name')</label>
                            <input name="name"
                                   type="text"
                                   class="form-control"
                                   id="modelNameID"
                                   placeholder="@lang('Model Name')"
                                   value="{{ empty($model) ? old('name') : $model->name }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Brand')</label>
                            <x-input-select :collection="$brands" name="brand"
                                            :id="@empty($model) ? (int)old('brand') : $model->brand->id"></x-input-select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Status')</label>
                            <select name="status" class="form-control">
                                <option value="0" selected>Default</option>
                            </select>
                        </div>
                        <hr/>
                        <button class="btn btn-outline-primary btn-block" type="submit">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
