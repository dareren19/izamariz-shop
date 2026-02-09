<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property string|null $description
 * @property numeric|null $price
 * @property string|null $image
 * @property string|null $category
 * @property string|null $brand
 * @property int $stock
 * @property int $is_featured
 * @property int $is_new
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatting_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'category',
        'brand',
        'stock',
        'is_featured',
        'is_new',
    ];

    protected $cast = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',

    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getFormattingPriceAttribute(): string
    {
        return 'PHP'. number_format($this->price, 2);
    }
}
