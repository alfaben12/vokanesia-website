<?php

namespace App\Modules\Form;

use TCG\Voyager\FormFields\AbstractHandler;

class Choser extends AbstractHandler
{
    protected $codename = 'choser';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('_partials.form.choser', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}