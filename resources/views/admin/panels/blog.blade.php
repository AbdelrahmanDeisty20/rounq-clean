<div class="admin-panel" id="panelBlog">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>إدارة المقالات</h3>
            <button class="admin-btn primary" onclick="openBlogModal()"><i class="fas fa-plus"></i> إضافة مقال جديد</button>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>المقال</th>
                        <th>التصنيف</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td><strong>{{ $blog->title }}</strong></td>
                        <td>{{ $blog->category }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($blog->is_active)
                                <span class="status-badge status-done">منشور</span>
                            @else
                                <span class="status-badge status-cancel">مسودة</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="editBlog({{ json_encode($blog) }})"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" onclick="deleteBlog({{ $blog->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Blog Modal -->
<div class="admin-modal-overlay" id="blogModal">
    <div class="admin-modal-box" style="max-width:800px">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-blog"></i></div> <span id="blogModalTitle">إضافة مقال جديد</span></h3>
            <button class="admin-modal-close" onclick="closeBlogModal()">&times;</button>
        </div>
        <form id="blogForm">
            <input type="hidden" name="id" id="blogId">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>عنوان المقال</label>
                        <input type="text" name="title" id="blogTitle" required>
                    </div>
                    <div class="form-group-admin">
                        <label>التصنيف</label>
                        <input type="text" name="category" id="blogCategory">
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>ملخص قصير</label>
                    <textarea name="summary" id="blogSummary" rows="2"></textarea>
                </div>
                <div class="form-group-admin">
                    <label>محتوى المقال</label>
                    <textarea name="content" id="blogContent" rows="10" required></textarea>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="blogIsActive" style="width:auto" value="1" checked> نشر المقال
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeBlogModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ</button>
            </div>
        </form>
    </div>
</div>

<script>
function openBlogModal() {
    $('#blogForm')[0].reset();
    $('#blogId').val('');
    $('#blogModal').addClass('open');
}
function closeBlogModal() { $('#blogModal').removeClass('open'); }
function editBlog(b) {
    $('#blogId').val(b.id);
    $('#blogTitle').val(b.title);
    $('#blogCategory').val(b.category);
    $('#blogSummary').val(b.summary);
    $('#blogContent').val(b.content);
    $('#blogIsActive').prop('checked', b.is_active);
    $('#blogModal').addClass('open');
}
$(document).ready(function() {
    $('#blogForm').on('submit', function(e) {
        e.preventDefault();
        const id = $('#blogId').val();
        const url = id ? `/admin/blogs/${id}` : '/admin/blogs';
        $.ajax({
            url: url, method: 'POST', data: $(this).serialize(),
            success: function() { showNotif('تم الحفظ بنجاح'); location.reload(); }
        });
    });
});
function deleteBlog(id) {
    if(confirm('هل تريد الحذف؟')) {
        $.ajax({ url: `/admin/blogs/${id}`, method: 'DELETE', success: function() { location.reload(); } });
    }
}
</script>
