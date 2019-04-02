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
                            'image' => '//placehold.it/64x64',
                            'link' => '#',
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
