<?php

namespace App\DTO\News;

use DateTime;

readonly final class StoreNewsDTO
{

    public function __construct(
        public string $title,
        public string $content,
        public ?string $publishedAt
    ) {
    }
}
