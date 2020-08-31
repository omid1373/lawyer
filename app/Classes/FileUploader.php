<?php
namespace App\Classes;

use App\Models\Document;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileUploader{
    public static function base64FileUpload($base64String, $documentable_object, $method = 'documents', $name = null){
        $arr = explode(',', $base64String);
        if(count($arr) > 1) {
            list($fileDetails, $base64String) = explode(',', $base64String);
            $extension = explode('/', $fileDetails)[1];
            $extension = explode(';', $extension)[0];
        } else {
            $extension = 'jpeg';
        }
        $tmpName = 'base64' . base64_encode(floor(microtime(true)) . rand(10, 99));
        $tmpPath = "tmp/$tmpName.$extension";
        Storage::disk('local')->put($tmpPath, base64_decode($base64String));
        $file = new File(storage_path('app') . '/' . $tmpPath);
        $path = Storage::disk('public')->putFile(date('Y') . '/' . date('m') , $file);
        $name = $name ?? $tmpName;
        $MIME = $file->getMimeType();
        Storage::disk('local')->delete($tmpPath);
        return self::storeFileInfo($name, $documentable_object, $path, $MIME, $method);
    }

    public static function manualFileUpload(UploadedFile $uploadedFile, $documentable_object, $extensions = [], $method = 'documents'){
        $fileExtension = $uploadedFile->guessExtension();
        if(!empty($extensions) && !in_array($fileExtension, $extensions))
            return response(['message' => 'invalid file type'], 400);
        $originalFileName = $uploadedFile->getClientOriginalName();
        $MIME = $uploadedFile->getMimeType();
        $fileNameArray = explode('.', $originalFileName);
        array_pop($fileNameArray);
        $originalFileName = implode('.', $fileNameArray);
        $path = Storage::disk('public')->putFile(date('Y') . '/' . date('m') , $uploadedFile);
        return self::storeFileInfo($originalFileName, $documentable_object, $path, $MIME, $method);
    }

    private static function storeFileInfo($name, $document, $path, $MIME, $method){
        return $document->$method()->create([
            'name' => $name,
            'path' => $path,
            'mime_type' => $MIME
        ]);
    }
}
