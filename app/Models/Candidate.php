<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'image_url', 'title', 'slug',
        'chairman', 'vice_chairman', 'vision', 'mision'
    ];

    public static function boot()
    {
        parent::boot();

        // Handle saat kandidat dibuat
        static::creating(function ($candidate) {
            $candidate->slug = static::generateUniqueSlug($candidate->title);
        });

        // Handle saat kandidat diperbarui (edit)
        static::updating(function ($candidate) {
            if ($candidate->isDirty('title')) { // Jika title berubah, update slug
                $candidate->slug = static::generateUniqueSlug($candidate->title, $candidate->id);
            }
        });
    }

    // Fungsi untuk membuat slug unik
    private static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada di database
        while (static::where('slug', $slug)->where('id', '!=', $excludeId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Relasi ke User (Candidate milik satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Gunakan slug sebagai key dalam routing
    public function getRouteKeyName()
    {
        return 'slug';
    }
}