<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function reservations(): HasMany
    {
        return $this->HasMany(Reservation::class, "car_id", "id");
    }
}
