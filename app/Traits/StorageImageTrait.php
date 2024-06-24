<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = Uuid::uuid4()->toString() . '.' . strtolower($file->getClientOriginalExtension());
            // tao ra duong dan cho anh
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $filenameHash);
            $dataUploadTrait = [
                'file_name' => $filenameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $forderName)
    {
        $filenameOrigin = $file->getClientOriginalName();
        $filenameHash = Uuid::uuid4()->toString() . '.' . strtolower($file->getClientOriginalExtension());
        // tao ra duong dan cho anh
        $filePath = $file->storeAs('public/' . $forderName . '/' . auth()->id(), $filenameHash);
        $dataUploadTrait = [
            'file_name' => $filenameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;
    }
}
