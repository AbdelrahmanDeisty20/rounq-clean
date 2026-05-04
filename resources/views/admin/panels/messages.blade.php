<div class="admin-panel" id="panelMessages">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>رسائل التواصل</h3>
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
                            <div style="font-weight:700">{{ $msg->name }}</div>
                            <div style="font-size:12px;color:var(--gray-500)">{{ $msg->email }}</div>
                        </td>
                        <td>{{ $msg->subject }}</td>
                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($msg->replied)
                                <span class="status-badge status-done">تم الرد</span>
                            @else
                                <span class="status-badge status-new">جديد</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="viewMessage({{ json_encode($msg) }})"><i class="fas fa-envelope-open-text"></i></button>
                                <button class="action-btn delete" onclick="deleteMessage({{ $msg->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
