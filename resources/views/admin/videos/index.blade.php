@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Vídeos</h3>
            {!! Button::primary('Novo vídeo')->asLinkTo(route('admin.videos.create')) !!}
        </div>

        <div class="row">
            {!! 
                Table::withContents($videos->items())->striped()

                ->callback('Descrição', function ($field, $c){
                    return MediaObject::withContents(
                        [
                            'image' => $c->thumb_small_asset,
                            'link' => $c->video_file_asset,
                            'heading' => $c->title,
                            'body' => $c->description,
                        ]
                    );
                })

                ->callback('Ações', function($field, $c) {
                    $linkedit = route('admin.videos.edit', ['video' => $c]);
                    
                    $buttonDelete = Button::link(Icon::create('remove'))
                    ->asLinkTo(route('admin.videos.show', ['video' => $c]));

                    
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkedit). " | " . $buttonDelete;
                })
{{--                /Applications/MAMP/htdocs/curso/api/storage/app/videos_test/videos/1/eb0c5280c4061a4a97f785a7a09d6171_small.jpeg--}}
{{--                /Applications/MAMP/htdocs/curso/api/storage/app/videos_test/videos/1/eb0c5280c4061a4a97f785a7a09d6171_small.jpeg--}}

            
            !!}
        </div>
        {!! $videos->links() !!}
    </div>
@endsection

@push('styles')
<style type="text/css">
    .media-body{
        width: auto;
    }
</style>
@endpush
