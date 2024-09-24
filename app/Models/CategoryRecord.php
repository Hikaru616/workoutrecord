<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRecord extends Model
{
    use HasFactory;

    protected $table = 'category_record';
    protected $fillable = ['category_id', 'record_id'];//??????????
    public $timestamps = false;

    public function category() {

        return $this->belongsTo(Category::class);
    }
}
