<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait ImageUploader
{
    public function uploadImaged(UploadedFile $file, string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }
        $fileName = Str::random(20) . '.' . strtolower($file->getClientOriginalExtension());

        $relativePath = $path . '/' . $fileName;
        $stored = Storage::disk('public')->put($relativePath, file_get_contents($file));

        return $stored ? asset("storage/{$path}/{$fileName}") : null;
    }

    public function uploadImage(UploadedFile $file, string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }
        $fileName = Str::random(20) . '.' . strtolower($file->getClientOriginalExtension());
        $destination = public_path($path);
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        $file->move($destination, $fileName);
        return asset("{$path}/{$fileName}");
    }
}