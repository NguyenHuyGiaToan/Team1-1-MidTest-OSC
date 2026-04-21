<x-cay-canh-layout>
    <x-slot name="title">Quản lý sản phẩm</x-slot>

    <div class="container mt-4">
        <h3 class="text-center text-primary mb-3">QUẢN LÝ SẢN PHẨM</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thành công!</strong> {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('caycanh_add') }}" class="btn btn-success mb-3">Thêm</a>

        <table id="id-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Tên khoa học</th>
                    <th>Tên thông thường</th>
                    <th>Độ khó</th>
                    <th>Yêu cầu ánh sáng</th>
                    <th>Nhu cầu nước</th>
                    <th>Giá bán</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody> @foreach($products as $item)
                <tr>
                    <td>{{ $item->ten_san_pham }}</td>
                    <td>{{ $item->ten_khoa_hoc }}</td>
                    <td>{{ $item->ten_thong_thuong }}</td>
                    <td>{{ $item->do_kho }}</td>
                    <td>{{ $item->yeu_cau_anh_sang }}</td>
                    <td>{{ $item->nhu_cau_nuoc }}</td>
                    <td>{{ number_format($item->gia_ban, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <img src="{{ asset('storage/image/' . $item->hinh_anh) }}" width="50">
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('sanpham.show', $item->id) }}">Xem</a>
                        <form action="{{ route('caycanh_delete', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#id-table').DataTable({
                "pageLength": 10, 
                "responsive": true,
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ sản phẩm",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "next": "Tiếp",
                        "previous": "Trước"
                    }
                }
            });
        });
    </script>
</x-cay-canh-layout>