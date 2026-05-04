@extends('layouts.admin')
@section('title', 'المستخدمون')
@section('page_title', 'إدارة المستخدمين')
@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fas fa-users"></i> إدارة المديرين والمسؤولين</h3>
        <button class="admin-btn primary" onclick="openUserModal()"><i class="fas fa-user-plus"></i> إضافة مدير جديد</button>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>اسم المستخدم</th>
                    <th>الدور</th>
                    <th>تاريخ الإضافة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td><code>{{ $user->username }}</code></td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge" style="background:{{ $role->name == 'Admin' ? '#ef5350' : '#42a5f5' }}; color:white; padding:4px 10px; border-radius:4px; font-size:12px">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($user->id != auth()->id())
                        <button class="action-btn delete" onclick="deleteUser({{ $user->id }})"><i class="fas fa-trash"></i></button>
                        @else
                        <span style="font-size:12px; color:#94a3b8">أنت حالياً</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- User Modal -->
<div class="admin-modal-overlay" id="userModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fas fa-user-plus"></i> إضافة مستخدم جديد</h3>
            <button class="admin-modal-close" onclick="closeUserModal()">&times;</button>
        </div>
        <form id="userForm" onsubmit="handleUserSubmit(event)">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>الاسم بالكامل</label>
                    <input type="text" name="name" required placeholder="مثال: أحمد محمد">
                </div>
                <div class="form-group-admin">
                    <label>اسم المستخدم (للدخول)</label>
                    <input type="text" name="username" required placeholder="مثال: ahmed_admin">
                </div>
                <div class="form-group-admin">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" required placeholder="6 أحرف على الأقل">
                </div>
                <div class="form-group-admin">
                    <label>الدور / الصلاحية</label>
                    <select name="role" id="userRole" required onchange="togglePermissions(this.value)">
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="permissionsWrapper" style="display:none; margin-top:15px; background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0">
                    <label style="display:block; margin-bottom:10px; font-weight:700; color:var(--primary)">تحديد صلاحيات المدير الفرعي:</label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px">
                        @php
                            $labels = [
                                'manage services' => 'إدارة الخدمات',
                                'manage bookings' => 'إدارة الطلبات',
                                'manage offers' => 'إدارة العروض',
                                'manage testimonials' => 'إدارة آراء العملاء',
                                'manage faqs' => 'إدارة الأسئلة الشائعة',
                                'manage blogs' => 'إدارة المقالات',
                                'manage messages' => 'إدارة الرسائل',
                                'manage gallery' => 'إدارة معرض الصور',
                                'manage seo' => 'إعدادات SEO',
                                'manage home settings' => 'إعدادات الصفحة الرئيسية',
                                'manage contact settings' => 'إعدادات التواصل',
                                'view analytics' => 'عرض الإحصائيات',
                                'manage users' => 'إدارة المستخدمين'
                            ];
                        @endphp
                        @foreach(\Spatie\Permission\Models\Permission::all() as $perm)
                        <label style="display:flex; align-items:center; gap:8px; font-size:13px; cursor:pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}">
                            {{ $labels[$perm->name] ?? $perm->name }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeUserModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ المستخدم</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openUserModal = function() {
    $('#userForm')[0].reset();
    $('#permissionsWrapper').hide();
    $('#userModal').addClass('open');
}

window.togglePermissions = function(role) {
    if(role === 'SubAdmin') {
        $('#permissionsWrapper').fadeIn();
    } else {
        $('#permissionsWrapper').fadeOut();
    }
}

window.closeUserModal = function() {
    $('#userModal').removeClass('open');
}

window.handleUserSubmit = function(e) {
    e.preventDefault();
    const form = $('#userForm');
    const btn = form.find('button[type="submit"]');
    
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');
    
    $.ajax({
        url: '/admin/users',
        method: 'POST',
        data: form.serialize(),
        success: function() {
            showNotif('تمت إضافة المستخدم بنجاح ✅');
            location.reload();
        },
        error: function(xhr) {
            btn.prop('disabled', false).text('حفظ المستخدم');
            const msg = xhr.responseJSON ? xhr.responseJSON.message : 'حدث خطأ ما';
            showNotif(msg, 'error');
        }
    });
}

window.deleteUser = function(id) {
    if(confirm('هل أنت متأكد من حذف هذا المستخدم؟')) {
        $.ajax({
            url: `/admin/users/${id}`,
            method: 'POST',
            data: { _method: 'DELETE' },
            success: function() {
                showNotif('تم حذف المستخدم بنجاح ✅');
                location.reload();
            },
            error: function(xhr) {
                const msg = xhr.responseJSON ? xhr.responseJSON.message : 'فشل الحذف';
                showNotif(msg, 'error');
            }
        });
    }
}
</script>
@endsection
