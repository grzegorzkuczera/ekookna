<?php

namespace App\Tests\Service;

use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use PHPUnit\Framework\TestCase;

class FileUploaderTest extends TestCase
{
    
    public function testMoveFileThrowException()
    {

      $file = $this->getMockBuilder(UploadedFile::class)
      ->setMethods(['move', 'getSize', 'getClientOriginalName', 'getClientOriginalExtension', 'guessExtension'])
      ->disableOriginalConstructor()
      ->getMock();

      $file->expects($this->once())->method('move')->with($this->stringContains(__DIR__));
      $file->expects($this->once())->method('getSize');
      $file->expects($this->once())->method('getClientOriginalName');
      $file->expects($this->once())->method('getClientOriginalExtension');
      $file->expects($this->once())->method('guessExtension');

      $fileUploder = new FileUploader(__DIR__);
      $this->expectException(FileUploader::class);
      
      $fileUploder->upload($file);

      
    }

   
    
}