<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['customer_name', 'phone', 'flavour', 'guest_count', 'pickup_date', 'cake_message', 'reference_image', 'notes', 'cake_id',
'cake_name',])]
class CakeOrder extends Model
{
    //
}
