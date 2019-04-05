<?php
        $tabs = [
            [
                'title' => 'Informações',
                'link' => !isset($video) ? route('admin.videos.create') : route('admin.videos.edit', ['video' => $video->id])
            ],[
                'title' => 'Séries e categorias',
                'link' => !isset($video) ? '' : route('admin.videos.relations.create', ['video' => $video->id]),
                'disabled' => !isset($video) ? true : false
            ],[
                'title' => 'Vídeos e Imagem',
                'link' => '#',
                'disabled' => !isset($video) ? true : false
            ],
        ];
        ?>
<h3>Gerenciar vídeo</h3>
<div class="text-right">
    {!! Button::link('Listar vídeos')->asLinkTo(route('admin.videos.index')) !!}
</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>
