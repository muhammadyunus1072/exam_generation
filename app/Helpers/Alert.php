<?php

namespace App\Helpers;

use Livewire\Component;

class Alert
{
    const EVENT_FAIL_ALERT = 'onFailSweetAlert';
    const EVENT_SUCCESS_ALERT = 'onSuccessSweetAlert';

    public static function success(Component $component, $title, $message)
    {
        $component->dispatch(self::EVENT_SUCCESS_ALERT, [
            'icon' => 'success',
            'title' => $title,
            'text' => $message,
        ]);
    }

    public static function fail(Component $component, $title, $message)
    {
        $component->dispatch(self::EVENT_FAIL_ALERT, [
            'icon' => 'error',
            'title' => $title,
            'text' => $message,
        ]);
    }
}
