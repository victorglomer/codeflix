<?php

use CodeFlix\Models\Serie;
use CodeFlix\Repositories\SerieRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var Collection $series
         */

        $rootPath = config('filesystems.disks.videos_local.root');
        \File::deleteDirectory($rootPath, true);

        $series = factory(Serie::class, 5)->create();

        $repository = app(SerieRepository::class);
        $collectionThumbs = $this->getThumbs();
        $series->each(function($serie) use ($repository, $collectionThumbs) {
            $repository->uploadThumb($serie->id, $collectionThumbs->random());
        });

    }

    /**
 * @return \Illuminate\Support\Collection
 */
    protected function getThumbs()
    {
        return new \Illuminate\Support\Collection([
            new UploadedFile(
                storage_path('app/files/faker/thumbs/teste.jpg'),
                'thumb_synfony.jpg'
            )
        ]);
    }
}
