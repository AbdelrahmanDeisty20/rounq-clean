@extends('layouts.admin')

@section('title', 'إدارة الصفحة الرئيسية')

@section('content')
<div class="home-admin-actions">
    <button class="admin-btn primary" onclick="saveAllSettings()"><i class="fas fa-save"></i> حفظ التعديلات</button>
    <a href="{{ route('site.home') }}" target="_blank" class="admin-btn secondary"><i class="fas fa-eye"></i> معاينة الموقع</a>
</div>

<!-- Hero Section -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fas fa-star" style="color:var(--gold)"></i> قسم Hero الرئيسي</h3>
    </div>
    <div class="admin-card-body">
        <div class="form-grid">
            <div class="form-group-admin">
                <label>الشارة العلوية (Badge)</label>
                <input id="hm_hero_badge" type="text" value="{{ $homeSettings['hero']['badge'] ?? '' }}" placeholder="مثال: الأسطورة رونق قلب الخليج">
            </div>
            <div class="form-group-admin">
                <label>صورة الـ Hero</label>
                <div style="display:flex; gap:15px; align-items:flex-start">
                    <div id="hm_hero_image_preview">
                        @if($homeSettings['hero']['image'] ?? false)
                            <img src="{{ $homeSettings['hero']['image'] }}" class="img-preview-small">
                        @else
                            <div class="img-preview-small" style="display:flex; align-items:center; justify-content:center; background:#eee">لا توجد صورة</div>
                        @endif
                    </div>
                    <div style="flex:1">
                        <input type="file" accept="image/*" onchange="uploadImage(event, 'hero_image')" class="admin-help">
                        <input id="hm_hero_image" type="hidden" value="{{ $homeSettings['hero']['image'] ?? '' }}">
                        <p class="admin-help">يفضل مقاس 1200x800 بكسل</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group-admin">
            <label>عنوان Hero الرئيسي</label>
            <textarea id="hm_hero_title" rows="2">{{ $homeSettings['hero']['title'] ?? '' }}</textarea>
        </div>
        <div class="form-group-admin">
            <label>النص الوصفي</label>
            <textarea id="hm_hero_desc" rows="3">{{ $homeSettings['hero']['desc'] ?? '' }}</textarea>
        </div>
        <div class="form-grid">
            <div class="form-group-admin"><label>نص الزر الأول</label><input id="hm_hero_btn1_text" type="text" value="{{ $homeSettings['hero']['btn1']['text'] ?? '' }}"></div>
            <div class="form-group-admin"><label>رابط الزر الأول</label><input id="hm_hero_btn1_link" type="text" value="{{ $homeSettings['hero']['btn1']['link'] ?? '' }}"></div>
            <div class="form-group-admin"><label>نص الزر الثاني</label><input id="hm_hero_btn2_text" type="text" value="{{ $homeSettings['hero']['btn2']['text'] ?? '' }}"></div>
            <div class="form-group-admin"><label>رابط الزر الثاني</label><input id="hm_hero_btn2_link" type="text" value="{{ $homeSettings['hero']['btn2']['link'] ?? '' }}"></div>
        </div>
        
        <h4 style="margin: 20px 0 15px; color: var(--primary); font-family: var(--font-alt); border-bottom: 1px solid var(--gray-200); padding-bottom: 5px;"><i class="fas fa-chart-bar"></i> الإحصائيات (Hero Stats)</h4>
        <div class="form-grid">
            @for($i=1; $i<=3; $i++)
            <div class="form-group-admin">
                <label>الرقم {{ $i }}</label>
                <input id="hm_stat{{ $i }}_num" type="text" value="{{ $homeSettings['hero']['stats'][$i-1]['num'] ?? '' }}">
            </div>
            <div class="form-group-admin">
                <label>الوصف {{ $i }}</label>
                <input id="hm_stat{{ $i }}_label" type="text" value="{{ $homeSettings['hero']['stats'][$i-1]['label'] ?? '' }}">
            </div>
            @endfor
        </div>
    </div>
