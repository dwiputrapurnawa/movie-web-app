<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Http\UploadedFile;

class UploadController extends Controller
{
    public function uploadFile(FileReceiver $receiver)
    {
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
    
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need
            return $this->saveFile($save->getFile());
        }
    
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone()
        ]);
    }

    protected function saveFile(UploadedFile $file)
{
    $fileName = $this->createFilename($file);

    // Build the file path
    $finalPath = storage_path("app/public/movie_videos");

    // move the file name
    $file->move($finalPath, $fileName);

    return response()->json([
        'path' => "movie_videos/". $fileName
    ]);
}

protected function createFilename(UploadedFile $file)
{
    $extension = $file->getClientOriginalExtension();
    $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

    // Add timestamp hash to name of the file
    $filename .= "_" . md5(time()) . "." . $extension;

    return $filename;
}
}
