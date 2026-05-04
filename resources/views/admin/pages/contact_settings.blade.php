@extends('layouts.admin')

@section('title', 'إعدادات التواصل')
@section('page_title', 'إدارة إعدادات التواصل')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>بيانات التواصل والروابط</h3>
    </div>
    <div class="admin-card-body">
        <form id="contactSettingsForm" onsubmit="handleContactSubmit(event)">
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>رقم الهاتف الرئيسي</label>
                    <input type="text" name="contactSettings[phone]" value="{{ $contactSettings['phone'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>رقم الواتساب</label>
                    <input type="text" name="contactSettings[whatsapp]" value="{{ $contactSettings['whatsapp'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="contactSettings[email]" value="{{ $contactSettings['email'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>العنوان</label>
                    <input type="text" name="contactSettings[address]" value="{{ $contactSettings['address'] ?? '' }}">
                </div>
            </div>
            
            <hr style="margin:20px 0; border:0; border-top:1px solid var(--gray-200)">
            
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>رابط فيسبوك</label>
                    <input type="text" name="contactSettings[facebook]" value="{{ $contactSettings['facebook'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>رابط تويتر (X)</label>
                    <input type="text" name="contactSettings[twitter]" value="{{ $contactSettings['twitter'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>رابط إنستجرام</label>
                    <input type="text" name="contactSettings[instagram]" value="{{ $contactSettings['instagram'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>رابط تيك توك</label>
                    <input type="text" name="contactSettings[tiktok]" value="{{ $contactSettings['tiktok'] ?? '' }}">
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
window.handleContactSubmit = function(e) {
    e.preventDefault();
    const form = $('#contactSettingsForm');
    const formData = form.serializeArray();
    const settings = {};
    
    formData.forEach(item => {
        const matches = item.name.match(/contactSettings\[(.*?)\]/);
        if (matches) {
            settings[matches[1]] = item.value;
        }
    });

    $.ajax({
        url: '/admin/contact-settings',
        method: 'POST',
        data: { settings_json: JSON.stringify(settings) },
        success: function() {
            showNotif('تم حفظ إعدادات التواصل بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        }
    });
}
</script>
@endsection
