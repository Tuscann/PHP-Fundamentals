<?php


namespace Services;


interface UploadServiceInterface
{
    public function upload($fileInfo, $destination): string;
}