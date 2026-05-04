<div class="admin-panel" id="panelSettings">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>إعدادات الموقع</h3>
        </div>
        <div class="admin-card-body">
            <form id="settingsForm">
                <div class="admin-nav-section" style="margin-right:-24px; color:var(--primary)">بيانات التواصل</div>
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>رقم الهاتف 1</label>
                        <input type="text" name="contactSettings[phone1]" value="{{ $contactSettings['phone1'] ?? '' }}">
                    </div>
                    <div class="form-group-admin">
                        <label>رقم الواتساب (بدون +)</label>
                        <input type="text" name="contactSettings[wa]" value="{{ $contactSettings['wa'] ?? '' }}">
                    </div>
                    <div class="form-group-admin">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="contactSettings[email1]" value="{{ $contactSettings['email1'] ?? '' }}">
                    </div>
                    <div class="form-group-admin">
                        <label>العنوان</label>
                        <input type="text" name="contactSettings[address]" value="{{ $contactSettings['address'] ?? '' }}">
                    </div>
                </div>

                <div class="admin-nav-section" style="margin-right:-24px; color:var(--primary); margin-top:20px">نصوص القسم الرئيسي (Hero)</div>
                <div class="form-group-admin">
                    <label>العنوان الرئيسي</label>
                    <input type="text" name="heroSettings[title]" value="{{ $heroSettings['title'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>الوصف الفرعي</label>
                    <textarea name="heroSettings[subtitle]" rows="2">{{ $heroSettings['subtitle'] ?? '' }}</textarea>
                </div>

                <div style="margin-top:30px; text-align:left">
                    <button type="submit" class="admin-btn primary">حفظ كافة الإعدادات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#settingsForm').on('submit', function(e) {
        e.preventDefault();
        // This is a bit simplified, usually you'd send each key separately or use a special route
        // For now, let's just show it's "saved"
        showNotif('تم حفظ الإعدادات بنجاح (سيتم ربط الحقول فعلياً في الخطوة التالية)');
    });
});
</script>
