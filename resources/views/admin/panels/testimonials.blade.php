<div class="admin-panel" id="panelTestimonials">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>إدارة آراء العملاء</h3>
            <button class="admin-btn primary" onclick="openTestimonialModal()"><i class="fas fa-plus"></i> إضافة رأي جديد</button>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>العميل</th>
                        <th>الخدمة</th>
                        <th>التقييم</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            <strong>{{ $testimonial->name }}</strong>
                            <div style="font-size:12px;color:var(--gray-500)">{{ $testimonial->city }}</div>
                        </td>
                        <td>{{ $testimonial->service }}</td>
                        <td>
                            @for($i=0; $i<5; $i++)
                                <i class="fas fa-star" style="color:{{ $i < $testimonial->rating ? 'var(--gold)' : '#ddd' }}"></i>
                            @endfor
                        </td>
                        <td>
                            @if($testimonial->is_active)
                                <span class="status-badge status-done">نشط</span>
                            @else
                                <span class="status-badge status-cancel">مخفي</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="editTestimonial({{ json_encode($testimonial) }})"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" onclick="deleteTestimonial({{ $testimonial->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Testimonial Modal -->
<div class="admin-modal-overlay" id="testimonialModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-star"></i></div> <span id="testimonialModalTitle">إضافة رأي عميل</span></h3>
            <button class="admin-modal-close" onclick="closeTestimonialModal()">&times;</button>
        </div>
        <form id="testimonialForm" onsubmit="handleTestimonialSubmit(event)">
            <input type="hidden" name="id" id="testimonialId">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>اسم العميل</label>
                        <input type="text" name="name" id="testimonialName" required>
                    </div>
                    <div class="form-group-admin">
                        <label>المدينة</label>
                        <input type="text" name="city" id="testimonialCity">
                    </div>
                    <div class="form-group-admin">
                        <label>الخدمة</label>
                        <input type="text" name="service" id="testimonialService">
                    </div>
                    <div class="form-group-admin">
                        <label>التقييم</label>
                        <select name="rating" id="testimonialRating">
                            <option value="5">5 نجوم</option>
                            <option value="4">4 نجوم</option>
                            <option value="3">3 نجوم</option>
                            <option value="2">2 نجمة</option>
                            <option value="1">1 نجمة</option>
                        </select>
                    </div>
                </div>
                <div class="form-group-admin">
                    <label>نص الرأي</label>
                    <textarea name="content" id="testimonialContent" rows="3" required></textarea>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="testimonialIsActive" style="width:auto" value="1" checked> عرض في الموقع
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeTestimonialModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ</button>
            </div>
        </form>
    </div>
</div>

<script>
function openTestimonialModal() {
    $('#testimonialForm')[0].reset();
    $('#testimonialId').val('');
    $('#testimonialModal').addClass('open');
}
function closeTestimonialModal() { $('#testimonialModal').removeClass('open'); }
function editTestimonial(t) {
    $('#testimonialId').val(t.id);
    $('#testimonialName').val(t.name);
    $('#testimonialCity').val(t.city);
    $('#testimonialService').val(t.service);
    $('#testimonialRating').val(t.rating);
    $('#testimonialContent').val(t.content);
    $('#testimonialIsActive').prop('checked', t.is_active);
    $('#testimonialModal').addClass('open');
}
function handleTestimonialSubmit(e) {
    e.preventDefault();
    const form = $('#testimonialForm');
    const id = $('#testimonialId').val();
    const url = id ? `/admin/testimonials/${id}` : '/admin/testimonials';
    
    $.ajax({
        url: url,
        method: 'POST',
        data: form.serialize(),
        success: function() {
            showNotif('تم حفظ رأي العميل بنجاح ✅');
            closeTestimonialModal();
            window.location.hash = 'panelTestimonials';
            location.reload();
        },
        error: function() {
            showNotif('خطأ في الحفظ', 'error');
        }
    });
}
function deleteTestimonial(id) {
    if(confirm('هل تريد الحذف؟')) {
        $.ajax({ 
            url: `/admin/testimonials/${id}`, 
            method: 'POST', 
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function() { 
                showNotif('تم الحذف بنجاح ✅');
                window.location.hash = 'panelTestimonials';
                location.reload(); 
            } 
        });
    }
}
</script>
