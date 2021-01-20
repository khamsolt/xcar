@extends('adminlte::page')

@section('title', 'Cars')

@section('content_header')

    <h1>@lang('Cars')</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('Cars')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.car.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-folder-plus"></i>
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>@lang("ID")</th>
                            <th>@lang("Name")</th>
                            <th>@lang("Model")</th>
                            <th>@lang("Transmission")</th>
                            <th>@lang("License Plate")</th>
                            <th>@lang("Color")</th>
                            <th>@lang("Date Creation")</th>
                            <th>@lang("Rental Type")</th>
                            <th>@lang("Rental Price")</th>
                            <th>@lang("Status")</th>
                            <th>@lang("Created")</th>
                            <th>@lang("Action")</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collection as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->model->name }}</td>
                                <td>{{ $item->transmission }}</td>
                                <td>{{ $item->license_plate }}</td>
                                <td>{{ $item->color }}</td>
                                <td>{{ $item->getDateCreation() }}</td>
                                <td>{{ $item->rental_type }}</td>
                                <td>{{ $item->getRentalPrice() }}$</td>
                                <td>{{ $item->status === 0 ? 'Default' : 'Other' }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.car.show', ['car' => $item->id]) }}"
                                       class="btn text-primary btn-link btn-sm">
                                        <i class="fas fa-folder-open"></i>
                                    </a>
                                    <a href="{{ route('admin.car.edit', ['car' => $item->id]) }}"
                                       class="btn text-primary btn-link btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.car.destroy', ['car' => $item->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link btn-sm"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $collection->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
