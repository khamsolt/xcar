<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\Create;
use App\Http\Requests\Car\ID as IDRequest;
use App\Http\Requests\Car\Index;
use App\Http\Requests\Car\Update as UpdateRequest;
use App\Models\Car;
use App\Services\Car\Crudable as CarCrudService;
use App\Services\Media\Contract as MediaManager;
use App\Services\Model\Crudable as ModelCrudService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    private CarCrudService $carCrudService;
    private ModelCrudService $modelCrudService;
    private MediaManager $mediaManager;

    public function __construct(CarCrudService $carCrudService, ModelCrudService $modelCrudService, MediaManager $mediaManager)
    {
        $this->carCrudService = $carCrudService;
        $this->modelCrudService = $modelCrudService;
        $this->mediaManager = $mediaManager;
    }

    public function index(Index $indexRequest): View
    {
        $sort = $indexRequest->getSort();
        $filters = $indexRequest->getFilters();
        $limit = $indexRequest->getLimit();
        $offset = $indexRequest->getOffset();

        [$collection, $count] = $this->carCrudService->findAll($limit, $offset, $sort, $filters);
        return view('admin.car.index', compact('collection', 'count', 'sort', 'filters', 'limit', 'offset'));
    }

    public function create(): View
    {
        [$models] = $this->modelCrudService->findAll(0);
        $transmissionEnum = ['mechanic', 'automatic'];
        return view('admin.car.form', ['route' => route('admin.car.store'), 'models' => $models, 'transmissionEnum' => $transmissionEnum]);
    }

    public function store(Create $createRequest): RedirectResponse
    {
        $data = $createRequest->validated();
        try {
            $car = $this->carCrudService->create($data);
            $file = $createRequest->getFile();
            $this->mediaManager->upload($file, $car, 'photo');
        } catch (\Throwable $exception) {
            return redirect(route('admin.model.create'))->withInput($data);
        }
        return redirect(route('admin.model.index'));
    }

    public function show(IDRequest $idRequest): View
    {
        /** @var Car $car */
        $car = $this->carCrudService->find($idRequest->id);
        $photo = $car->hasMedia('photo')
            ? $car->getMedia('photo')->last()->getUrl()
            : 'https://via.placeholder.com/350x150';
        return view('admin.car.show', compact('car', 'photo'));
    }

    public function edit(IDRequest $idRequest): View
    {
        /** @var Car $car */
        $car = $this->carCrudService->find($idRequest->id);
        $photo = $car->hasMedia('photo')
            ? $car->getMedia('photo')->last()->getUrl()
            : 'https://via.placeholder.com/350x150';
        [$models] = $this->modelCrudService->findAll(0);
        return view('admin.car.form', [
            'car' => $car,
            'route' => route('admin.car.update', ['car' => $car->id]),
            'method' => 'PUT',
            'models' => $models,
            'photo' => $photo,
        ]);
    }

    public function update(UpdateRequest $updateRequest, IDRequest $idRequest): RedirectResponse
    {
        $data = $updateRequest->validated();
        try {
            /** @var Car $car */
            $car = $this->carCrudService->update($idRequest->id, $data);
            $photo = $car->hasMedia('photo')
                ? $car->getMedia('photo')->last()->getUrl()
                : 'https://via.placeholder.com/350x150';
            $file = $updateRequest->getFile();
            $this->mediaManager->upload($file, $car, 'photo');
        } catch (\Throwable $exception) {
            return redirect(route('admin.car.edit', ['car' => $idRequest->id, 'photo' => $photo]))->withInput($data);
        }
        return redirect(route('admin.car.show', ['car' => $car->id]));
    }

    public function destroy(IDRequest $deleteRequest)
    {
        if ($this->carCrudService->delete($deleteRequest->id)) {
            return redirect(route('admin.car.index'))
                ->with('success', true);
        }
        return redirect(route('admin.car.index'))
            ->with('success', false);
    }
}
