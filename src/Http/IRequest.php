<?php declare(strict_types=1);

namespace App\Http;

interface IRequest
{
    public function getBody(): ?array;
}
