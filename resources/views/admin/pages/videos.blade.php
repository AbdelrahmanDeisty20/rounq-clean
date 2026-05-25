@extends('layouts.admin')

@section('title', 'إدارة الفيديوهات')
@section('page_title', 'قسم الفيديوهات')

@section('content')
<div class="admin-card">
    <div class="admin-card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>الفيديوهات المرفوعة</h3>
        <button class="admin-btn primary" onclick="openVideoModal()"><i class="fas fa-plus"></i> إضافة فيديو جديد</button>
    </div>
    <div class="admin-card-body">
        <div class="gallery-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            @forelse($videos as $video)
            <div class="video-item" style="height:220px; display:flex; flex-direction:column; background:white; border-radius:12px; border:1px solid #e2e8f0; position:relative; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.02)">
                <div style="flex:1; width:100%; display:flex; align-items:center; justify-content:center; background:#0f172a; overflow:hidden; position:relative;">
                    <video src="{{ asset($video->url) }}" style="width:100%; height:100%; object-fit:cover;" muted playsinline preload="metadata"></video>
                    <div style="position:absolute; width:40px; height:40px; background:rgba(197, 160, 89, 0.9); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:16px; box-shadow:0 4px 6px rgba(0,0,0,0.2)">
                        <i class="fas fa-play" style="margin-right:-2px;"></i>
                    </div>
                </div>
                <div style="padding:10px; background:white; border-top:1px solid #f1f5f9; text-align:center;">
                    <div style="font-size:12px; color:#64748b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ basename($video->url) }}
                    </div>
                </div>
                <div class="gallery-overlay-btns" style="position:absolute; top:8px; left:8px; display:flex; gap:5px">
                    <button class="action-btn edit" onclick="editVideo({{ json_encode($video) }})" style="background:rgba(14,165,233,0.9); color:white; border:none; width:30px; height:30px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px; transition:0.2s;"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete" onclick="deleteVideo({{ $video->id }})" style="background:rgba(239,83,80,0.9); color:white; border:none; width:30px; height:30px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px; transition:0.2s;"><i class="fas fa-trash"></i></button>
                </div>
                <span style="position:absolute; top:8px; right:8px; background:{{ $video->is_active ? '#22c55e' : '#94a3b8' }}; color:white; padding:2px 8px; border-radius:20px; font-size:10px; font-weight:bold;">
                    {{ $video->is_active ? 'نشط' : 'غير نشط' }}
                </span>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align:center; padding:50px; background:#f8fafc; border-radius:12px; color:#64748b; border: 1.5px dashed #cbd5e1;">
                <i class="fas fa-video-slash" style="font-size:48px; margin-bottom:15px; color:#94a3b8"></i>
                <h4 style="margin:0 0 5px; color:#475569">لا توجد فيديوهات مضافة بعد</h4>
                <p style="margin:0; font-size:13px; color:#94a3b8">اضغط على زر إضافة فيديو جديد للبدء في رفع فيديو من جهازك</p>
            </div>
            @endforelse
        </div>
        
        <div style="margin-top:20px;">
            {{ $videos->links() }}
        </div>
    </div>
</div>

