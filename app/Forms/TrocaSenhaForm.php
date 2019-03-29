<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class TrocaSenhaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password' , [
                'label' => 'Senha',
                'rules' => 'required|min:6|confirmed',
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Confirme sua senha',
                'rules' => 'required|min:6',
            ]);
    }
}