</div>

<!-- Why Us Section -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fas fa-award" style="color:var(--gold)"></i> قسم لماذا نحن</h3>
    </div>
    <div class="admin-card-body">
        <div class="form-grid">
            <div class="form-group-admin"><label>Badge</label><input id="hm_why_badge" type="text" value="{{ $homeSettings['why']['badge'] ?? '' }}"></div>
            <div class="form-group-admin">
                <label>الصورة الجانبية</label>
                <div style="display:flex; gap:15px; align-items:flex-start">
                    <div id="hm_why_image_preview">
                        @if($homeSettings['why']['image'] ?? false)
                            <img src="{{ $homeSettings['why']['image'] }}" class="img-preview-small">
                        @endif
                    </div>
                    <div style="flex:1">
                        <input type="file" accept="image/*" onchange="uploadImage(event, 'why_image')" class="admin-help">
                        <input id="hm_why_image" type="hidden" value="{{ $homeSettings['why']['image'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group-admin"><label>العنوان الرئيسي</label><textarea id="hm_why_title">{{ $homeSettings['why']['title'] ?? '' }}</textarea></div>
        <div class="form-group-admin"><label>الوصف الرئيسي</label><textarea id="hm_why_desc">{{ $homeSettings['why']['desc'] ?? '' }}</textarea></div>
        <div class="form-grid">
            <div class="form-group-admin"><label>رقم شارة النجاح (مثال: 100%)</label><input id="hm_why_badge_num" type="text" value="{{ $homeSettings['why']['badgeNum'] ?? '' }}"></div>
            <div class="form-group-admin"><label>نص الشارة (مثال: رضا العملاء)</label><input id="hm_why_badge_label" type="text" value="{{ $homeSettings['why']['badgeLabel'] ?? '' }}"></div>
        </div>
        <div class="repeater-head" style="margin-top:20px">
            <strong>المميزات الإضافية</strong>
            <button class="admin-btn gold sm" onclick="addItem('whyFeatures')"><i class="fas fa-plus"></i> إضافة ميزة</button>
        </div>
        <div id="hm_whyFeatures_list" class="repeater-list"></div>
    </div>
</div>

<!-- Steps Section -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fas fa-list-ol" style="color:var(--gold)"></i> خطوات العمل</h3>
    </div>
    <div class="admin-card-body">
        <div class="form-grid">
            <div class="form-group-admin"><label>Badge</label><input id="hm_steps_badge" type="text" value="{{ $homeSettings['steps']['badge'] ?? '' }}"></div>
            <div class="form-group-admin"><label>عنوان القسم</label><input id="hm_steps_title" type="text" value="{{ $homeSettings['steps']['title'] ?? '' }}"></div>
        </div>
        <div class="form-group-admin"><label>الوصف</label><textarea id="hm_steps_desc">{{ $homeSettings['steps']['desc'] ?? '' }}</textarea></div>
        <div class="repeater-head">
            <strong>الخطوات</strong>
            <button class="admin-btn gold sm" onclick="addItem('steps')"><i class="fas fa-plus"></i> إضافة خطوة</button>
        </div>
        <div id="hm_steps_list" class="repeater-list"></div>
    </div>
</div>

<div class="home-admin-actions" style="justify-content:center; margin-top: 30px;">
    <button class="admin-btn primary" style="padding: 15px 40px; font-size: 16px;" onclick="saveAllSettings()"><i class="fas fa-save"></i> حفظ كافة التعديلات</button>
</div>
@endsection

@section('scripts')
<script>
let homeSettings = {!! json_encode($homeSettings) !!};
if (!homeSettings || Array.isArray(homeSettings)) homeSettings = {};

function uploadImage(e, targetId) {
    const file = e.target.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', '{{ csrf_token() }}');
    $.ajax({
        url: '/admin/upload-image',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            $(`#hm_${targetId}`).val(res.url);
            $(`#hm_${targetId}_preview`).html(`<img src="${res.url}" class="img-preview-small">`);
        }
    });
}

