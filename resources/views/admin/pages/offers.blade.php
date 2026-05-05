@extends('layouts.admin')

@section('title', 'إدارة العروض')
@section('page_title', 'إدارة العروض والباقات')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>العروض الحالية</h3>
        <button class="admin-btn primary" onclick="openOfferModal()"><i class="fas fa-plus"></i> إضافة عرض جديد</button>
    </div>
    <div class="admin-card-body">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>العرض</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                    <tr data-id="{{ $offer->id }}">
                        <td>
                            <strong>{{ $offer->title }}</strong>
                            @if($offer->is_featured) <span class="status-badge status-progress">مميز</span> @endif
                        </td>
                        <td>
                            <span class="text-green">{{ $offer->price }} ر.س</span>
                            @if($offer->old_price) <small style="text-decoration:line-through; color:var(--gray-500)">{{ $offer->old_price }}</small> @endif
                        </td>
                        <td>
                            @if($offer->is_active)
                                <span class="status-badge status-done">نشط</span>
                            @else
                                <span class="status-badge status-cancel">متوقف</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="editOffer({{ json_encode($offer) }})"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete" onclick="deleteOffer({{ $offer->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $offers->links() }}
        </div>
    </div>
</div>

<!-- Offer Modal -->
<div class="admin-modal-overlay" id="offerModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><div class="modal-icon"><i class="fas fa-percent"></i></div> <span id="offerModalTitle">إضافة عرض جديد</span></h3>
            <button class="admin-modal-close" onclick="closeOfferModal()">&times;</button>
        </div>
        <form id="offerForm" onsubmit="handleOfferSubmit(event)">
            <input type="hidden" name="id" id="offerId">
            <div class="admin-modal-body">
                <div class="form-grid">
                    <div class="form-group-admin">
                        <label>عنوان العرض</label>
                        <input type="text" name="title" id="offerTitle" required placeholder="مثال: الباقة الذهبية">
                    </div>
                    <div class="form-group-admin">
                        <label>السعر الحالي</label>
                        <input type="number" name="price" id="offerPrice" required placeholder="199">
                    </div>
                    <div class="form-group-admin">
                        <label>السعر القديم (اختياري)</label>
                        <input type="number" name="old_price" id="offerOldPrice" placeholder="299">
                    </div>
                    <div class="form-group-admin">
                        <label>المميزات (كل ميزة في سطر)</label>
                        <textarea name="features" id="offerFeatures" required rows="4" placeholder="تنظيف 3 غرف&#10;تنظيف مطبخ&#10;..."></textarea>
                    </div>
                </div>
                <div style="display:flex; gap:20px; margin-top:10px">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                        <input type="checkbox" name="is_featured" id="offerIsFeatured" style="width:auto"> عرض مميز (الأكثر طلباً)
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer">
                        <input type="checkbox" name="is_active" id="offerIsActive" style="width:auto" checked> نشط
                    </label>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-btn secondary" onclick="closeOfferModal()">إلغاء</button>
                <button type="submit" class="admin-btn primary">حفظ العرض</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
window.openOfferModal = function() {
    $('#offerForm')[0].reset();
    $('#offerId').val('');
    $('#offerModalTitle').text('إضافة عرض جديد');
    $('#offerModal').addClass('open');
}

window.closeOfferModal = function() {
    $('#offerModal').removeClass('open');
}

window.editOffer = function(offer) {
    $('#offerId').val(offer.id);
    $('#offerTitle').val(offer.title);
    $('#offerPrice').val(offer.price);
    $('#offerOldPrice').val(offer.old_price);
    $('#offerFeatures').val(offer.features);
    $('#offerIsFeatured').prop('checked', offer.is_featured);
    $('#offerIsActive').prop('checked', offer.is_active);
    $('#offerModalTitle').text('تعديل العرض');
    $('#offerModal').addClass('open');
}

window.handleOfferSubmit = function(e) {
    e.preventDefault();
    const form = $('#offerForm');
    const id = $('#offerId').val();
    const url = id ? `/admin/offers/${id}` : '/admin/offers';
    
    const formData = form.serializeArray();
    const isFeatured = $('#offerIsFeatured').is(':checked') ? '1' : '0';
    const isActive = $('#offerIsActive').is(':checked') ? '1' : '0';
    const cleanData = formData.filter(item => item.name !== 'is_featured' && item.name !== 'is_active');
    cleanData.push({name: 'is_featured', value: isFeatured});
    cleanData.push({name: 'is_active', value: isActive});

    const btn = form.find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');

    $.ajax({
        url: url,
        method: 'POST',
        data: cleanData,
        success: function() {
            showNotif('تم حفظ العرض بنجاح ✅');
            location.reload();
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                showRemoteErrors(xhr.responseJSON.errors, form);
            }
            btn.prop('disabled', false).html('حفظ العرض');
        }
    });
}

window.deleteOffer = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/offers/${id}`,
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
