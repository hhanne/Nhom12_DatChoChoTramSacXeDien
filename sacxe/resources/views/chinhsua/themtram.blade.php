@extends('layouts.admin')

@section('title', 'Thêm Trạm Sạc')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0.5rem 0 0 0;
    }

    .breadcrumb-item {
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: white;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .form-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-header h2 i {
        color: #667eea;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group label i {
        color: #667eea;
        font-size: 1.1rem;
    }

    .form-group label .required {
        color: #ff4757;
        margin-left: 0.2rem;
    }

    .form-control,
    .form-select {
        padding: 0.8rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control:disabled,
    .form-select:disabled {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 2px solid #f0f0f0;
    }

    .btn-back {
        background: #f0f0f0;
        color: #666;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e0e0e0;
        transform: translateY(-2px);
        color: #333;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.8rem 2.5rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        flex: 1;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .info-box {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-left: 4px solid #667eea;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .info-box i {
        color: #667eea;
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    .info-box p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    .invalid-feedback {
        display: block;
        color: #ff4757;
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-back {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1><i class="bi bi-plug-fill"></i> Thêm Trạm Sạc</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('chinhsua.tramsac.index') }}">Quản lý trạm sạc</a></li>
            <li class="breadcrumb-item active">Thêm trạm sạc</li>
        </ol>
    </nav>
</div>

<!-- Info Box -->
<div class="info-box">
    <i class="bi bi-info-circle-fill"></i>
    <p><strong>Lưu ý:</strong> Vui lòng điền đầy đủ thông tin trạm sạc.
        Các trường có dấu <span style="color: #ff4757;">*</span> là bắt buộc.</p>
</div>

<div class="card p-4 shadow-sm">
    <form action="{{ route('chinhsua.tramsac.store') }}" method="POST" enctype="multipart/form-data" id="addStationForm" class="needs-validation" novalidate>
        @csrf

        <!-- Tên trạm -->
        <div class="mb-3">
            <label for="tentram" class="form-label"><i class="bi bi-building-fill"></i> Tên Trạm Sạc <span class="required">*</span></label>
            <input type="text" class="form-control @error('tentram') is-invalid @enderror" id="tentram" name="tentram" placeholder="Nhập tên trạm" required>
            @error('tentram') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Địa chỉ -->
        <div class="mb-3">
            <label for="diachi" class="form-label"><i class="bi bi-geo-alt-fill"></i> Địa Chỉ <span class="required">*</span></label>
            <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" placeholder="Nhập địa chỉ" required>
            @error('diachi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Loại trạm -->
        <div class="mb-3">
            <label for="loaitram" class="form-label"><i class="bi bi-lightning-charge-fill"></i> Loại Trạm <span class="required">*</span></label>
            <select class="form-select @error('loaitram') is-invalid @enderror" id="loaitram" name="loaitram" required>
                <option value="">-- Chọn loại trạm --</option>
                <option value="Nhanh">Sạc nhanh</option>
                <option value="Chậm">Sạc chậm</option>
            </select>
            @error('loaitram') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="trangthai" class="form-label"><i class="bi bi-info-circle-fill"></i> Trạng Thái <span class="required">*</span></label>
            <select class="form-select @error('trangthai') is-invalid @enderror" id="trangthai" name="trangthai" required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="hoatdong">Hoạt động</option>
                <option value="trong">Trống</option>
                <option value="baotri">Bảo trì</option>
            </select>
            @error('trangthai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Số lượng cổng sạc -->
        <div class="mb-3">
            <label for="soluong_congsac" class="form-label"><i class="bi bi-ev-station-fill"></i> Số Lượng Cổng Sạc <span class="required">*</span></label>
            <input type="number" class="form-control @error('soluong_congsac') is-invalid @enderror"
                   id="soluong_congsac" name="soluong_congsac" placeholder="Nhập số cổng sạc" min="1" required>
            @error('soluong_congsac') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Tọa độ -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="toado_lat" class="form-label"><i class="bi bi-crosshair"></i> Latitude <span class="required">*</span></label>
                <input type="number" step="0.000001" class="form-control @error('toado_lat') is-invalid @enderror"
                       id="toado_lat" name="toado_lat" placeholder="VD: 10.823099" required>
                @error('toado_lat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="toado_lng" class="form-label"><i class="bi bi-crosshair"></i> Longitude <span class="required">*</span></label>
                <input type="number" step="0.000001" class="form-control @error('toado_lng') is-invalid @enderror"
                       id="toado_lng" name="toado_lng" placeholder="VD: 106.687399" required>
                @error('toado_lng') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Ảnh -->
        <div class="mb-3">
            <label for="hinhanh_url" class="form-label"><i class="bi bi-image"></i> Ảnh Trạm Sạc</label>
            
            <!-- Nhập link URL -->
            <input type="text" class="form-control mb-2 @error('hinhanh_url') is-invalid @enderror"
                   id="hinhanh_url" name="hinhanh_url" placeholder="https://example.com/image.jpg">
            @error('hinhanh_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Nhập đường dẫn ảnh (URL) hoặc chọn tệp từ máy tính.</small>

            <!-- Hoặc chọn ảnh -->
            <input type="file" class="form-control mt-2" id="hinhanh_file" name="hinhanh_file" accept="image/*">

            <div class="mt-3 text-center">
                <img id="previewImage" src="#" alt="Xem trước ảnh"
                     style="max-width: 250px; display: none; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-primary flex-grow-1">
                <i class="bi bi-check-circle-fill"></i> Thêm Trạm Sạc
            </button>
            <a href="{{ route('chinhsua.tramsac.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
    </form>
</div>

<script>
    // ✅ Kiểm tra form
    document.getElementById('addStationForm').addEventListener('submit', function(e) {
        const form = this;
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            alert('⚠️ Vui lòng điền đầy đủ các trường bắt buộc!');
        }
        form.classList.add('was-validated');
    });

    // ✅ Hiển thị ảnh preview từ URL
    const urlInput = document.getElementById('hinhanh_url');
    const fileInput = document.getElementById('hinhanh_file');
    const previewImg = document.getElementById('previewImage');

    urlInput.addEventListener('input', function() {
        const url = this.value.trim();
        if (url.match(/^https?:\/\/.+\.(jpg|jpeg|png|gif|webp)$/i)) {
            previewImg.src = url;
            previewImg.style.display = 'block';
        } else {
            previewImg.style.display = 'none';
        }
    });

    // ✅ Hiển thị ảnh preview từ file upload
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection