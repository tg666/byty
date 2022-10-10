<?php

namespace App\View;

use App\Template\TemplateParameters;

final class FilterTemplateParameters extends TemplateParameters {
    public array $filters;

    public array $stairs;

    public array $parts;

    public array $conditions;

    public array $sizes;

    public array $animals;

    public array $balcony;

    public array $elevator;

    public int $sum;

    public string $order;
}