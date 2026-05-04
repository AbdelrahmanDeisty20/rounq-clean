@extends('layouts.admin')

@section('title', 'إعدادات SEO')
@section('page_title', 'إعدادات SEO والأرشفة')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>إعدادات محركات البحث والتتبع</h3>
    </div>
    <div class="admin-card-body">
        <form id="seoForm" onsubmit="handleSeoSubmit(event)">
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>اسم الموقع (Site Name)</label>
                    <input type="text" name="seoSettings[seoSite]" value="{{ $seoSettings['seoSite'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>العنوان الافتراضي (Meta Title)</label>
                    <input type="text" name="seoSettings[seoTitle]" value="{{ $seoSettings['seoTitle'] ?? '' }}">
                </div>
            </div>
            <div class="form-group-admin">
                <label>الوصف الافتراضي (Meta Description)</label>
                <textarea name="seoSettings[seoDesc]" rows="3">{{ $seoSettings['seoDesc'] ?? '' }}</textarea>
            </div>
            <div class="form-group-admin">
                <label>الكلمات المفتاحية (Keywords)</label>
                <input type="text" name="seoSettings[seoKeys]" value="{{ $seoSettings['seoKeys'] ?? '' }}" placeholder="تنظيف منازل, شركة تنظيف, ...">
            </div>
            <hr style="margin:20px 0; border:0; border-top:1px solid var(--gray-200)">
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>Google Analytics ID</label>
                    <input type="text" name="seoSettings[seoGA]" value="{{ $seoSettings['seoGA'] ?? '' }}" placeholder="UA-XXXXXXXXX-X">
                </div>
                <div class="form-group-admin">
                    <label>Meta Pixel ID</label>
                    <input type="text" name="seoSettings[seoPx]" value="{{ $seoSettings['seoPx'] ?? '' }}" placeholder="XXXXXXXXXXXXXXX">
                </div>
            </div>
            <div style="margin-top:20px; display:flex; justify-content:flex-end">
                <button type="submit" class="admin-btn primary">حفظ الإعدادات</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.handleSeoSubmit = function(e) {
    e.preventDefault();
    const form = $('#seoForm');
    const formData = form.serializeArray();
    const settings = {};
    
    formData.forEach(item => {
        // match "seoSettings[key]"
        const keyMatch = item.name.match(/seoSettings\[(.*?)\]/);
        if (keyMatch) {
            settings[keyMatch[1]] = item.value;
        } else {
            settings[item.name] = item.value;
        }
    });

    const btn = form.find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    $.ajax({
        url: '/admin/seo',
        method: 'POST',
        data: {
            settings_json: JSON.stringify(settings)
        },
        success: function() {
            showNotif('تم حفظ إعدادات SEO بنجاح ✅');
            btn.prop('disabled', false).text('حفظ الإعدادات');
        },
        error: function() {
            showNotif('حدث خطأ أثناء الحفظ', 'error');
            btn.prop('disabled', false).text('حفظ الإعدادات');
        }
    });
}
</script>
@endsection
