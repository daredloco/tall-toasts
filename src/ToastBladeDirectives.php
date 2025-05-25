<?php

namespace Daredloco\Toast;

class ToastBladeDirectives
{
    public static function toastScripts(string $expression): string
    {
        return '{!! \Daredloco\Toast\ToastManager::scripts(' . $expression . ') !!}';
    }
}
