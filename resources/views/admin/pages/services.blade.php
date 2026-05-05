@extends('layouts.admin')

@section('title', 'إدارة الخدمات')
@section('page_title', 'إدارة الخدمات')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الخدمات الحالية</h3>
        <button class="admin-btn primary" onclick="openServiceModal()"><i class="fas fa-plus"></i> إضافة خدمة جديدة</button>
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>الأيقونة</th>
                        <th>اسم الخدمة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody id="servicesTableBody">
                    @foreach($services as $service)
                    <tr data-id="{{ $service->id }}">
                        <td>
                            @if(str_starts_with($service->icon, '/uploads/'))
                                <img src="{{ $service->icon }}" style="width:40px; height:40px; border-radius:4px; object-fit:cover">
                            @else
                                <i class="fas {{ $service->icon }} text-gold"></i>
                            @endif
                        </td>
                        <td>{{ $service->name }}</td>
                        <td>
                            @if($service->is_active)
                                <span class="status-badge status-done">نشط</span>
                            @else
                                <span class="status-badge status-cancel">متوقف</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="editService({{ json_encode($service) }})"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" onclick="deleteService({{ $service->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $services->links() }}
        </div>
    </div>
</div>

<!-- Service Modal -->
<div class="admin-modal-overlay" id="serviceModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-broom"></i></div> <span id="serviceModalTitle">إضافة خدمة جديدة</span></h3>
            <button class="admin-modal-close" onclick="closeServiceModal()">&times;</button>
        </div>
        <form id="serviceForm" onsubmit="handleServiceSubmit(event)">
            <input type="hidden" name="id" id="serviceId">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>اسم الخدمة</label>
                        <input type="text" name="name" id="serviceName" required placeholder="مثال: تنظيف منازل">
                    </div>
                    <div class="form-group-admin">
                        <label>أيقونة الخدمة</label>
                        <select name="icon" id="serviceIcon" required>
                            <option value="fa-broom">🧹 مكنسة (تنظيف عام)</option>
                            <option value="fa-home">🏠 منزل (تنظيف منازل)</option>
                            <option value="fa-spray-can">🧴 بخاخ (تعقيم وتطهير)</option>
                            <option value="fa-soap">🧼 صابون (غسيل وتنظيف)</option>
                            <option value="fa-water">💧 ماء (غسيل خزانات/سجاد)</option>
                            <option value="fa-couch">🛋️ كنب (تنظيف مجالس)</option>
                            <option value="fa-leaf">🍃 ورقة شجر (مواد صديقة للبيئة)</option>
                            <option value="fa-building">🏢 مبنى (تنظيف واجهات/شركات)</option>
                            <option value="fa-brush">🖌️ فرشاة (جلي وتلميع)</option>
                            <option value="fa-bug">شرات (مكافحة حشرات)</option>
                            <option value="fa-sparkles">✨ بريق (تلميع ونظافة فائقة)</option>
                            <option value="fa-shield-alt">🛡️ درع (حماية وضمان)</option>
                            <option value="fa-trash">🗑️ سلة مهملات (نقل مخلفات)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>صورة الخدمة (اختياري - سيتم تجاهل الأيقونة إذا رفعت صورة)</label>
                    <div style="display:flex; gap:15px; align-items:center; background:var(--gray-100); padding:15px; border-radius:8px">
                        <div id="servicePreview" style="width:60px; height:60px; background:#ddd; border-radius:8px; overflow:hidden">
                            <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#888; font-size:12px">لا توجد</div>
                        </div>
                        <div style="flex:1">
                            <input type="file" name="image_file" id="serviceImageFile" accept="image/*" onchange="previewServiceImage(event)">
                        </div>
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>الوصف</label>
                    <textarea name="description" id="serviceDescription" rows="3" placeholder="وصف مختصر للخدمة..."></textarea>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="serviceIsActive" style="width:auto" value="1" checked> خدمة نشطة
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeServiceModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ الخدمة</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openServiceModal = function() {
    $('#serviceForm')[0].reset();
    $('#serviceId').val('');
    $('#servicePreview').html('<div style="display:flex; align-items:center; justify-content:center; height:100%; color:#888; font-size:12px">لا توجد</div>');
    $('#serviceModalTitle').text('إضافة خدمة جديدة');
    $('#serviceModal').addClass('open');
}

window.previewServiceImage = function(event) {
    if(event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#servicePreview').html(`<img src='${e.target.result}' style='width:100%; height:100%; object-fit:cover'>`);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}

window.closeServiceModal = function() {
    $('#serviceModal').removeClass('open');
}

window.editService = function(service) {
    $('#serviceId').val(service.id);
    $('#serviceName').val(service.name);
    $('#serviceIcon').val(service.icon);
    $('#serviceDescription').val(service.description);
    $('#serviceIsActive').prop('checked', service.is_active);
    
    if(service.icon && service.icon.startsWith('/uploads/')) {
        $('#servicePreview').html(`<img src='${service.icon}' style='width:100%; height:100%; object-fit:cover'>`);
    } else {
        $('#servicePreview').html('<div style="display:flex; align-items:center; justify-content:center; height:100%; color:#888; font-size:12px">أيقونة</div>');
    }

    $('#serviceModalTitle').text('تعديل الخدمة');
    $('#serviceModal').addClass('open');
}

window.deleteService = function(id) {
    if(confirm('هل أنت متأكد من حذف هذه الخدمة؟')) {
        $.ajax({
            url: `/admin/services/${id}`,
            method: 'POST',
            data: { _method: 'DELETE' },
            success: function() {
                showNotif('تم حذف الخدمة بنجاح ✅');
                location.reload();
            }
        });
    }
}

window.handleServiceSubmit = function(e) {
    e.preventDefault();
    const form = $('#serviceForm')[0];
    const formData = new FormData(form);
    const id = $('#serviceId').val();
    const url = id ? `/admin/services/${id}` : '/admin/services';
    
    // Handle checkbox
    formData.set('is_active', $('#serviceIsActive').is(':checked') ? '1' : '0');

    const btn = $(form).find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            showNotif('تم حفظ الخدمة بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        },
        error: function(xhr) {
            if (xhr.status === 422 && xhr.responseJSON) {
                showRemoteErrors(xhr.responseJSON.errors, $(form));
                showNotif('يرجى التحقق من الحقول المطلوبة', 'error');
            } else {
                showNotif('حدث خطأ في النظام، يرجى المحاولة لاحقاً', 'error');
            }
            btn.prop('disabled', false).html('حفظ الخدمة');
        }
    });
}
</script>
@endsection
