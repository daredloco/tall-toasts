<?php

declare(strict_types=1);

namespace Daredloco\Toast\Concerns;

use Daredloco\Toast\ToastManager;

trait WireToast
{
    public function renderedWireToast(): void
    {
        if (! ToastManager::componentRendered()) {
            foreach (ToastManager::pull() ?? [] as $notification) {
                $this->dispatch(
                    'toast',
                    message: $notification['message'],
                    title: $notification['title'],
                    type: $notification['type'],
                    duration: $notification['duration'],
                );
            }
        }
    }
}
