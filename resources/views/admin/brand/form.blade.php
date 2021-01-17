@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')

    <h1>Brands</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">@lang('Add New Brand')</h3>
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
                            <label for="brandNameID">@lang('Brand Name')</label>
                            <input name="name"
                                   type="text"
                                   class="form-control"
                                   id="brandNameID"
                                   placeholder="Brand Name"
                                   value="{{ empty($brand) ? old('name') : $brand->name }}">
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
