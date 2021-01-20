<?php


namespace App\Services\Model;


use App\Models\Model;
use App\Services\Brand\Crudable as BrandCrudService;

class CrudService implements Crudable
{
    protected BrandCrudService $brandCrudService;

    public function __construct(BrandCrudService $brandCrudService)
    {
        $this->brandCrudService = $brandCrudService;
    }

    public function findAll(int $limit = 20, int $offset = 0, ?string $sort = null, ?array $filters = null): array
    {
        $result = Model::whereStatus(0)->with('brand');

        if ($limit > 0) {
            $result->latest();
        }

        $count = $result->count();
        $collection = $result->paginate($limit);
        return [$collection, $count];
    }

    public function find(int $id): Model
    {
        return Model::whereStatus(0)->findOrFail($id);
    }

    public function create(array $data): Model
    {
        $result = Model::make($data);
        $brand = $this->brandCrudService->find((int)$data['brand']);
        $result->brand()->associate($brand);
        $result->saveOrFail();

        return $result;
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->find($id);
        if (isset($data['brand'])) {
            $brand = $this->brandCrudService->find((int)$data['brand']);
            $model->brand()->associate($brand);
        }
        $model->fill($data)
            ->saveOrFail();

        return $model;
    }

    public function delete(int $id): bool
    {
        $result = $this->find($id);

        return $result->delete();
    }
}
