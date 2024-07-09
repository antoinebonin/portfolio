<?php

declare(strict_types=1);

namespace App\Content\Blocs\Split;

use App\Content\Bloc;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SplitComponent extends Component
{

    public function __construct(
        private readonly Bloc $bloc,
        private readonly array $data
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function render(): View|Htmlable|string|\Closure
    {
        return $this->view($this->bloc->getPreview(), $this->data);
    }
}
