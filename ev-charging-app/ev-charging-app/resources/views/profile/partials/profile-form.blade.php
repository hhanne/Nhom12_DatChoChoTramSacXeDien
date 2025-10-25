<!-- resources/views/profile/partials/profile-form.blade.php -->
<div class="profile-card">
    <h3 class="mb-4">Thông tin cá nhân</h3>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('POST')

        <h5 class="mt-4 mb-3 fs-6 fw-bold text-secondary">Thông tin có thể chỉnh sửa</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="hoten" class="form-label fw-bold">Họ tên</label>
                <input type="text" class="form-control" name="hoten" id="hoten"
                       value="{{ old('hoten', $user->hoten) }}">
            </div>
            <div class="col-md-6">
                <label for="gioitinh" class="form-label fw-bold">Giới tính</label>
                <select class="form-select" name="gioitinh" id="gioitinh">
                    <option value="Nam" {{ $user->gioitinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ $user->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="ngaysinh" class="form-label fw-bold">Ngày sinh</label>
                <input type="date" class="form-control" name="ngaysinh" id="ngaysinh"
                       value="{{ old('ngaysinh', $user->ngaysinh) }}">
            </div>
            <div class="col-md-6">
                <label for="sdt" class="form-label fw-bold">Số điện thoại</label>
                <input type="text" class="form-control" name="sdt" id="sdt"
                       value="{{ old('sdt', $user->sdt) }}">
            </div>
            <div class="col-12">
                <label for="diachi" class="form-label fw-bold">Địa chỉ</label>
                <input type="text" class="form-control" name="diachi" id="diachi"
                       value="{{ old('diachi', $user->diachi) }}">
            </div>
            <div class="col-12">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <h5 class="mt-5 mb-3 fs-6 fw-bold text-secondary">Thông tin tài khoản (Chỉ đọc)</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="trang_thai" class="form-label fw-bold">Trạng thái</label>
                <input type="text" class="form-control" id="trang_thai"
                       value="{{ $user->trang_thai ?? 'Hoạt động' }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="phan_quyen" class="form-label fw-bold">Phân quyền</label>
                <input type="text" class="form-control" id="phan_quyen"
                       value="{{ ucfirst($user->phan_quyen ?? 'user') }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="ngaytaotk" class="form-label fw-bold">Ngày tạo tài khoản</label>
                <input type="text" class="form-control" id="ngaytaotk"
                       value="{{ $user->ngaytaotk ?? 'Không rõ' }}" readonly>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-profile px-4">
                <i class="fas fa-save me-2"></i> Lưu thay đổi
            </button>
            @if (session('success'))
                <span class="text-success fw-bold ms-3">{{ session('success') }}</span>
            @endif
        </div>
    </form>
</div>
