<?php


namespace CodeFlix\Media;


trait ThumbPaths
{
    use VideoStorages;

    public function getThumbRelativeAttribute()
    {
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    public function getThumbPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorage(), $this->thumb_relative);
    }

    public function getThumbSmallRelativeAttribute()
    {
        list($name, $extension) = explode('.', $this->thumb);
        return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
    }

    public function getThumbSmallPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorage(), $this->thumb_small_relative);
    }

    public function getThumbDefaultAttribute() {
        return env('SERIE_NO_THUMB');
    }
}