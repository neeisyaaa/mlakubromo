<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'position',
        'address',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active contacts.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include inactive contacts.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope a query to search contacts.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('company', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    /**
     * Get the contact's full display name with company.
     */
    public function getDisplayNameAttribute()
    {
        if ($this->company) {
            return $this->name . ' (' . $this->company . ')';
        }
        
        return $this->name;
    }

    /**
     * Get the contact's status in Indonesian.
     */
    public function getStatusLabelAttribute()
    {
        return $this->status === 'active' ? 'Aktif' : 'Tidak Aktif';
    }

    /**
     * Check if contact is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if contact is inactive.
     */
    public function isInactive()
    {
        return $this->status === 'inactive';
    }
}