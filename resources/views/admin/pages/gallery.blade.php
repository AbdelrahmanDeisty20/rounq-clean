@extends('layouts.admin')

@section('title', 'معرض الصور')
@section('page_title', 'إدارة معرض الصور')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الصور الحالية</h3>
        <button class="admin-btn primary" onclick="openGalleryModal()"><i class="fas fa-plus"></i> إضافة صورة جديدة</button>
    </div>
    <div class="admin-card-body">
        <div class="gallery-grid">
            @foreach($gallery as $img)
            <div class="gallery-item" style="height:220px; display:flex; flex-direction:column; background:white; border-radius:12px; border:1px solid #e2e8f0; position:relative; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.02)">
                <div style="flex:1; width:100%; display:flex; align-items:center; justify-content:center; background:#f8fafc; overflow:hidden">
                    @if($img->url)
                        <img src="{{ asset($img->url) }}" style="width:100%; height:100%; object-fit:cover">
                    @elseif($img->icon)
                        <i class="fas {{ $img->icon }}" style="font-size:40px; color:#94a3b8"></i>
                    @endif
                </div>
                <div style="padding:10px; text-align:center; background:white; border-top:1px solid #f1f5f9">
                    <div style="font-weight:700; color:#475569; font-size:13px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
                        {{ $img->title ?: 'بدون عنوان' }}
                    </div>
                </div>
                <div class="gallery-overlay-btns" style="position:absolute; top:8px; left:8px; display:flex; gap:5px">
                    <button class="action-btn edit" onclick="editGallery({{ json_encode($img) }})" style="background:rgba(14,165,233,0.9); color:white; border:none; width:28px; height:28px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete" onclick="deleteGallery({{ $img->id }})" style="background:rgba(239,83,80,0.9); color:white; border:none; width:28px; height:28px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $gallery->links() }}
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div class="admin-modal-overlay" id="galleryModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fas fa-images"></i> إضافة صورة جديدة</h3>
            <button class="admin-modal-close" onclick="closeGalleryModal()">&times;</button>
        </div>
        <form id="galleryForm" onsubmit="handleGallerySubmit(event)" enctype="multipart/form-data">
            <input type="hidden" name="id" id="galleryId">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>عنوان الخدمة (مثلاً: تنظيف فلل)</label>
                    <input type="text" name="title" id="galleryTitle" required placeholder="اكتب عنوان الخدمة هنا">
                </div>
                <div class="form-group-admin">
                    <label>نوع العرض</label>
                    <select id="galleryType" onchange="toggleGalleryInputs()" style="padding: 10px; border-radius: 8px; border: 1.5px solid var(--gray-200); width: 100%;">
                        <option value="icon">أيقونة رمزية (الوضع الحالي)</option>
                        <option value="image">صورة حقيقية (من جهازك)</option>
                    </select>
                </div>

                <div id="iconInputGroup" class="form-group-admin">
                    <label>اختر الأيقونة المعبرة</label>
                    <select name="icon" id="galleryIcon" style="font-family: 'Font Awesome 5 Free', 'Tajawal', sans-serif; font-weight: 900; font-size: 16px; padding: 10px;">
                        <optgroup label="أيقونات المساعدة واليد">
                            <option value="fa-hands-helping">🤝 - يد المساعدة</option>
                            <option value="fa-hand-holding-heart">🤟 - رعاية واهتمام</option>
                            <option value="fa-hand-sparkles">✨ - يد التنظيف</option>
                            <option value="fa-fist-raised">✊ - قوة وإنجاز</option>
                            <option value="fa-thumbs-up">👍 - جودة مضمونة</option>
                        </optgroup>
                        <optgroup label="أيقونات التنظيف">
                            <option value="fa-home">🏠 - تنظيف شامل</option>
                            <option value="fa-broom">🧹 - كنس وتلميع</option>
                            <option value="fa-soap">🧼 - غسيل وتعقيم</option>
                            <option value="fa-spray-can">💨 - رش مبيدات</option>
                            <option value="fa-shower">🚿 - تنظيف حمامات</option>
                            <option value="fa-couch">🛋️ - تنظيف كنب</option>
                        </optgroup>
                        <optgroup label="أيقونات النقل واللوجستيات">
                            <option value="fa-truck-loading">🚚 - تحميل وتفريغ</option>
                            <option value="fa-box-open">📦 - تغليف عفش</option>
                            <option value="fa-dolly">🛒 - معدات حديثة</option>
                            <option value="fa-warehouse">🏢 - تخزين آمن</option>
                        </optgroup>
                        <optgroup label="أيقونات متنوعة">
                            <option value="fa-shield-alt">🛡️ - أمان وضمان</option>
                            <option value="fa-clock">🕒 - سرعة المواعيد</option>
                            <option value="fa-medal">🏅 - خبرة سنوات</option>
                            <option value="fa-user-check">👤 - عمالة مدربة</option>
                        </optgroup>
                    </select>
                </div>

                <div id="imageInputGroup" class="form-group-admin" style="display:none">
                    <label>اختر صورة من جهازك</label>
                    <input type="file" name="image_file" id="galleryImageFile" accept="image/*" style="padding: 8px;">
                    <small style="color:var(--gray-500); font-size:11px; margin-top:5px; display:block">يفضل استخدام صور ذات أبعاد متناسقة (مربعة)</small>
                </div>
                <input type="hidden" name="url" id="galleryUrl">
                <div class="form-group-admin">
                    <label>القسم</label>
                    <select name="category" id="galleryCategory">
                        <option value="all">عام</option>
                        <option value="cleaning">تنظيف</option>
                        <option value="moving">نقل عفش</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeGalleryModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">إضافة للصالة</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openGalleryModal = function() {
    $('#galleryForm')[0].reset();
    $('#galleryId').val('');
    $('#galleryType').val('icon');
    $('.admin-modal-header h3').html('<i class="fas fa-images"></i> إضافة صورة جديدة');
    toggleGalleryInputs();
    $('#galleryModal').addClass('open');
}

