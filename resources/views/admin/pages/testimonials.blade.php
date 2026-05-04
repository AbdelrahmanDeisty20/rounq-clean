@extends('layouts.admin')

@section('title', 'آراء العملاء')
@section('page_title', 'إدارة آراء العملاء')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الآراء الحالية</h3>
        <button class="admin-btn primary" onclick="openTestimonialModal()"><i class="fas fa-plus"></i> إضافة رأي جديد</button>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>العميل</th>
                    <th>الخدمة</th>
                    <th>التقييم</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->service }}</td>
                    <td>{{ $item->rating }} / 5</td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" onclick="editTestimonial({{ json_encode($item) }})"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete" onclick="deleteTestimonial({{ $item->id }})"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Testimonial Modal -->
<div class="admin-modal-overlay" id="testimonialModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fas fa-star"></i> <span id="testimonialModalTitle">إضافة رأي جديد</span></h3>
            <button class="admin-modal-close" onclick="closeTestimonialModal()">&times;</button>
        </div>
        <form id="testimonialForm" onsubmit="handleTestimonialSubmit(event)">
            <input type="hidden" name="id" id="testimonialId">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>اسم العميل</label>
                        <input type="text" name="name" id="testimonialName" required>
                    </div>
                    <div class="form-group-admin">
                        <label>الخدمة المرتبطة</label>
                        <select name="service" id="testimonialService" required>
                            <option value="">-- اختر الخدمة --</option>
                            @foreach($services as $svc)
                                <option value="{{ $svc->name }}">{{ $svc->name }}</option>
                            @endforeach
                            <option value="عميل مميز">عميل مميز (بدون خدمة محددة)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>الرأي</label>
                    <textarea name="content" id="testimonialContent" rows="3" required></textarea>
                </div>
                <div class="form-group-admin">
                    <label>التقييم (1-5)</label>
                    <input type="number" name="rating" id="testimonialRating" min="1" max="5" value="5" required>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="testimonialIsActive" value="1" checked> نشط
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeTestimonialModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ الرأي</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openTestimonialModal = function() {
    $('#testimonialForm')[0].reset();
    $('#testimonialId').val('');
    $('#testimonialModalTitle').text('إضافة رأي جديد');
    $('#testimonialModal').addClass('open');
}

window.closeTestimonialModal = function() {
    $('#testimonialModal').removeClass('open');
}

window.editTestimonial = function(item) {
    $('#testimonialId').val(item.id);
    $('#testimonialName').val(item.name);
    $('#testimonialService').val(item.service);
    $('#testimonialContent').val(item.content);
    $('#testimonialRating').val(item.rating);
    $('#testimonialIsActive').prop('checked', item.is_active);
    $('#testimonialModalTitle').text('تعديل الرأي');
    $('#testimonialModal').addClass('open');
}

window.handleTestimonialSubmit = function(e) {
    e.preventDefault();
    const form = $('#testimonialForm');
    const id = $('#testimonialId').val();
    const url = id ? `/admin/testimonials/${id}` : '/admin/testimonials';
    
    const formData = form.serializeArray();
    const cleanData = {};
    formData.forEach(item => {
        if (item.name !== 'is_active') {
            cleanData[item.name] = item.value;
        }
    });
    cleanData['is_active'] = $('#testimonialIsActive').is(':checked') ? 1 : 0;

    const btn = form.find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    $.ajax({
        url: url,
        method: 'POST',
        data: cleanData,
        timeout: 15000,
        success: function() {
            showNotif('تم حفظ الرأي بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        },
        error: function(xhr) {
            if (xhr.status === 422 && xhr.responseJSON) {
                showRemoteErrors(xhr.responseJSON.errors, form);
                showNotif('يرجى التحقق من الحقول المطلوبة', 'error');
            } else {
                showNotif('حدث خطأ (' + xhr.status + ')، يرجى المحاولة لاحقاً', 'error');
            }
            btn.prop('disabled', false).text('حفظ الرأي');
        }
    });
}

window.deleteTestimonial = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/testimonials/${id}`,
            method: 'POST',
            data: { _method: 'DELETE' },
            success: function() {
                showNotif('تم الحذف بنجاح ✅');
                location.reload();
            }
        });
    }
}
</script>
@endsection
