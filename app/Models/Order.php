<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $order_number
 * @property string $guest_name
 * @property string $guest_email
 * @property string|null $guest_phone
 * @property string $shipping_address
 * @property numeric $subtotal
 * @property numeric $total
 * @property string $currency
 * @property string $status
 * @property string|null $hitpay_payment_id
 * @property string|null $hitpay_payment_request_id
 * @property string|null $paid_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereGuestEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereGuestName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereGuestPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereHitpayPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereHitpayPaymentRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
     protected $fillable =[
        'order_number',
        'guest_name',
        'guest_email',
        'guest_phone',
        'shipping_address',
        'subtotal',
        'total',
        'currency',
        'status',
        'hitpay_payment_request_id',
        'hitpay_payment_id',
        'paid_at',
    ];

    protected $cast =[
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        return 'ORD-'.strtoupper(uniqid());
    }
}
