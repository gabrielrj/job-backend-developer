<?php

namespace App\Adapters;

use Illuminate\Support\Facades\Http;
use Throwable;

class FakeStoreApi implements ExternalApiProductInterface
{
    protected $urlApi;

    public function __construct($urlApi)
    {
        $this->urlApi = $urlApi;
    }

    /**
     * @throws Throwable
     */
    function findProductById(int $id): ?array
    {
        throw_if(!$id, new \Exception('Please enter a valid id.'));

        $endpoint = "$this->urlApi/products/$id";

        $request = Http::get($endpoint);

        throw_if(!$request->ok(), 'An error occurred while trying to make this request to the external API.');

        return $request->json();
    }

    /**
     * @throws Throwable
     */
    function getAllProducts(): array
    {
        $endpoint = "$this->urlApi/products";

        $request = Http::get($endpoint);

        throw_if(!$request->ok(), 'An error occurred while trying to make this request to the external API.');

        return $request->json();
    }
}
