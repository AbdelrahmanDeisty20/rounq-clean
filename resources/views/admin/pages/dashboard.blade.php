@extends('layouts.admin')

@section('title', 'لوحة التحكم الرئيسية')

@section('content')
<div class="stats-row">
    <div class="stat-box">
        <div class="stat-icon blue"><i class="fas fa-clipboard-list"></i></div>
        <div class="stat-info">
            <div class="num">{{ $bookingsCount }}</div>
            <div class="lbl">طلبات الخدمة</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon gold"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <div class="num">{{ $messagesCount }}</div>
            <div class="lbl">رسائل التواصل</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon green"><i class="fas fa-broom"></i></div>
        <div class="stat-info">
            <div class="num">{{ $servicesCount }}</div>
            <div class="lbl">الخدمات النشطة</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon red"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <div class="num">{{ $totalClicks }}</div>
            <div class="lbl">نقرات الاتصال</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>آخر طلبات الخدمة</h3>
            <a href="{{ route('admin.bookings') }}" class="admin-btn secondary">عرض الكل</a>
        </div>
        <div class="admin-card-body">
            @if($bookings->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الخدمة</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->service_type }}</td>
                            <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align:center;padding:30px;color:var(--gray-500)">لا توجد طلبات بعد</div>
            @endif
        </div>
    </div>
    <div class="admin-card">
        <div class="admin-card-header">
            <h3>آخر رسائل التواصل</h3>
            <a href="{{ route('admin.messages') }}" class="admin-btn secondary">عرض الكل</a>
        </div>
        <div class="admin-card-body">
            @if($messages->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>الموضوع</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                        <tr>
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->subject }}</td>
                            <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align:center;padding:30px;color:var(--gray-500)">لا توجد رسائل بعد</div>
            @endif
        </div>
    </div>
</div>

<div class="admin-card" style="margin-top:24px">
    <div class="admin-card-header"><h3>إحصائيات النقرات</h3></div>
    <div class="admin-card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">
            <div style="text-align:center;background:var(--gray-100);border-radius:var(--radius);padding:20px">
                <div style="font-size:32px;color:#25d366"><i class="fab fa-whatsapp"></i></div>
                <div style="font-size:28px;font-weight:900;color:var(--dark)">{{ $waClicks }}</div>
                <div style="font-size:13px;color:var(--gray-500)">نقرات واتساب</div>
            </div>
            <div style="text-align:center;background:var(--gray-100);border-radius:var(--radius);padding:20px">
                <div style="font-size:32px;color:var(--primary)"><i class="fas fa-phone"></i></div>
                <div style="font-size:28px;font-weight:900;color:var(--dark)">{{ $phoneClicks }}</div>
                <div style="font-size:13px;color:var(--gray-500)">نقرات الهاتف</div>
            </div>
            <div style="text-align:center;background:var(--gray-100);border-radius:var(--radius);padding:20px">
                <div style="font-size:32px;color:var(--gold)"><i class="fas fa-mouse-pointer"></i></div>
                <div style="font-size:28px;font-weight:900;color:var(--dark)">{{ $totalClicks }}</div>
                <div style="font-size:13px;color:var(--gray-500)">إجمالي النقرات</div>
            </div>
        </div>
    </div>
</div>
@endsection
