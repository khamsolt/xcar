<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Create as CreateRequest;
use App\Http\Requests\Brand\ID;
use App\Http\Requests\Brand\ID as IDRequest;
use App\Http\Requests\Brand\Index as IndexRequest;
use App\Http\Requests\Brand\Update as UpdateRequest;
use App\Services\Brand\Crudable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    private Crudable $crudService;

    public function __construct(Crudable $crudService)
    {
        $this->crudService = $crudService;
    }

    public function index(IndexRequest $indexRequest): View
    {
        $sort = $indexRequest->getSort();
        $filters = $indexRequest->getFilters();
        $limit = $indexRequest->getLimit();
        $offset = $indexRequest->getOffset();

        [$collection, $count] = $this->crudService->findAll($limit, $offset, $sort, $filters);
        return view('admin.brand.index', compact('collection', 'count', 'sort', 'filters', 'limit', 'offset'));
    }

    public function create(): View
    {
        return view('admin.brand.form', ['route' => route('admin.brand.store')]);
    }

    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $data = $createRequest->validated();
        try {
            $this->crudService->create($data);
        } catch (\Throwable $exception) {
            return redirect(route('admin.brand.create'))->withInput($data);
        }
        return redirect(route('admin.brand.index'));
    }

    public function show(IDRequest $idRequest)
    {
        $brand = $this->crudService->find($idRequest->id);
        return view('admin.brand.show', compact('brand'));
    }

    public function edit(IDRequest $idRequest)
    {
        $brand = $this->crudService->find($idRequest->id);
        return view('admin.brand.form', [
            'brand' => $brand,
            'route' => route('admin.brand.update', ['brand' => $brand->id]),
            'method' => 'PUT'
        ]);
    }


    public function update(UpdateRequest $updateRequest, IDRequest $idRequest)
    {
        $data = $updateRequest->validated();
        try {
            $brand = $this->crudService->update($idRequest->id, $data);
        } catch (\Throwable $exception) {
            return redirect(route('admin.brand.edit'))->withInput($data);
        }
        return redirect(route('admin.brand.show', ['brand' => $brand->id]));
    }


    public function destroy(IDRequest $deleteRequest)
    {
        if ($this->crudService->delete($deleteRequest->id)) {
            return redirect(route('admin.brand.index'))
                ->with('success', true);
        }
        return redirect(route('admin.brand.index'))
            ->with('success', false);
    }
}
