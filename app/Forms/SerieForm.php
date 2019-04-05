<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $rulesThumbFile = 'image|max:1024';
        $rulesThumbFile = !$id ? 'required|' . $rulesThumbFile : $rulesThumbFile;

        $this
            ->add('title', 'text', [
                'label' => 'Título',
                'rules' => 'required',
            ])
            ->add('description', 'textarea', [
                'label' => 'Descrição',
                'rules' => 'required',
            ])
            ->
            add('thumb_file', 'file', [
                'label' => 'Imagem',
                'required' => !$id ? true : false,
                'rules' => $rulesThumbFile,
            ]);
    }
}
