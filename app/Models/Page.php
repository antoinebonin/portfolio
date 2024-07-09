<?php

namespace App\Models;

use App\Enum\PageStatutEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'description',
        'blocs',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'statut' => PageStatutEnum::class,
            'blocs' => 'array'
        ];
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('statut', '=', PageStatutEnum::PUBLISH);
    }

    public function getFullUrl(): string
    {
        return config('app.url') . '/' . $this->url;
    }

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFullUrl();
            },
        );
    }
}
