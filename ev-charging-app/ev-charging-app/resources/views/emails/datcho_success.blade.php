@component('mail::message')
# Xin chào {{ $user->name }},

Bạn đã **đặt chỗ thành công** tại trạm **{{ $datCho->tramSac->tentram }}**.

- **Cổng sạc:** {{ $datCho->congSac->tencong }} ({{ $datCho->congSac->loaicong }})
- **Thời gian:** {{ $datCho->timebatdau }} → {{ $datCho->timeketthuc }}
- **Phương thức thanh toán:** {{ ucfirst($datCho->phuongthuc_thanhtoan) }}
- **Tổng tiền:** **{{ number_format($sotien, 0, ',', '.') }} VNĐ**

Cảm ơn bạn đã sử dụng dịch vụ ⚡

Trân trọng,  
**Đội ngũ Trạm Sạc Điện**
@endcomponent
