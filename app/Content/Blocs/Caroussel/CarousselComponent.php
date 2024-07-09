<?php

declare(strict_types=1);

namespace App\Content\Blocs\Caroussel;

use App\Content\Bloc;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class CarousselComponent extends Component
{

    public function __construct(
        private readonly Bloc $bloc,
        private array $data
    )
    {
        $this->data['image'] = config('app.url') . Storage::url($this->data['image']);
    }

    /**
     * @inheritDoc
     */
    public function render(): View|Htmlable|string|\Closure
    {
        return $this->view($this->bloc->getPreview(), $this->data);
    }
}
