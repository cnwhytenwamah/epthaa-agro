<?php

namespace App\Models;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 
        'user_id', 
        'client_name', 
        'client_phone', 
        'client_email',
        'animal_type', 
        'location', 
        'preferred_date', 
        'preferred_time',
        'issue_description', 
        'status', 
        'admin_notes'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'datetime'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
