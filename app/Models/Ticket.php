<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
