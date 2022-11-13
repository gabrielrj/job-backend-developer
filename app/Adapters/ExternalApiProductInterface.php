<?php

namespace App\Adapters;

interface ExternalApiProductInterface
{
    function findProductById(int $id) : ?array;

    function getAllProducts() : array;
}
