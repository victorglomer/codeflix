<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoriasForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text');
    }
}
