<?php


namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

trait VideoUploads
{

    /**
     * @param $id
     * @param UploadedFile $file
     * @return mixed
     */
    public function uploadVideoFile($id, UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model, $file, 'video_file');

        if ($name) {
            $this->deleteVideoFileOld($model);
            $model->file = $name;
            $model->save();
        }
        return $model;

    }

    public function deleteVideoFileOld($model)
    {
        /**
         * @var FilesystemAdapter $storage
         */
        $storage = $model->getStorage();
        if($storage->exists($model->video_file_relative)) {
            $storage->delete([
                $model->video_file_relative_relative,
            ]);
        }


    }
}