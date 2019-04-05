<?php


namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;

/**
 * Trait VideoStorages
 * @package CodeFlix\Media
 */
trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage()
    {
        return \Storage::disk($this->getDiskDriver());
    }

    /**
     * @return mixed
     */
    protected function getDiskDriver()
    {
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath) {
        return $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath);
    }

}