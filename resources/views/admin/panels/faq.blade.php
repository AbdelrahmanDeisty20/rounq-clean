<div class="admin-panel" id="panelFaq">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>إدارة الأسئلة الشائعة</h3>
            <button class="admin-btn primary" onclick="openFaqModal()"><i class="fas fa-plus"></i> إضافة سؤال جديد</button>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>السؤال</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                        <td>{{ $faq->question }}</td>
                        <td>
                            @if($faq->is_active)
                                <span class="status-badge status-done">نشط</span>
                            @else
                                <span class="status-badge status-cancel">مخفي</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="editFaq({{ json_encode($faq) }})"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" onclick="deleteFaq({{ $faq->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Faq Modal -->
<div class="admin-modal-overlay" id="faqModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-question"></i></div> <span id="faqModalTitle">إضافة سؤال شائع</span></h3>
            <button class="admin-modal-close" onclick="closeFaqModal()">&times;</button>
        </div>
        <form id="faqForm" onsubmit="handleFaqSubmit(event)">
            <input type="hidden" name="id" id="faqId">
            <div class="admin-modal-body">
                <div class="form-group-admin">
                    <label>السؤال</label>
                    <input type="text" name="question" id="faqQuestion" required>
                </div>
                <div class="form-group-admin">
                    <label>الإجابة</label>
                    <textarea name="answer" id="faqAnswer" rows="4" required></textarea>
                </div>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                    <input type="checkbox" name="is_active" id="faqIsActive" style="width:auto" value="1" checked> عرض في الموقع
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeFaqModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ</button>
            </div>
        </form>
    </div>
</div>

<script>
function openFaqModal() {
    $('#faqForm')[0].reset();
    $('#faqId').val('');
    $('#faqModal').addClass('open');
}
function closeFaqModal() { $('#faqModal').removeClass('open'); }
function editFaq(f) {
    $('#faqId').val(f.id);
    $('#faqQuestion').val(f.question);
    $('#faqAnswer').val(f.answer);
    $('#faqIsActive').prop('checked', f.is_active);
    $('#faqModal').addClass('open');
}
function handleFaqSubmit(e) {
    e.preventDefault();
    const form = $('#faqForm');
    const id = $('#faqId').val();
    const url = id ? `/admin/faqs/${id}` : '/admin/faqs';
    
    $.ajax({
        url: url,
        method: 'POST',
        data: form.serialize(),
        success: function() {
            showNotif('تم حفظ السؤال بنجاح ✅');
            closeFaqModal();
            window.location.hash = 'panelFaq';
            location.reload();
        },
        error: function() {
            showNotif('خطأ في الحفظ', 'error');
        }
    });
}
function deleteFaq(id) {
    if(confirm('هل تريد الحذف؟')) {
        $.ajax({ 
            url: `/admin/faqs/${id}`, 
            method: 'POST', 
            data: {
                _method: 'DELETE',
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function() { 
                showNotif('تم حذف السؤال بنجاح ✅');
                window.location.hash = 'panelFaq';
                location.reload(); 
            } 
        });
    }
}
</script>
