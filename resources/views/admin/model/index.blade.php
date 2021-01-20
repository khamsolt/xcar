@extends('adminlte::page')

@section('title', 'Models')

@section('content_header')

    <h1>@lang('Models')</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">@lang('Models')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.model.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-plus"></i>
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
                            <th>@lang("Brand")</th>
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
                                <td>{{ $item->brand->name }}</td>
                                <td>{{ $item->status === 0 ? 'Default' : 'Other' }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.model.show', ['model' => $item->id]) }}"
                                       class="btn text-primary btn-link btn-sm">
                                        <i class="fas fa-folder-open"></i>
                                    </a>
                                    <a href="{{ route('admin.model.edit', ['model' => $item->id]) }}"
                                       class="btn text-primary btn-link btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.model.destroy', ['model' => $item->id]) }}"
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
