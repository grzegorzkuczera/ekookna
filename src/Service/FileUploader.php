<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file) : array
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $originalFileSize = $file->getSize();
        $originalFileExtension = $file->getClientOriginalExtension();

        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename.'-'.md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            
            // ... handle exception if something happens during file upload
        }

        return [
                'filename' => $fileName, 
                 'size' => $originalFileSize, 
                 'extension' => $originalFileExtension
                ];
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}