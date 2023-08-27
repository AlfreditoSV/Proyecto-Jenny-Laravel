<?php
namespace App\Traits;

Trait Alerts{

    static function alert($icon,$title,$text){
        $data=[
            'icon' => 'success',
            'title' => 'Éxito',
            'text' => 'El elemento ha sido eliminado.',
        ];
        return $data;
    }
}