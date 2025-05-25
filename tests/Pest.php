<?php

declare(strict_types=1);

use Livewire\Component;
use Daredloco\Toast\Concerns\WireToast;
use Daredloco\Toast\Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');

function createFakeComponent(): void
{
    new class () extends Component {
        use WireToast;

        public function __construct()
        {
            $this->dehydrate(new \Illuminate\Http\Response(request()));
        }
    };
}

function setEnvironment(string $environment = 'testing'): void
{
    app()->detectEnvironment(fn () => $environment);
}
