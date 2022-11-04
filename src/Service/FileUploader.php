<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->targetDirectory = $targetDirectory;
    }

    public function upload( UploadedFile $file):string
    {
        $baseFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $savedFilename = $this->slugger->slug($baseFileName);
        $fileName = $savedFilename.'-'.uniqid().'.'.$file->guessExtension();

        try{
            $file->move($this->getTargetDirectory(), $fileName);
        }
        catch(FileException $e){

        }

        return $fileName;
    }

    private function getTargetDirectory():string
    {
        return $this->targetDirectory;
    }
}