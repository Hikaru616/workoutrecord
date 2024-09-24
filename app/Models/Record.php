<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public function categoryRecord() {

        return $this->hasMany(CategoryRecord::class);
    }

    public function hasRecordPost(){

        return $this->categoryRecord()->exists();
    }
}
