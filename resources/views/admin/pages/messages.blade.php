@extends('layouts.admin')

@section('title', 'رسائل التواصل')
@section('page_title', 'إدارة رسائل التواصل')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3>الرسائل الواردة</h3>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>المرسل</th>
                    <th>الموضوع</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <td>
                        <strong>{{ $msg->name }}</strong>
                        <div style="font-size:12px;color:var(--gray-500)">{{ $msg->email }}</div>
                    </td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($msg->is_replied)
                            <span class="status-badge status-done">تم الرد</span>
                        @else
                            <span class="status-badge status-progress">جديد</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" onclick="viewMessage({{ json_encode($msg) }})"><i class="fas fa-eye"></i></button>
                            <button class="action-btn delete" onclick="deleteMessage({{ $msg->id }})"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Message Modal -->
<div class="admin-modal-overlay" id="messageModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fas fa-envelope"></i> عرض الرسالة</h3>
            <button class="admin-modal-close" onclick="closeMessageModal()">&times;</button>
        </div>
        <div class="admin-modal-body">
            <div style="margin-bottom:20px">
                <label style="display:block; font-weight:700; color:var(--primary)">نص الرسالة:</label>
                <p id="msgContent" style="background:var(--gray-100); padding:15px; border-radius:8px; margin-top:8px; line-height:1.6"></p>
            </div>
            <div id="replyStatusSection">
                <button class="admin-btn primary" onclick="markReplied()">تحديد كمقروء / تم الرد</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentMsgId = null;

window.viewMessage = function(msg) {
    currentMsgId = msg.id;
    $('#msgContent').text(msg.message);
    $('#messageModal').addClass('open');
    if(msg.is_replied) $('#replyStatusSection').hide();
    else $('#replyStatusSection').show();
}

window.closeMessageModal = function() {
    $('#messageModal').removeClass('open');
}

window.markReplied = function() {
    $.post(`/admin/messages/${currentMsgId}/reply`, {}, () => {
        showNotif('تم التحديث ✅');
        location.reload();
    });
}

window.deleteMessage = function(id) {
    if(confirm('هل أنت متأكد؟')) {
        $.ajax({
            url: `/admin/messages/${id}`,
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
