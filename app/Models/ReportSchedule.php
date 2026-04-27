<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReportSchedule extends Model
{
    protected $fillable = ['name', 'type', 'value', 'phone_override', 'is_active', 'last_sent_at'];
    protected $casts = ['is_active' => 'boolean', 'last_sent_at' => 'datetime'];
}