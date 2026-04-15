<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_pham';

    protected $fillable = [
        'ten_san_pham',
        'gia',
        'hinh_anh',
        'danh_muc_id',
        'do_kho_cham_soc',
        'yeu_cau_anh_sang',
        'status'
    ];
}