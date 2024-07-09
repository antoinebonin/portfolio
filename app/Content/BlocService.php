<?php

declare(strict_types=1);

namespace App\Content;

use Illuminate\Support\Facades\Blade;

class BlocService
{
    private readonly BlocsRepository $blocsRepository;
    public function __construct(
    )
    {
        $this->blocsRepository = new BlocsRepository();
    }

    public static function getAllBlocks(): array
    {
        return array_map(fn (Bloc $bloc) => $bloc->getBlock(), (new self)->blocsRepository->findAll());
    }

    public static function bootComponent():void
    {
        foreach ((new self)->blocsRepository->findAll() as $bloc) {
            Blade::component($bloc->getComponentAlias(), $bloc->getComponentClassName());
        }
    }
}
