<?php


namespace App\Services\Car;


use App\Models\Car;
use App\Services\Model\Crudable as ModelCrudService;
use Illuminate\Support\Str;

class CrudService implements Crudable
{
    protected ModelCrudService $modelCrudService;

    public function __construct(ModelCrudService $modelCrudService)
    {
        $this->modelCrudService = $modelCrudService;
    }

    public function findAll(int $limit = 20, int $offset = 0, ?string $sort = null, ?array $filters = null): array
    {
        $result = Car::whereStatus(0)
            ->latest()
            ->with('model');

        $count = $result->count();
        $collection = $result->paginate($limit);
        return [$collection, $count];
    }

    public function find(int $id): Car
    {
        return Car::whereStatus(0)->findOrFail($id);
    }

    public function create(array $data): Car
    {
        $result = Car::make($data);
        $model = $this->modelCrudService->find((int)$data['model']);
        $result->model()->associate($model);
        $result->setDateCreation($data['date_creation']);
        $result->setRentalPrice($data['rental_price']);
        if (!isset($data['license_plate'])) {
            $result->license_plate = Str::uuid();
        }
        $result->saveOrFail();

        return $result;
    }

    public function update(int $id, array $data): Car
    {
        $car = $this->find($id);
        if (isset($data['model'])) {
            $model = $this->modelCrudService->find((int)$data['model']);
            $car->model()->associate($model);
        }
        if (isset($data['date_creation'])) {
            $car->setDateCreation($data['date_creation']);
        }
        if (isset($data['rental_price'])) {
            $car->setRentalPrice($data['rental_price']);
        }
        $car->fill($data)
            ->saveOrFail();

        return $car;
    }

    public function delete(int $id): bool
    {
        $result = $this->find($id);

        return $result->delete();
    }
}
