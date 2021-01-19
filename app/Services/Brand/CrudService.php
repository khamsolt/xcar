<?php


namespace App\Services\Brand;


use App\Models\Brand;

class CrudService implements Crudable
{
    public function findAll(int $limit = 20, int $offset = 0, ?string $sort = null, ?array $filters = null): array
    {
        $result = Brand::whereStatus(0)->latest();

        if ($limit > 0) {
            $result->latest()->limit($limit)->offset($offset);
        }

        $count = $result->count();
        $collection = $result->get();
        return [$collection, $count];
    }

    public function find(int $id): Brand
    {
        return Brand::whereStatus(0)->findOrFail($id);
    }

    public function create(array $data): Brand
    {
        $result = Brand::make($data);
        $result->saveOrFail();

        return $result;
    }

    public function update(int $id, array $data): Brand
    {
        $brand = $this->find($id);
        $brand->fill($data)
            ->saveOrFail();

        return $brand;
    }

    public function delete(int $id): bool
    {
        $result = $this->find($id);

        return $result->delete();
    }
}
