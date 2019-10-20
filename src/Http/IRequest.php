<?php

namespace App\Http;

interface IRequest
{
    public function getBody(): ?array;
}
