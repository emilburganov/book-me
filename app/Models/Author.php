<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function getFullnameAttribute()
    {
        return ucwords("{$this->surname} {$this->name} {$this->patronymic}");
    }

    protected $guarded = false;
}
