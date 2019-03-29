@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>
            Dados da categoria
        </h3>
        <?php $iconEdit = Icon::create('pencil'); ?>
        {!! Button::primary($iconEdit)->asLinkTo(route('admin.category.edit', ['user' => $category->id])) !!}

        <?php $iconDelete = Icon::create('remove'); ?>
        {!! 
        
        Button::danger($iconDelete)
        ->asLinkTo(route('admin.category.destroy', ['user' => $category->id]))
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
                    'route' => ['admin.category.destroy', 'user' => $category->id],
                    'method' => 'DELETE',
                    'style' => 'display:none',
                ])
        ?>

        {!! form($formDelete) !!}

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$category->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$category->name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
