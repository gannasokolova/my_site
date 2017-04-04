@extends('admin.general.edit-add')
@section('relationFields')
    <?php
        $model        =  new App\Price;
    ?>
   @include('admin.templates.radio',
    [
    'name'         => 'status',
    'values'       => $model->getEnum(),
    ])
@stop




