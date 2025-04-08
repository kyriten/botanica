<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function garden()
    {
        return $this->belongsTo(Garden::class);
    }

    public function province()
    {
        return $this->belongsToMany(Province::class);
    }

    public function city()
    {
        return $this->belongsToMany(City::class);
    }

    public function district()
    {
        return $this->belongsToMany(District::class);
    }

    public function village()
    {
        return $this->belongsToMany(Village::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_rempah'
            ]
        ];
    }
}
