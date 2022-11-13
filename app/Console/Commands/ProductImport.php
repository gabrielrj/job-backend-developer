<?php

namespace App\Console\Commands;

use App\Adapters\ExternalApiProductInterface;
use App\Adapters\FakeStoreApi;
use App\Models\Product;
use Illuminate\Console\Command;

class ProductImport extends Command
{
    protected ExternalApiProductInterface $apiProduct;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiProduct = new FakeStoreApi('https://fakestoreapi.com');

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $id = $this->option('id');

            if($id)
                $product = $this->apiProduct->findProductById($id);
            else
                $products = $this->apiProduct->getAllProducts();

            if(isset($product)) {
                Product::createNewProduct(['name' => $product['title'], 'price' => $product['price'], 'category' => $product['category'], 'description' => $product['description'], 'image_url' => $product['image']]);

                $this->info('Produto cadastrado com sucesso!');
            }
            elseif(isset($products)){
                foreach ($products as $product){
                    Product::createNewProduct(['name' => $product['title'], 'price' => $product['price'], 'category' => $product['category'], 'description' => $product['description'], 'image_url' => $product['image']]);
                }

                $this->info('Produtos cadastrados com sucesso!');
            } else $this->error('No products were found in the external api using the parameters informed.');

            exit();

        }catch (\Exception | \Throwable $exception){
            $this->error($exception->getMessage());
        }
    }
}
