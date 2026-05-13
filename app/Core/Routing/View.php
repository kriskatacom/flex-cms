<?php

namespace Flex\Core\Routing;

class View
{
    public function __construct(
        public string $path,
        public array $data = [],
        public string $layout = 'main'
    ) {
    }

    public static function make(string $path, array $data = [], string $layout = 'main'): self
    {
        return new self($path, $data, $layout);
    }

    public static function redirect(string $url, int $code = 302): void
    {
        header("Location: " . $url, true, $code);
        exit;
    }
}