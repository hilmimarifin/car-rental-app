<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, "user_id", "id");
    }

    public function car(): BelongsTo
    {
        return $this->BelongsTo(Car::class, "car_id", "id");
    }
}
