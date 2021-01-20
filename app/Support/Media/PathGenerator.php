<?php


namespace App\Support\Media;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class PathGenerator extends DefaultPathGenerator
{
    public function getBasePath(Media $media): string
    {
        $directoryNesting = 3;
        $directoryLength = 2;
        $path = '';
        for ($i = 0, $start = 0; $i < $directoryNesting; $i++) {
            $path .= '/' . substr($media->file_name, $start, $directoryLength);
            $start += $directoryLength;
        }
        return $path;
    }
}
