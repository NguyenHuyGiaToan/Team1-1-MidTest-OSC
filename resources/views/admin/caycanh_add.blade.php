<x-cay-canh-layout>
    <x-slot name="title">
        Cay Canh Add
    </x-slot>
    <style>
        input {
            padding: 5px;
            margin: 5px 0;
            width: 100%;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
        }

        h1 {
            margin-top: 20px;
            color: blue;
            text-transform: uppercase;
            text-align: center;
        }
    </style>
    <h1>Thêm cây cảnh</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 0;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('caycanh_add_func')}}" method="post" enctype="multipart/form-data">
        <label for="">Tên sản phẩm</label> <br>
        <input type="text" name="ten_san_pham" id="" required><br>
        <label for="">Tên khoa học</label> <br>
        <input type="text" name="ten_khoa_hoc" id="" required><br>
        <label for="">Tên thông thường</label> <br>
        <input type="text" name="ten_thong_thuong" id="" required><br>
        <label for="text">Mô tả</label><br>
        <input type="text" name="mo_ta" id="" required><br>
        <label for="">Độ khó</label> <br>
        <input type="text" name="do_kho" id="" required><br>
        <label for="">Yêu cầu ánh sáng</label> <br>
        <input type="text" name="yeu_cau_anh_sang" id="" required><br>
        <label for="">Nhu cầu nước</label> <br>
        <input type="text" name="nhu_cau_nuoc" id="" required><br>
        <label for="">Giá bán</label> <br>
        <input type="number" name="gia_ban" id="" required><br>
        <label for="">Ảnh</label> <br>
        <input type="file" id="imageUpload" name="hinh_anh" required><br>
        {{csrf_field()}}
        <button class="btn btn-primary" type="submit">Thêm</button><br>
    </form>
</x-cay-canh-layout>