<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

//    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'options->enabled',
        'delay'
    ];

// Không muốn có created_at, updated_at
//    public $timestamps = false;

// Id không tự động tăng
//    public $incrementing = false;

// Trường hợp 1 cột trong table được tạo là nullable nhưng vẫn muốn có dữ liệu default thì sử dụng
    protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
}

