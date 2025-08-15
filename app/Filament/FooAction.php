<?php

declare(strict_types=1);

namespace App\Filament;

use Closure;
use Exception;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Log;

final class FooAction extends Action
{
    protected Closure $foo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->foo(function () {
            Log::info('Record', $this->getRecord()?->toArray() ?? []);

            return true;
        });

        $this->disabled(fn () => $this->getFoo());
    }


    public function foo(Closure $foo): void
    {
        $this->foo = $foo;
    }

    /**
     * @throws Exception
     */
    public function getFoo(): mixed
    {
        return $this->evaluate($this->foo);
    }
}
