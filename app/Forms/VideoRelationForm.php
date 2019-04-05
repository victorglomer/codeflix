<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form {

    public function buildForm() {
        $this
                ->add('categories', 'entity', [
                    'class' => Category::class,
                    'label' => 'Categorias',
                    'property' => 'name',
                    'multiple' => true,
                    'rules' => 'required|exists:categories,id', //garante requerido, que exista na tabela
//            'selected' => $this->model->categories->pluck('id')->toArray(),
                    'attr' => [
                        'name' => 'categories[]'
                    ]
                ])
                ->add('serie_id', 'entity', [
                    'class' => Serie::class,
                    'property' => 'title',
                    'label' => 'Série',
                    'empty_value' => 'Selecione a série',
                    'rules' => 'nullable|exists:series,id'
        ]);
    }

}
