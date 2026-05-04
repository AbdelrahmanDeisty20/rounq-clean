<div class="admin-panel" id="panelGallery">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>معرض الصور</h3>
            <button class="admin-btn primary" onclick="openGalleryModal()"><i class="fas fa-plus"></i> إضافة صورة جديدة</button>
        </div>
        <div class="admin-card-body">
            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:20px">
                @foreach($gallery as $img)
                <div class="admin-card" style="margin-bottom:0">
                    <img src="{{ $img->url }}" style="width:100%; height:150px; object-fit:cover">
                    <div style="padding:10px; display:flex; justify-content:space-between; align-items:center">
                        <span style="font-size:12px; color:var(--gray-500)">{{ $img->category }}</span>
                        <button class="action-btn delete" onclick="deleteGallery({{ $img->id }})"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div class="admin-modal-overlay" id="galleryModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-images"></i></div> <span>إضافة صورة للمعرض</span></h3>
            <button class="admin-modal-close" onclick="closeGalleryModal()">&times;</button>
        </div>
        <form id="galleryForm">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>رابط الصورة (URL)</label>
                    <input type="text" name="url" required placeholder="https://example.com/image.jpg">
                </div>
                <div class="form-group-admin">
                    <label>العنوان (اختياري)</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group-admin">
                    <label>التصنيف</label>
                    <input type="text" name="category" placeholder="مثال: تنظيف منازل">
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeGalleryModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">إضافة</button>
            </div>
        </form>
    </div>
</div>

<script>
function openGalleryModal() { $('#galleryForm')[0].reset(); $('#galleryModal').addClass('open'); }
function closeGalleryModal() { $('#galleryModal').removeClass('open'); }
$(document).ready(function() {
    $('#galleryForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/admin/gallery', method: 'POST', data: $(this).serialize(),
            success: function() { location.reload(); }
        });
    });
});
function deleteGallery(id) {
    if(confirm('حذف الصورة؟')) {
        $.ajax({ url: `/admin/gallery/${id}`, method: 'DELETE', success: function() { location.reload(); } });
    }
}
</script>
