<?php

namespace App\Service;

class SluggerService
{
    public function slugify(string $text): string
    {
        return strtolower(str_replace(' ', '-', $text));
    }
}
