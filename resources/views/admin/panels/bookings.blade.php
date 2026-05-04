<div class="admin-panel" id="panelBookings">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>طلبات الخدمة</h3>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>العميل</th>
                        <th>الخدمة</th>
                        <th>المدينة</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <div style="font-weight:700">{{ $booking->name }}</div>
                            <div style="font-size:12px;color:var(--gray-500)">{{ $booking->phone }}</div>
                        </td>
                        <td>{{ $booking->service }}</td>
                        <td>{{ $booking->city }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>
                            <span class="status-badge status-{{ $booking->status }}">{{ $booking->status }}</span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="action-btn edit" onclick="viewBooking({{ json_encode($booking) }})"><i class="fas fa-eye"></i></button>
                                <button class="action-btn delete" onclick="deleteBooking({{ $booking->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
