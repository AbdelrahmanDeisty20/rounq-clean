@extends('layouts.admin')
@section('title', 'تغيير كلمة المرور')
@section('page_title', 'تغيير كلمة المرور')
@section('content')
<div class="admin-card">
    <div class="admin-card-header"><h3>تحديث كلمة السر</h3></div>
    <div class="admin-card-body">
        <form action="{{ route('admin.update_password') }}" method="POST" style="max-width:400px; margin:0 auto">
            @csrf
            <div class="form-group-admin">
                <label>كلمة المرور الحالية</label>
                <input type="password" name="current_password" required>
                @error('current_password') <div class="error-msg" style="color:red; font-size:12px">{{ $message }}</div> @enderror
            </div>
            <div class="form-group-admin">
                <label>كلمة المرور الجديدة</label>
                <input type="password" name="new_password" required>
                @error('new_password') <div class="error-msg" style="color:red; font-size:12px">{{ $message }}</div> @enderror
            </div>
            <div class="form-group-admin">
                <label>تأكيد كلمة المرور الجديدة</label>
                <input type="password" name="new_password_confirmation" required>
            </div>
            <button type="submit" class="admin-btn primary" style="width:100%">تحديث كلمة المرور</button>
        </form>
    </div>
</div>
@endsection
