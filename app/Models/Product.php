<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'image_url'
    ];

    // Scopes
    public function scopeGetAllWithNameOrCategory(Builder $query, $searchText): Builder
    {
        return $query->where('name', 'like', "%$searchText%")
            ->orWhere('category', 'like', "%$searchText%");
    }

    public function scopeGetAllWithSpecificCategory(Builder $query, $searchText): Builder
    {
        return $query->where('category', 'like', "%$searchText%");
    }

    public function scopeGetAllWithImage(Builder $query): Builder
    {
        return $query->whereNotNull('image_url');
    }

    public function scopeGetAllWithoutImage(Builder $query): Builder
    {
        return $query->whereNull('image_url');
    }

    // Methods

    /**
     * Persist new product in DB
     *
     * @param array @payload [string name, float price, string description, string category, string|null $image_url]
     * @return Builder|Model
     */
    public static function createNewProduct(array $payload) : Product
    {
        return self::query()->create([
            'name' => $payload['name'],
            'price' => $payload['price'],
            'description' => $payload['description'],
            'category' => $payload['category'],
            'image_url' => Arr::exists($payload, 'image_url') ? $payload['image_url'] : null
        ]);

    }

    /**
     * Saves changes to a product's data in the database.
     *
     * @param array @payload [string name, float price, string description, string category, string|null $image_url]
     * @return bool
     */
    public function updateProduct(array $payload): bool
    {
        return $this->update([
            'name' => $payload['name'],
            'price' => $payload['price'],
            'description' => $payload['description'],
            'category' => $payload['category'],
            'image_url' => Arr::exists($payload, 'image_url') ? $payload['image_url'] : null
        ]);
    }
}
