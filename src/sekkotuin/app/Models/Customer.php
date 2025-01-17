<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = ['last_name', 'first_name', 'last_name_kana', 'first_name_kana', 'postcode', 'address', 'tel', 'birth', 'gender', 'memo', 'delete_flg'];

    public function scopeSearchByName($query, $keyword)
    {
        if ($keyword) {
            return $query->where(function ($query) use ($keyword) {
                $query->where('last_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('last_name_kana', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('first_name_kana', 'LIKE', '%' . $keyword . '%')
                    ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'LIKE', '%' . $keyword . '%') // 苗字+名前
                    ->orWhere(DB::raw("CONCAT(last_name_kana, first_name_kana)"), 'LIKE', '%' . $keyword . '%'); // 苗字カナ+名前カナ
            });
        }

        return $query;
    }
}