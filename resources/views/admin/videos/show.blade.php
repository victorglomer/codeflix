@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>
            Dados do vídeo
        </h3>
        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('admin.videos.edit', ['user' => $video->id])) !!}

        <?php $iconDelete = Icon::create('remove'); ?>
        {!! 
        
        Button::danger($iconDelete)
        ->asLinkTo(route('admin.videos.destroy', ['user' => $video->id]))
        ->addAttributes(
            [
                'onClick' => "
                event.preventDefault();
                if(confirm(\"Apagar mesmo?\")){document.getElementById(\"form-delete\").submit();}return false;
                "
            ])
        !!}

        <?php
        $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['admin.videos.destroy', 'video' => $video->id],
                    'method' => 'DELETE',
                    'style' => 'display:none',
                ])
        ?>

        {!! form($formDelete) !!}

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$video->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{$video->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$video->description}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
