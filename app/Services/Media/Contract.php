<?php


namespace App\Services\Media;


use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;

interface Contract
{
    public function upload(UploadedFile $file, HasMedia $model, string $group = 'default'): string;

    public function deleteAllByCollection(HasMedia $model, string $group = 'default'): void;
}