<!-- Video Modal -->
<div class="admin-modal-overlay" id="videoModal">
    <div class="admin-modal-box" style="background:white; border-radius:16px; width:500px; max-width:90%; box-shadow:0 10px 25px rgba(0,0,0,0.1); overflow:hidden;">
        <div class="admin-modal-header" style="padding:15px 20px; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center; background:#f8fafc;">
            <h3 style="margin:0; color:#1e293b; font-size:16px;"><i class="fas fa-video" style="color:var(--primary);"></i> إضافة فيديو جديد</h3>
            <button class="admin-modal-close" onclick="closeVideoModal()" style="border:none; background:none; font-size:24px; cursor:pointer; color:#94a3b8; line-height:1;">&times;</button>
        </div>
        <form id="videoForm" onsubmit="handleVideoSubmit(event)" enctype="multipart/form-data">
            <input type="hidden" name="id" id="videoId">
            <div class="admin-modal-body" style="padding:20px;">
                <div class="form-group-admin" style="margin-bottom:15px;">
                    <label style="display:block; font-weight:700; color:#475569; font-size:13px; margin-bottom:6px;">اختر فيديو من جهازك</label>
                    <input type="file" name="video_file" id="videoFile" accept="video/*" style="width:100%; padding:8px; border:1.5px solid #cbd5e1; border-radius:8px; box-sizing:border-box;">
                    <small style="color:#94a3b8; font-size:11px; display:block; margin-top:4px;">يفضل رفع فيديوهات بصيغة MP4 وبأحجام مناسبة.</small>
                    <div id="videoCurrentFile" style="margin-top:10px; display:none; background:#f1f5f9; padding:8px 12px; border-radius:8px; font-size:12px; color:#475569;">
                        <strong>الملف الحالي:</strong> <span id="currentVideoPath"></span>
                    </div>
                </div>
                <div class="form-group-admin" style="margin-bottom:10px; display:flex; align-items:center; gap:8px;">
                    <input type="checkbox" name="is_active" id="videoActive" value="1" checked style="width:18px; height:18px; cursor:pointer;">
                    <label for="videoActive" style="font-weight:700; color:#475569; font-size:13px; cursor:pointer; user-select:none;">تفعيل ظهور الفيديو في الموقع</label>
                </div>
            </div>
            <div class="admin-modal-footer" style="padding:15px 20px; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px; background:#f8fafc;">
                <button type="button" class="admin-btn secondary" onclick="closeVideoModal()" style="padding:8px 16px; border-radius:8px;">إلغاء</button>
                <button type="submit" class="admin-btn primary" style="padding:8px 16px; border-radius:8px; background:var(--primary); color:white; border:none; cursor:pointer;">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openVideoModal = function() {
    $('#videoForm')[0].reset();
    $('#videoId').val('');
    $('#videoCurrentFile').hide();
    $('#videoFile').prop('required', true);
    $('#videoActive').prop('checked', true);
    $('.admin-modal-header h3').html('<i class="fas fa-video" style="color:var(--primary);"></i> رفع فيديو جديد');
    $('#videoModal').addClass('open');
}

window.editVideo = function(video) {
    $('#videoForm')[0].reset();
    $('#videoId').val(video.id);
    $('#videoFile').prop('required', false);
    $('#videoActive').prop('checked', video.is_active == 1);
    
    if (video.url) {
        const parts = video.url.split('/');
        const filename = parts[parts.length - 1];
        $('#currentVideoPath').text(filename);
        $('#videoCurrentFile').show();
    } else {
        $('#videoCurrentFile').hide();
    }
    
    $('.admin-modal-header h3').html('<i class="fas fa-edit" style="color:var(--primary);"></i> تعديل الفيديو');
    $('#videoModal').addClass('open');
}

window.closeVideoModal = function() {
    $('#videoModal').removeClass('open');
}

window.handleVideoSubmit = function(e) {
    e.preventDefault();
    const form = $('#videoForm')[0];
    const formData = new FormData(form);
    const id = $('#videoId').val();
    const btn = $(form).find('button[type="submit"]');
    
    // Check if new file selected in case of creating
    if (!id && !$('#videoFile').val()) {
        showNotif('يرجى اختيار ملف فيديو لرفعه', 'error');
        return;
    }

    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الرفع والحفظ...');

    const url = id ? `/admin/videos/${id}` : '/admin/videos';
    
    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            showNotif('تم حفظ ورفع الفيديو بنجاح ✅');
            setTimeout(() => location.reload(), 800);
        },
        error: function(xhr) {
            btn.prop('disabled', false).text('حفظ');
            const errors = xhr.responseJSON?.errors;
            if(errors) {
                showRemoteErrors(errors, $(form));
            } else {
                showNotif(xhr.responseJSON?.message || 'حدث خطأ أثناء رفع وحفظ الفيديو', 'error');
            }
        }
    });
}

window.deleteVideo = function(id) {
    if(confirm('هل أنت متأكد من رغبتك في حذف هذا الفيديو نهائياً؟')) {
        $.ajax({
            url: `/admin/videos/${id}`,
            method: 'DELETE',
            success: function() {
                showNotif('تم حذف الفيديو بنجاح ✅');
                setTimeout(() => location.reload(), 500);
            },
            error: function(xhr) {
                showNotif('فشل حذف الفيديو، يرجى المحاولة لاحقاً', 'error');
            }
        });
    }
}
</script>
@endsection
