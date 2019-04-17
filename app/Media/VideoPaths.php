<?php


namespace CodeFlix\Media;


trait VideoPaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute()
    {
        //->thumb_folder_storage
        return "videos/{$this->id}";
    }

    public function getVideoFileFolderStorageAttribute()
    {
        //->video_file_folder_storage
        return "videos/{$this->id}";
    }

    public function getVideoFileAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.videos.video_file_asset', ['video' => $this->id]) :
            $this->video_file_path;
    }


    public function getThumbDefaultAttribute()
    {
        //->thumb_default
        return env('VIDEO_NO_THUMB');
    }

    public function getVideoFileRelativeAttribute()
    {
        //->video_file_relative
        return $this->file ? "{$this->video_file_folder_storage}/{$this->file}" : false;
    }

    public function getVideoFilePathAttribute()
    {
        //->video_file_path
        if ($this->video_file_relative) {
            return $this->getAbsolutePath($this->getStorage(), $this->video_file_relative);
        }
        return false;
    }
}