function renderAllRepeaters() {
    renderRepeater('whyFeatures', homeSettings.why?.features || []);
    renderRepeater('steps', homeSettings.steps?.items || []);
}

function renderRepeater(type, items) {
    const box = document.getElementById(`hm_${type}_list`);
    if(!box) return;
    box.innerHTML = items.map((it, i) => `
        <div class="repeater-item">
            <div class="repeater-head">
                <strong>البند ${i+1}</strong>
                <button class="admin-btn danger sm" onclick="removeItem('${type}', ${i})"><i class="fas fa-trash"></i></button>
            </div>
            <div class="form-grid">
                <div class="form-group-admin"><label>الأيقونة (FontAwesome)</label><input value="${it.icon||''}" onchange="updateItem('${type}', ${i}, 'icon', this.value)"></div>
                <div class="form-group-admin"><label>العنوان</label><input value="${it.title||''}" onchange="updateItem('${type}', ${i}, 'title', this.value)"></div>
            </div>
            <div class="form-group-admin"><label>الوصف</label><textarea onchange="updateItem('${type}', ${i}, 'desc', this.value)">${it.desc||''}</textarea></div>
        </div>
    `).join('');
}

function updateItem(type, index, key, value) {
    if(type === 'whyFeatures') homeSettings.why.features[index][key] = value;
    if(type === 'steps') homeSettings.steps.items[index][key] = value;
}

function addItem(type) {
    if(!homeSettings.why) homeSettings.why = {features: []};
    if(!homeSettings.steps) homeSettings.steps = {items: []};
    const base = {icon: 'fa-check', title: 'عنوان جديد', desc: 'وصف جديد'};
    if(type === 'whyFeatures') homeSettings.why.features.push(base);
    if(type === 'steps') homeSettings.steps.items.push(base);
    renderAllRepeaters();
}

function removeItem(type, index) {
    if(type === 'whyFeatures') homeSettings.why.features.splice(index, 1);
    if(type === 'steps') homeSettings.steps.items.splice(index, 1);
    renderAllRepeaters();
}

function saveAllSettings() {
    const h = homeSettings;
    h.hero = {
        badge: $('#hm_hero_badge').val(),
        image: $('#hm_hero_image').val(),
        title: $('#hm_hero_title').val(),
        desc: $('#hm_hero_desc').val(),
        btn1: { text: $('#hm_hero_btn1_text').val(), link: $('#hm_hero_btn1_link').val() },
        btn2: { text: $('#hm_hero_btn2_text').val(), link: $('#hm_hero_btn2_link').val() },
        stats: [1,2,3].map(i => ({ num: $(`#hm_stat${i}_num`).val(), label: $(`#hm_stat${i}_label`).val() }))
    };
    if(!h.why) h.why = {features: h.why?.features || []};
    h.why.badge = $('#hm_why_badge').val();
    h.why.image = $('#hm_why_image').val();
    h.why.title = $('#hm_why_title').val();
    h.why.desc = $('#hm_why_desc').val();
    h.why.badgeNum = $('#hm_why_badge_num').val();
    h.why.badgeLabel = $('#hm_why_badge_label').val();
    if(!h.steps) h.steps = {items: h.steps?.items || []};
    h.steps.badge = $('#hm_steps_badge').val();
    h.steps.title = $('#hm_steps_title').val();
    h.steps.desc = $('#hm_steps_desc').val();

    $.post('/admin/home-settings', { settings_json: JSON.stringify(h) }, function() {
        showNotif('تم حفظ كافة الإعدادات بنجاح ✅');
        setTimeout(() => location.reload(), 1000);
    }).fail(function() {
        showNotif('حدث خطأ أثناء حفظ الإعدادات', 'error');
    });
}

$(document).ready(() => renderAllRepeaters());
</script>
@endsection
