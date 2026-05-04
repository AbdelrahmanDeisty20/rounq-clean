<div class="admin-panel" id="panelSeo">
    <div class="admin-card">
        <div class="admin-card-header"><h3>إعدادات SEO</h3></div>
        <div class="admin-card-body">
            <div class="form-grid">
                <div class="form-group-admin">
                    <label>اسم الموقع</label>
                    <input type="text" id="seoSite" value="{{ $seoSettings['seoSite'] ?? '' }}">
                </div>
                <div class="form-group-admin">
                    <label>Meta Title العام</label>
                    <input type="text" id="seoTitle" value="{{ $seoSettings['seoTitle'] ?? '' }}">
                </div>
            </div>
            <div class="form-group-admin">
                <label>Meta Description العامة</label>
                <textarea id="seoDesc">{{ $seoSettings['seoDesc'] ?? '' }}</textarea>
            </div>
            <div class="form-group-admin">
                <label>الكلمات المفتاحية</label>
                <textarea id="seoKeys" placeholder="كلمة1, كلمة2, كلمة3">{{ $seoSettings['seoKeys'] ?? '' }}</textarea>
            </div>
            <div class="form-group-admin">
                <label>كود Google Analytics</label>
                <textarea id="seoGA" placeholder="UA-XXXXXXXXX-X أو G-XXXXXXXXXX">{{ $seoSettings['seoGA'] ?? '' }}</textarea>
            </div>
            <div class="form-group-admin">
                <label>كود Meta Pixel</label>
                <textarea id="seoPx" placeholder="كود الفيسبوك بيكسل">{{ $seoSettings['seoPx'] ?? '' }}</textarea>
            </div>
            <div class="form-group-admin">
                <label>أكواد Header مخصصة</label>
                <textarea id="seoHead" placeholder="أكواد تضاف في <head>">{{ $seoSettings['seoHead'] ?? '' }}</textarea>
            </div>
            <button class="admin-btn primary" onclick="saveSEO()"><i class="fas fa-save"></i> حفظ إعدادات SEO</button>
        </div>
    </div>
</div>

<script>
function saveSEO() {
    $.ajax({
        url: '/admin/settings',
        method: 'POST',
        data: {
            key: 'seoSettings',
            value: JSON.stringify({
                seoSite: $('#seoSite').val(),
                seoTitle: $('#seoTitle').val(),
                seoDesc: $('#seoDesc').val(),
                seoKeys: $('#seoKeys').val(),
                seoGA: $('#seoGA').val(),
                seoPx: $('#seoPx').val(),
                seoHead: $('#seoHead').val()
            })
        },
        success: function() {
            showNotif('تم حفظ إعدادات SEO بنجاح ✅');
        },
        error: function() {
            showNotif('حدث خطأ أثناء الحفظ', 'error');
        }
    });
}
</script>
