<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\Create as CreateRequest;
use App\Http\Requests\Model\ID as IDRequest;
use App\Http\Requests\Model\Index as IndexRequest;
use App\Http\Requests\Model\Update as UpdateRequest;
use App\Services\Brand\Crudable as BrandCrudService;
use App\Services\Model\Crudable as ModelCrudService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ModelController extends Controller
{
    private ModelCrudService $modelCrudService;
    private BrandCrudService $brandCrudService;

    public function __construct(ModelCrudService $modelCrudService, BrandCrudService $brandCrudService)
    {
        $this->modelCrudService = $modelCrudService;
        $this->brandCrudService = $brandCrudService;
    }

    public function index(IndexRequest $indexRequest): View
    {
        $sort = $indexRequest->getSort();
        $filters = $indexRequest->getFilters();
        $limit = $indexRequest->getLimit();
        $offset = $indexRequest->getOffset();

        [$collection, $count] = $this->modelCrudService->findAll($limit, $offset, $sort, $filters);
        return view('admin.model.index', compact('collection', 'count', 'sort', 'filters', 'limit', 'offset'));
    }

    public function create(): View
    {
        [$brands] = $this->brandCrudService->findAll(0);
        return view('admin.model.form', ['route' => route('admin.model.store'), 'brands' => $brands]);
    }

    public function store(CreateRequest $createRequest): RedirectResponse
    {
        $data = $createRequest->validated();
        try {
            $this->modelCrudService->create($data);
        } catch (\Throwable $exception) {
            return redirect(route('admin.model.create'))->withInput($data);
        }
        return redirect(route('admin.model.index'));
    }

    public function show(IDRequest $idRequest): View
    {
        $model = $this->modelCrudService->find($idRequest->id);
        return view('admin.model.show', compact('model'));
    }

    public function edit(IDRequest $idRequest): View
    {
        $model = $this->modelCrudService->find($idRequest->id);
        [$brands] = $this->brandCrudService->findAll(0);
        return view('admin.model.form', [
            'model' => $model,
            'route' => route('admin.model.update', ['model' => $model->id]),
            'method' => 'PUT',
            'brands' => $brands
        ]);
    }

    public function update(UpdateRequest $updateRequest, IDRequest $idRequest): RedirectResponse
    {
        $data = $updateRequest->validated();
        try {
            $model = $this->modelCrudService->update($idRequest->id, $data);
        } catch (\Throwable $exception) {
            return redirect(route('admin.model.edit'))->withInput($data);
        }
        return redirect(route('admin.model.show', ['model' => $model->id]));
    }

    public function destroy(IDRequest $deleteRequest): RedirectResponse
    {
        if ($this->modelCrudService->delete($deleteRequest->id)) {
            return redirect(route('admin.model.index'))
                ->with('success', true);
        }
        return redirect(route('admin.model.index'))
            ->with('success', false);
    }
}
