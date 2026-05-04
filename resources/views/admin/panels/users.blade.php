<div class="admin-panel" id="panelUsers">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="fas fa-users-cog" style="color:var(--gold)"></i> إدارة المستخدمين</h3>
            <button class="admin-btn gold" onclick="openUserModal()"><i class="fas fa-plus"></i> إضافة مستخدم</button>
        </div>
        <div class="admin-card-body" style="padding:0">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم الكامل</th>
                        <th>اسم المستخدم</th>
                        <th>البريد</th>
                        <th>الصلاحية</th>
                        <th>تاريخ الإضافة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td><code>{{ $user->username }}</code></td>
                        <td>{{ $user->email }}</td>
                        <td><span class="status-badge status-done">مدير</span></td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($user->username !== 'admin')
                            <div class="action-btns">
                                <button class="action-btn delete" onclick="deleteUser({{ $user->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- User Modal -->
<div class="admin-modal-overlay" id="userModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><span class="modal-icon"><i class="fas fa-user-plus"></i></span> <span>إضافة مستخدم</span></h3>
            <button class="admin-modal-close" onclick="closeUserModal()">&times;</button>
        </div>
        <form id="userForm">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>الاسم الكامل</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group-admin">
                        <label>اسم المستخدم</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="form-group-admin">
                        <label>كلمة المرور</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group-admin">
                        <label>البريد الإلكتروني</label>
                        <input type="email" name="email">
                    </div>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeUserModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">إضافة المستخدم</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUserModal() { $('#userForm')[0].reset(); $('#userModal').addClass('open'); }
function closeUserModal() { $('#userModal').removeClass('open'); }
function deleteUser(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({ url: `/admin/users/${id}`, method: 'DELETE', success: function() { location.reload(); } });
    }
}
</script>
