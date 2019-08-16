<?php
namespace App\Entity;

interface SlugifyInterface
{
    public function setSlug(string $slug);

    public function getSlug();

    public function getSlugFields(): array;

}