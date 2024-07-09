<?php

declare(strict_types=1);

namespace App\Content;

abstract class BaseBloc implements Bloc
{
    public function getCustomBladeNamespace(): string
    {
        return 'bloc::';
    }
    public function getCustomComponentNamespace(): string
    {
        return 'bloc';
    }
}
