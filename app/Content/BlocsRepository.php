<?php

declare(strict_types=1);

namespace App\Content;

use App\Content\Blocs\Caroussel\CarousselBloc;
use App\Content\Blocs\Hero\HeroBloc;
use App\Content\Blocs\Split\SplitBloc;

class BlocsRepository
{
    public const BLOCS = [
        'Split' => SplitBloc::class,
        'Hero' => HeroBloc::class,
        'Caroussel' => CarousselBloc::class,
    ];

    /**
     * @return array<Bloc>
     */
    public function findAll(): array
    {
        return array_map(fn (string $class) => $this->createBloc($class), self::BLOCS);
    }

    public function getByTitle(string $title): Bloc
    {
        if (!array_key_exists($title, self::BLOCS)) {
            throw new \Exception("Impossible de trouver le bloc: $title");
        }

        return $this->createBloc(self::BLOCS[$title]);
    }

    private function createBloc(string $class): Bloc
    {
        return new $class();
    }
}