window.editGallery = function(img) {
    $('#galleryForm')[0].reset();
    $('#galleryId').val(img.id);
    $('#galleryTitle').val(img.title);
    $('#galleryCategory').val(img.category || 'all');
    
    $('.admin-modal-header h3').html('<i class="fas fa-edit"></i> تعديل العنصر');

    if(img.url) {
        $('#galleryType').val('image');
    } else {
        $('#galleryType').val('icon');
        $('#galleryIcon').val(img.icon);
    }
    
    toggleGalleryInputs();
    $('#galleryModal').addClass('open');
}

window.toggleGalleryInputs = function() {
    const type = $('#galleryType').val();
    if(type === 'icon') {
        $('#iconInputGroup').show();
        $('#imageInputGroup').hide();
    } else {
        $('#iconInputGroup').hide();
        $('#imageInputGroup').show();
    }
}

window.closeGalleryModal = function() {
    $('#galleryModal').removeClass('open');
}

window.handleGallerySubmit = function(e) {
    e.preventDefault();
    const form = $('#galleryForm')[0];
    const formData = new FormData(form);
    const id = $('#galleryId').val();

    const type = $('#galleryType').val();
    if(type === 'icon' && !$('#galleryIcon').val()) {
        showNotif('يرجى اختيار أيقونة', 'error');
        return;
    }
    
    // في حالة الإضافة الجديدة فقط نطلب الصورة، في التعديل اختيارية
    if(!id && type === 'image' && !$('#galleryImageFile').val()) {
        showNotif('يرجى اختيار صورة من جهازك', 'error');
        return;
    }

    const btn = $(form).find('button[type="submit"]');
    const originalText = btn.text();
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    const url = id ? `/admin/gallery/${id}` : '/admin/gallery';
    if(id) formData.append('_method', 'PUT'); // لارافيل يحتاج هذا لعمليات الـ PUT مع FormData

    $.ajax({
        url: url,
        method: 'POST', // نستخدم POST دائماً مع FormData ونضيف _method لـ PUT
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            showNotif('تمت إضافة الصورة بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        },
        error: function(xhr) {
            showNotif(xhr.responseJSON?.message || 'حدث خطأ أثناء الرفع', 'error');
            btn.prop('disabled', false).text('إضافة للصالة');
        }
    });
}

window.deleteGallery = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/gallery/${id}`,
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
