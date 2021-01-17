<?php


namespace App\Services\Contracts;


use App\Models\Brand;

interface Crudable
{
    public function findAll(int $limit = 20, int $offset = 0, ?string $sort = null, ?array $filters = null): array;

    public function find(int $id): Brand;

    public function create(array $data): Brand;

    public function update(int $id, array $data): Brand;

    public function delete(int $id): bool;
}
