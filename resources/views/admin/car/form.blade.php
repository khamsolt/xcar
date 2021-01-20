@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')
    <h1>@lang('Cars')</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">@lang('Add New Cars')</h3>
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
                            <label for="carNameID">@lang('Car Name')</label>
                            <input name="name"
                                   type="text"
                                   class="form-control"
                                   id="carNameID"
                                   placeholder="@lang('Car Name')"
                                   value="{{ empty($car) ? old('name') : $car->name }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Model')</label>
                            <x-input-select name="model"
                                            :collection="$models"
                                            :id="@empty($car) ? (int)old('model') : $car->model->id">
                            </x-input-select>
                        </div>
                        <div class="form-group">
                            <label>@lang('Transmission')</label>
                            <select name="transmission" class="form-control">
                                <option value="mechanic"
                                        @if(isset($car) && $car->transmission === 'mechanic') selected @endif>@lang('Mechanic')</option>
                                <option value="automatic"
                                        @if(isset($car) && $car->transmission === 'automatic') selected @endif>@lang('Automatic')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="carLicensePlateID">@lang('License Plate')</label>
                            <input name="license_plate"
                                   type="text"
                                   class="form-control"
                                   id="carLicensePlateID"
                                   placeholder="@lang('License Plate')"
                                   value="{{ empty($car) ? old('license_plate') : $car->license_plate }}">
                        </div>
                        <div class="form-group">
                            <label for="carColorID">@lang('Color')</label>
                            <input name="color"
                                   type="text"
                                   class="form-control"
                                   id="carColorID"
                                   placeholder="@lang('Color')"
                                   value="{{ empty($car) ? old('color') : $car->color }}">
                        </div>
                        <div class="form-group">
                            <label for="carDateCreationID">@lang('Date Creation')</label>
                            <input name="date_creation"
                                   type="text"
                                   class="form-control"
                                   id="carDateCreationID"
                                   placeholder="@lang('Date Creation')"
                                   value="{{ empty($car) ? old('date_creation') : $car->getDateCreation() }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('Rental Type')</label>
                            <select name="rental_type" class="form-control">
                                <option value="24" selected>@lang('Per Date')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="carRentalPriceID">@lang('Rental Price')</label>
                            <input name="rental_price"
                                   type="text"
                                   class="form-control"
                                   id="carRentalPriceID"
                                   placeholder="@lang('Rental Price')"
                                   value="{{ empty($car) ? old('rental_price') : $car->getRentalPrice() }}">
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
