<?php


namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

trait ThumbUploads
{
    /**
     * @param $id
     * @param UploadedFile $file
     * @return mixed
     */
    public function uploadThumb($id, UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model, $file);

        if ($name) {
            $this->deleteThumbsOld($model);
            $model->thumb = $name;
            $this->makeThumbSmall($model);
            $model->save();
        }
        return $model;

    }

    protected function makeThumbSmall($model)
    {
        $storage = $model->getStorage();
        $thumbFile = $model->thumb_path;
        $format = \Image::format($thumbFile);

        $thumbnailSmall = \Image::open($thumbFile)
            ->thumbnail(new Box(64, 36));

        $storage->put($model->thumb_small_relative, $thumbnailSmall->get($format));
    }

    public function upload($model, UploadedFile $file)
    {
        /**
         * @var FilesystemAdapter $storage
         */
        $storage = $model->getStorage();

        $name = md5(time() . "{$model->id}-{$file->getClientOriginalName()} ") . ".{$file->guessExtension()}";
        $result = $storage->putFileAs($model->thumb_folder_storage, $file, $name);

        return $result ? $name : $result;


    }

    public function deleteThumbsOld($model)
    {
        /**
         * @var FilesystemAdapter $storage
         */
        $storage = $model->getStorage();
        if($storage->exists($model->thumb_relative) || $model->thumb != $model->thumb_default) {
            $storage->delete([
                $model->thumb_relative,
                $model->thumb_small_relative,
            ]);
        }


    }
}