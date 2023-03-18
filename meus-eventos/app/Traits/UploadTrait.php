<?php
namespace App\Traits;


use Illuminate\Http\UploadedFile;

trait UploadTrait
{
    /**
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, 'public');
    }

    /**
     * @param array $files
     * @param string $folder
     * @param string $collumn
     * @return array
     */
    public function multipleFilesUpload(array $files, string $folder, string $collumn): array
    {
        $uploadedFiles = [];
        foreach ($files as $file) {
            $uploadedFiles[] = [$collumn => $this->upload($file, $folder)];
        }

        return $uploadedFiles;
    }


}
