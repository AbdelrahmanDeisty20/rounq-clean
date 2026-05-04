@extends('layouts.admin')
@section('title', 'الإحصائيات')
@section('page_title', 'تحليلات الموقع')
@section('content')
<div class="stats-row">
    <div class="stat-box">
        <div class="stat-icon blue"><i class="fas fa-mouse-pointer"></i></div>
        <div class="stat-info">
            <div class="num">{{ $totalClicks }}</div>
            <div class="lbl">إجمالي النقرات</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon green"><i class="fab fa-whatsapp"></i></div>
        <div class="stat-info">
            <div class="num">{{ $waClicks }}</div>
            <div class="lbl">نقرات الواتساب</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon gold"><i class="fas fa-phone"></i></div>
        <div class="stat-info">
            <div class="num">{{ $phoneClicks }}</div>
            <div class="lbl">نقرات الاتصال</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon red"><i class="fas fa-calendar-check"></i></div>
        <div class="stat-info">
            <div class="num">{{ $bookingsCount }}</div>
            <div class="lbl">طلبات الخدمة</div>
        </div>
    </div>
</div>

<div class="admin-card" style="margin-top:20px">
    <div class="admin-card-header"><h3>تحليلات التفاعل</h3></div>
    <div class="admin-card-body">
        <div style="padding:40px; text-align:center; background:#f8fafc; border-radius:12px">
            <i class="fas fa-chart-line" style="font-size:50px; color:#94a3b8; margin-bottom:20px"></i>
            <h4 style="color:var(--primary); margin-bottom:10px">نظام تتبع النقرات نشط حالياً ✅</h4>
            <p style="color:#64748b; font-size:14px">يتم تحديث هذه الأرقام تلقائياً عند ضغط الزوار على أزرار التواصل في الموقع.</p>
        </div>
    </div>
</div>
@endsection
