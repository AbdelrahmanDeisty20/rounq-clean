@extends('layouts.admin')

@section('title', 'الأسئلة الشائعة')
@section('page_title', 'إدارة الأسئلة الشائعة')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الأسئلة الحالية</h3>
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
                            <span class="status-badge status-cancel">متوقف</span>
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

<!-- FAQ Modal -->
<div class="admin-modal-overlay" id="faqModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-question-circle"></i></div> <span id="faqModalTitle">إضافة سؤال جديد</span></h3>
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
                    <input type="checkbox" name="is_active" id="faqIsActive" value="1" checked> نشط
                </label>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeFaqModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ السؤال</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openFaqModal = function() {
    $('#faqForm')[0].reset();
    $('#faqId').val('');
    $('#faqModalTitle').text('إضافة سؤال جديد');
    $('#faqModal').addClass('open');
}

window.closeFaqModal = function() {
    $('#faqModal').removeClass('open');
}

window.editFaq = function(faq) {
    $('#faqId').val(faq.id);
    $('#faqQuestion').val(faq.question);
    $('#faqAnswer').val(faq.answer);
    $('#faqIsActive').prop('checked', faq.is_active);
    $('#faqModalTitle').text('تعديل السؤال');
    $('#faqModal').addClass('open');
}

window.handleFaqSubmit = function(e) {
    e.preventDefault();
    const form = $('#faqForm');
    const id = $('#faqId').val();
    const url = id ? `/admin/faqs/${id}` : '/admin/faqs';
    
    const formData = form.serializeArray();
    const isActive = $('#faqIsActive').is(':checked') ? '1' : '0';
    const cleanData = formData.filter(item => item.name !== 'is_active');
    cleanData.push({name: 'is_active', value: isActive});

    $.ajax({
        url: url,
        method: 'POST',
        data: cleanData,
        success: function() {
            showNotif('تم الحفظ بنجاح ✅');
            location.reload();
        }
    });
}

window.deleteFaq = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/faqs/${id}`,
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
