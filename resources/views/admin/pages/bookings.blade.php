@extends('layouts.admin')

@section('title', 'طلبات الخدمة')
@section('page_title', 'إدارة طلبات الخدمة')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الطلبات الواردة</h3>
    </div>
    <div class="admin-card-body">
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>العميل</th>
                        <th>رقم الهاتف</th>
                        <th>الخدمة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <strong>{{ $booking->name }}</strong>
                            <div style="font-size:12px;color:var(--gray-500)">{{ $booking->created_at->format('Y-m-d H:i') }}</div>
                        </td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->service }}</td>
                        <td>
                            <select onchange="updateBookingStatus({{ $booking->id }}, this.value)" style="padding:4px 8px; border-radius:4px; border:1px solid var(--gray-300)">
                                <option value="جديد" {{ $booking->status == 'جديد' ? 'selected' : '' }}>جديد</option>
                                <option value="قيد المعالجة" {{ $booking->status == 'قيد المعالجة' ? 'selected' : '' }}>قيد المعالجة</option>
                                <option value="تم التنفيذ" {{ $booking->status == 'تم التنفيذ' ? 'selected' : '' }}>تم التنفيذ</option>
                                <option value="ملغي" {{ $booking->status == 'ملغي' ? 'selected' : '' }}>ملغي</option>
                            </select>
                        </td>
                        <td>
                            <button class="action-btn delete" onclick="deleteBooking({{ $booking->id }})"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.updateBookingStatus = function(id, status) {
    $.ajax({
        url: `/admin/bookings/${id}/status`,
        method: 'POST',
        data: { status: status },
        success: function() {
            showNotif('تم تحديث حالة الطلب ✅');
        }
    });
}

window.deleteBooking = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/bookings/${id}`,
            method: 'POST',
            data: { _method: 'DELETE' },
            success: function() {
                showNotif('تم حذف الطلب بنجاح ✅');
                location.reload();
            }
        });
    }
}
</script>
@endsection
