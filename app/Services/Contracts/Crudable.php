<?php


namespace App\Services\Contracts;


use Illuminate\Database\Eloquent\Model;

interface Crudable
{
    public function findAll(int $limit = 20, int $offset = 0, ?string $sort = null, ?array $filters = null): array;

    public function find(int $id): Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id): bool;
}
