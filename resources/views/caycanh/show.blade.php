<x-cay-canh-layout>
    <x-slot name="title">
        {{ $sanPham->ten_san_pham }}
    </x-slot>

    <style>
        .container { max-width: 1200px; margin: 0 auto; font-family: Arial, sans-serif; padding-top: 20px; }
        
        /* Navbar (tái sử dụng từ trang chủ) */
        .banner img { width: 100%; border-radius: 4px; display: block; margin-bottom: 20px; object-fit: cover; }
        .navbar { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding: 12px 0; margin-bottom: 30px; }
        .nav-menu a { text-decoration: none; color: #555; font-weight: bold; margin-right: 20px; font-size: 15px; }
        .nav-menu a:hover { color: #28a745; }
        .nav-actions { display: flex; align-items: center; gap: 20px; }
        .search-input { padding: 8px 15px; border: 1px solid #ccc; border-radius: 20px; outline: none; width: 220px; }
        .cart { position: relative; font-size: 22px; color: #28a745; cursor: pointer; }
        .cart-count { position: absolute; top: -6px; right: -10px; background: #28a745; color: #fff; font-size: 11px; padding: 2px 6px; border-radius: 50%; font-weight: bold;}
        .user-btn { background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; display: flex; align-items: center; gap: 5px; text-decoration: none;}

        /* Product Detail Layout */
        .product-detail { display: flex; gap: 30px; margin-bottom: 50px; }
        .product-image { flex: 0 0 40%; background: #9db2bf; display: flex; justify-content: center; align-items: center; padding: 20px; }
        .product-image img { max-width: 100%; object-fit: contain; }
        
        .product-info { flex: 1; color: #333; line-height: 1.6; }
        .product-info h1 { font-size: 24px; margin-top: 0; margin-bottom: 15px; }
        .product-info p { margin-bottom: 8px; font-size: 15px; }
        .price-text { color: #d32f2f; font-weight: bold; font-style: italic; }
        
        /* Add to Cart Form */
        .cart-form { display: flex; align-items: center; gap: 15px; margin-top: 20px; }
        .qty-input { width: 60px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 15px; text-align: center; }
        .btn-add-cart { background: #007bff; color: white; border: none; padding: 10px 20px; font-size: 15px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-add-cart:hover { background: #0056b3; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    </style>

    <div class="container">
        <div class="banner">
            <img src="{{ asset('storage/image/banner.jpg') }}" alt="Banner" onerror="this.style.display='none'">
        </div>

        

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="product-detail">
            <div class="product-image">
                <img src="{{ asset('storage/image/' . $sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
            </div>
            <div class="product-info">
                <h1>{{ $sanPham->ten_san_pham }}</h1>
                <p>Tên khoa học: {{ $sanPham->ten_khoa_hoc }}</p>
                <p>Tên thông thường: {{ $sanPham->ten_thong_thuong }}</p>
                <p>Mô tả: {{ $sanPham->mo_ta }}</p>
                <p>Quy cách sản phẩm: {{ $sanPham->quy_cach_san_pham }}</p>
                <p>Độ khó: {{ $sanPham->do_kho }}</p>
                <p>Yêu cầu ánh sáng: {{ $sanPham->yeu_cau_anh_sang }}</p>
                <p>Nhu cầu nước: {{ $sanPham->nhu_cau_nuoc }}</p>
                <p>Giá: <span class="price-text">{{ number_format($sanPham->gia_ban, 0, ',', '.') }} VNĐ</span></p>

                <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $sanPham->id }}">
                    <label for="so_luong">Số lượng mua:</label>
                    <input type="number" name="so_luong" id="so_luong" value="1" min="1" class="qty-input">
                    <button type="submit" class="btn-add-cart">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
    </div>
</x-cay-canh-layout>