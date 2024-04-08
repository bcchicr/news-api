<?php

namespace App\DTO\News;

readonly final class UpdateNewsDTO
{
    public function __construct(
        public string $title,
        public string $content,
        public ?string $publishedAt
    ) {
    }
}
