<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\OrderSuccessNotification;

class HomeController extends Controller
{
    // 1. TRANG CHỦ: Hiển thị 20 sản phẩm & Xử lý tất cả bộ lọc
    public function index(Request $request)
    {
        // Lấy danh sách danh mục để in ra Menu
        $danhMucs = DB::table('danh_muc')->get();

        // Khởi tạo query lấy sản phẩm
        $query = DB::table('san_pham');

        // Xử lý Lọc theo Danh mục (nếu người dùng click vào menu)
        if ($request->has('id_danh_muc')) {
            $query->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
                  ->where('sanpham_danhmuc.id_danh_muc', $request->id_danh_muc)
                  ->select('san_pham.*'); 
        }

        // Xử lý Lọc "Dễ chăm sóc"
        if ($request->has('de_cham_soc')) {
            $query->where('do_kho', 'like', '%dễ chăm sóc%');
        }

        // Xử lý Lọc "Chịu được bóng râm"
        if ($request->has('bong_ram')) {
            $query->where('yeu_cau_anh_sang', 'like', '%bóng râm%');
        }

        // Xử lý Sắp xếp Giá
        if ($request->has('sort_gia')) {
            if ($request->sort_gia == 'asc') {
                $query->orderBy('gia_ban', 'asc');
            } elseif ($request->sort_gia == 'desc') {
                $query->orderBy('gia_ban', 'desc');
            }
        }

        // Lấy ra dữ liệu và Phân trang (20 sản phẩm/trang theo yêu cầu)
        $sanPhams = $query->paginate(20);

        return view("caycanh.index", compact('sanPhams', 'danhMucs'));
    }

    // 2. CHI TIẾT SẢN PHẨM
    public function show($id)
    {
        $danhMucs = DB::table('danh_muc')->get();
        $sanPham = DB::table('san_pham')->where('id', $id)->first();

        if (!$sanPham) {
            abort(404);
        }

        return view('caycanh.show', compact('sanPham', 'danhMucs'));
    }

    // 3. THÊM VÀO GIỎ HÀNG
    public function addToCart(Request $request)
    {
        $id = $request->input('product_id');
        $quantity = $request->input('so_luong', 1);

        $sanPham = DB::table('san_pham')->where('id', $id)->first();
        if(!$sanPham) abort(404);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['so_luong'] += $quantity;
        } else {
            $cart[$id] = [
                "ten_san_pham" => $sanPham->ten_san_pham,
                "so_luong" => $quantity,
                "gia_ban" => $sanPham->gia_ban,
                "hinh_anh" => $sanPham->hinh_anh
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // 4. TRANG GIỎ HÀNG (Bạn đang thiếu hàm này)
    public function cart()
    {
        $danhMucs = DB::table('danh_muc')->get();
        $cart = session()->get('cart', []);
        
        $total = 0;
        foreach($cart as $item) {
            $total += $item['gia_ban'] * $item['so_luong'];
        }

        return view('caycanh.cart', compact('cart', 'total', 'danhMucs'));
    }

    // 5. XÓA SẢN PHẨM KHỎI GIỎ (Bạn đang thiếu hàm này)
    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Đã xóa sản phẩm.');
        }
    }

    // 6. XỬ LÝ ĐẶT HÀNG 
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        // Lưu đơn hàng (Mặc định User Kiên có ID = 1 trong DB của bạn)
        $maDonHang = DB::table('don_hang')->insertGetId([
            'ngay_dat_hang' => now(),
            'tinh_trang' => 0,
            'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
            'user_id' => 1 
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($cart as $id => $item) {
            DB::table('chi_tiet_don_hang')->insert([
                'ma_don_hang' => $maDonHang,
                'id_san_pham' => $id,
                'so_luong' => $item['so_luong'],
                'don_gia' => $item['gia_ban']
            ]);
        
        }
        

        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Đặt hàng thành công! Cảm ơn bạn đã mua sắm.');
    }
}