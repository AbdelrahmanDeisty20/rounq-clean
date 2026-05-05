@extends('layouts.admin')

@section('title', 'المقالات')
@section('page_title', 'إدارة مقالات المدونة')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>المقالات الحالية</h3>
        <button class="admin-btn primary" onclick="openBlogModal()"><i class="fas fa-plus"></i> إضافة مقال جديد</button>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>الصورة</th>
                    <th>العنوان</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td><img src="{{ $blog->image }}" style="width:60px; height:40px; border-radius:4px; object-fit:cover"></td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($blog->is_active)
                            <span class="status-badge status-done">نشط</span>
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

<!-- Blog Modal -->
<div class="admin-modal-overlay" id="blogModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fas fa-blog"></i> <span id="blogModalTitle">إضافة مقال جديد</span></h3>
            <button class="admin-modal-close" onclick="closeBlogModal()">&times;</button>
        </div>
        <form id="blogForm" onsubmit="handleBlogSubmit(event)" enctype="multipart/form-data">
            <input type="hidden" name="id" id="blogId">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>عنوان المقال</label>
                    <input type="text" name="title" id="blogTitle" required>
                </div>
                <div class="form-group-admin">
                    <label>صورة المقال</label>
                    <div style="display:flex; gap:15px; align-items:center; background:var(--gray-100); padding:15px; border-radius:8px">
                        <div id="blogPreview" style="width:100px; height:60px; background:#ddd; border-radius:8px; overflow:hidden">
                            <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#888; font-size:12px">لا توجد صورة</div>
                        </div>
                        <div style="flex:1">
                            <input type="file" name="image_file" id="blogImageFile" accept="image/*" onchange="previewBlogImage(event)">
                            <input type="hidden" name="image" id="blogImage">
                        </div>
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>محتوى المقال</label>
                    <textarea name="content" id="blogContent" rows="10" required></textarea>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="blogIsActive" value="1" checked> نشر المقال
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeBlogModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ المقال</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openBlogModal = function() {
    $('#blogForm')[0].reset();
    $('#blogId').val('');
    $('#blogImage').val('');
    $('#blogImageFile').val('');
    $('#blogPreview').html('<div style="display:flex; align-items:center; justify-content:center; height:100%; color:#888; font-size:12px">لا توجد صورة</div>');
    $('#blogModalTitle').text('إضافة مقال جديد');
    $('#blogModal').addClass('open');
}

window.previewBlogImage = function(event) {
    if(event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#blogPreview').html(`<img src='${e.target.result}' style='width:100%; height:100%; object-fit:cover'>`);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}

window.closeBlogModal = function() {
    $('#blogModal').removeClass('open');
}

window.editBlog = function(blog) {
    $('#blogForm')[0].reset();
    $('#blogId').val(blog.id);
    $('#blogTitle').val(blog.title);
    $('#blogImage').val(blog.image);
    $('#blogImageFile').val('');
    $('#blogPreview').html(`<img src='${blog.image}' style='width:100%; height:100%; object-fit:cover'>`);
    $('#blogContent').val(blog.content);
    $('#blogIsActive').prop('checked', blog.is_active);
    $('#blogModalTitle').text('تعديل المقال');
    $('#blogModal').addClass('open');
}

window.handleBlogSubmit = function(e) {
    e.preventDefault();
    const form = $('#blogForm')[0];
    const formData = new FormData(form);
    const id = $('#blogId').val();
    const url = id ? `/admin/blogs/${id}` : '/admin/blogs';
    
    // في حالة الإضافة الجديدة نطلب صورة
    if(!id && !$('#blogImageFile').val()) {
        showNotif('يرجى اختيار صورة للمقال أولاً', 'error');
        return;
    }

    const btn = $(form).find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            showNotif('تم حفظ المقال بنجاح ✅');
            setTimeout(() => location.reload(), 1000);
        },
        error: function(xhr) {
            if(xhr.status === 422 && xhr.responseJSON) {
                showRemoteErrors(xhr.responseJSON.errors, $(form));
                showNotif('يرجى التحقق من البيانات', 'error');
            } else {
                showNotif(xhr.responseJSON?.message || 'حدث خطأ أثناء الحفظ', 'error');
            }
            btn.prop('disabled', false).text('حفظ المقال');
        }
    });
}

window.deleteBlog = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/blogs/${id}`,
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
