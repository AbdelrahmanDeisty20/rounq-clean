<div class="admin-panel" id="panelHomeManager">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>إدارة الصفحة الرئيسية</h3>
            <button class="admin-btn primary" onclick="saveHomeSettings()">حفظ التغييرات</button>
        </div>
        <div class="admin-card-body">
            <form id="homeManagerForm">
                <!-- HERO SECTION -->
                <div class="admin-nav-section" style="margin-right:-24px; color:var(--primary)">قسم الواجهة (Hero)</div>
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>البادج (Badge)</label>
                        <input type="text" name="homeSettings[hero][badge]" value="{{ $homeSettings['hero']['badge'] ?? '' }}">
                    </div>
                    <div class="form-group-admin">
                        <label>العنوان الرئيسي</label>
                        <input type="text" name="homeSettings[hero][title]" value="{{ $homeSettings['hero']['title'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>الوصف</label>
                    <textarea name="homeSettings[hero][desc]" rows="3">{{ $homeSettings['hero']['desc'] ?? '' }}</textarea>
                </div>

                <!-- WHY US -->
                <div class="admin-nav-section" style="margin-right:-24px; color:var(--primary); margin-top:20px">قسم "لماذا نحن"</div>
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>العنوان</label>
                        <input type="text" name="homeSettings[why][title]" value="{{ $homeSettings['why']['title'] ?? '' }}">
                    </div>
                    <div class="form-group-admin">
                        <label>الوصف</label>
                        <textarea name="homeSettings[why][desc]" rows="3">{{ $homeSettings['why']['desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <!-- CTA -->
                <div class="admin-nav-section" style="margin-right:-24px; color:var(--primary); margin-top:20px">قسم النداء (CTA)</div>
                <div class="form-group-admin">
                    <label>العنوان</label>
                    <input type="text" name="homeSettings[cta][title]" value="{{ $homeSettings['cta']['title'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>الوصف</label>
                    <textarea name="homeSettings[cta][desc]" rows="2">{{ $homeSettings['cta']['desc'] ?? '' }}</textarea>
                </div>

                <div style="margin-top:30px; text-align:left">
                    <button type="button" class="admin-btn primary" onclick="saveHomeSettings()">حفظ كافة التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function saveHomeSettings() {
    const form = $('#homeManagerForm');
    const btn = $('.admin-btn.primary');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    // Extract homeSettings from serialized array
    const formData = form.serializeArray();
    const settings = {};
    
    formData.forEach(item => {
        // Match homeSettings[section][field]
        const matches = item.name.match(/homeSettings\[(.*?)\]\[(.*?)\]/);
        if (matches) {
            const section = matches[1];
            const field = matches[2];
            if (!settings[section]) settings[section] = {};
            settings[section][field] = item.value;
        }
    });

    $.ajax({
        url: '/admin/settings',
        method: 'POST',
        data: {
            key: 'homeSettings',
            value: JSON.stringify(settings)
        },
        success: function() {
            showNotif('تم حفظ تعديلات الصفحة الرئيسية بنجاح ✅');
            btn.prop('disabled', false).text('حفظ التغييرات');
        },
        error: function() {
            showNotif('خطأ في الحفظ', 'error');
            btn.prop('disabled', false).text('حفظ التغييرات');
        }
    });
}
</script>
