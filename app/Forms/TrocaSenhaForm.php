<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class TrocaSenhaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('senha1', 'password' , [
                'label' => 'Senha',
                'rules' => 'required|min:2',
            ])
            ->add('senha2', 'password', [
                'label' => 'Confirme sua senha',
                'rules' => 'required|min:2',
            ]);
    }
}