<?php

namespace App\Helpers;

use Livewire\Component;

class Alert
{
    const EVENT_INFO = 'SwalFire';

    public static function success(Component $component, $title, $message)
    {
        $component->dispatch(self::EVENT_INFO, 'success', $title, $message);
    }

    public static function fail(Component $component, $title, $message)
    {
        $component->dispatch(self::EVENT_INFO, 'error', $title, $message);
    }
}
