@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>
            Dados da série
        </h3>
        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('admin.series.edit', ['user' => $series->id])) !!}

        <?php $iconDelete = Icon::create('remove'); ?>
        {!! 
        
        Button::danger($iconDelete)
        ->asLinkTo(route('admin.series.destroy', ['user' => $series->id]))
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
                    'route' => ['admin.series.destroy', 'series' => $series->id],
                    'method' => 'DELETE',
                    'style' => 'display:none',
                ])
        ?>

        {!! form($formDelete) !!}

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$series->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{$series->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$series->description}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
