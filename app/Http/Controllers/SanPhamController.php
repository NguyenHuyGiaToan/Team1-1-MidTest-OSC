<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;

class SanPhamController extends Controller
{
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa!');
        }

        $products = SanPham::where('ten_san_pham', 'LIKE', '%' . $keyword . '%')
                    ->orderBy('ten_san_pham', 'asc')
                    ->get();

        return view('search', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }
}