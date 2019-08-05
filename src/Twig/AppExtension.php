<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var string
     */
    private $target_directory;

    public function __construct(string $target_directory)
    {
        $this->target_directory = $target_directory;
    }

    public function getGlobals()
    {
        return [
            'target_directory' => $this->target_directory
        ];
    }

}