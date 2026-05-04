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
            <div class="gallery-item" style="height:200px; display:flex; flex-direction:column; align-items:center; justify-content:center; background:#f8fafc; border-radius:12px; border:1px solid #e2e8f0; position:relative">
                @if($img->url)
                    <img src="{{ $img->url }}" style="width:100%; height:100%; object-fit:cover; border-radius:12px">
                @elseif($img->icon)
                    <i class="fas {{ $img->icon }}" style="font-size:50px; color:#94a3b8"></i>
                    <div style="margin-top:10px; font-weight:700; color:#64748b">{{ $img->title }}</div>
                @endif
                <div class="gallery-overlay" style="opacity:1; background:transparent; display:flex; justify-content:flex-end; padding:10px; position:absolute; top:0; left:0; right:0">
                    <button class="action-btn delete" onclick="deleteGallery({{ $img->id }})" style="background:rgba(239,83,80,0.9); color:white; border:none; width:32px; height:32px; border-radius:50%"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            @endforeach
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
        <form id="galleryForm" onsubmit="handleGallerySubmit(event)">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>عنوان الخدمة (مثلاً: تنظيف فلل)</label>
                    <input type="text" name="title" id="galleryTitle" required placeholder="اكتب عنوان الخدمة هنا">
                </div>
                <div class="form-group-admin">
                    <label>اختر الأيقونة المعبرة</label>
                    <select name="icon" id="galleryIcon" required style="font-family: 'Font Awesome 5 Free', 'Tajawal', sans-serif; font-weight: 900; font-size: 16px; padding: 10px;">
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
                <input type="hidden" name="url" value="">
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
    $('#galleryModal').addClass('open');
}

window.closeGalleryModal = function() {
    $('#galleryModal').removeClass('open');
}

window.handleGallerySubmit = function(e) {
    e.preventDefault();
    const form = $('#galleryForm');
    const formData = form.serialize();

    if(!$('#galleryUrl').val() && !$('#galleryIcon').val()) {
        showNotif('يرجى رفع صورة أو اختيار أيقونة', 'error');
        return;
    }

    const btn = form.find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الإضافة...');

    $.ajax({
        url: '/admin/gallery',
        method: 'POST',
        data: formData,
        timeout: 15000,
        success: function() {
            showNotif('تمت إضافة الصورة بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        },
        error: function() {
            showNotif('حدث خطأ أثناء الإضافة', 'error');
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
