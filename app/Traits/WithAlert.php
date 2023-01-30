<?php

namespace App\Traits;

trait WithAlert
{

    protected function ShowAlert($properties)
    {
        $this->emit('swal-show-alert', $properties);
    }

    protected function showSuccessAlert($text = '')
    {

        $properties = [
            'text' => $text,
            'icon' => 'success',
            'confirmButtonText' => __('OK'),
            'customClass'=> [
                'confirmButton' => "btn btn-success",
            ],
        ];

        $this->ShowAlert($properties);

    }

    protected function showErrorAlert($text = '')
    {

        $properties = [
            'text' => $text,
            'icon' => 'error',
            'confirmButtonText' => __('OK'),
            'customClass' => [
                'confirmButton' => "btn btn-danger",
            ],
        ];

        $this->ShowAlert($properties);

    }

    protected function showWarningAlert($text = '')
    {

        $properties = [
            'text' => $text,
            'icon' => 'warning',
            'confirmButtonText' => __('OK'),
            'customClass' => [
                'confirmButton' => "btn btn-warning",
            ],
        ];

        $this->ShowAlert($properties);

    }

    protected function showInfoAlert($text = '')
    {

        $properties = [
            'text' => $text,
            'icon' => 'info',
            'confirmButtonText' => __('OK'),
            'customClass' => [
                'confirmButton' => "btn btn-info",
            ],
        ];

        $this->ShowAlert($properties);

    }

    protected function showQuestionAlert($text = '')
    {

        $properties = [
            'text' => $text,
            'icon' => 'question',
            'confirmButtonText' => __('OK'),
            'customClass' => [
                'confirmButton' => "btn btn-primary",
            ],
        ];

        $this->ShowAlert($properties);

    }

}
