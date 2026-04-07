<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category',
        'description',
        'nis',
        'location',
        'incident_date',
        'status',
        'feedback'
    ];

    protected $casts = [
    'incident_date' => 'date',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}