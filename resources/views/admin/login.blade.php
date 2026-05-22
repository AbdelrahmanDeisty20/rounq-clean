<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>تسجيل الدخول | الأسطورة رونق قلب الخليج</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Almarai:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <style>
        body { font-family: 'Cairo', sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--dark), var(--primary)); margin: 0; }
        .login-box { background: white; border-radius: var(--radius-lg); padding: 48px 40px; width: 100%; max-width: 440px; box-shadow: var(--shadow-lg); text-align: center; }
        .login-icon { width: 72px; height: 72px; background: linear-gradient(135deg, var(--primary), var(--primary-light)); border-radius: 20px; display: flex; align-items: center; justify-content: center; color: white; font-size: 30px; margin: 0 auto 24px; }
        h2 { font-size: 24px; font-weight: 900; color: var(--primary); margin-bottom: 8px; font-family: var(--font-alt); }
        p { color: var(--gray-500); font-size: 14px; margin-bottom: 32px; }
        .form-group { text-align: right; margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 700; color: var(--gray-700); margin-bottom: 8px; }
        input { width: 100%; padding: 12px 16px; border: 1.5px solid var(--gray-200); border-radius: 8px; font-family: inherit; font-size: 14px; direction: rtl; }
        input:focus { outline: none; border-color: var(--primary); }
        .btn-login { width: 100%; padding: 12px; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 700; font-size: 16px; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-login:hover { background: var(--primary-light); }
        .login-error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; display: none; }
        .login-error.show { display: block; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-icon"><i class="fas fa-shield-alt"></i></div>
        <h2>لوحة التحكم</h2>
        <p>الأسطورة رونق قلب الخليج</p>
        
        <div id="loginError" class="login-error"></div>
        
        <form id="loginForm">
            @csrf
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" id="username" required value="admin">
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" id="password" required value="Admin@12345">
            </div>
            <button type="submit" class="btn-login" id="submitBtn">تسجيل الدخول</button>
            <div style="margin-top:20px">
                <a href="/" style="color:var(--gray-500);font-size:13px;text-decoration:none"><i class="fas fa-arrow-right"></i> العودة للموقع</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            const btn = $('#submitBtn');
            btn.prop('disabled', true).text('جاري الدخول...');
            $('#loginError').removeClass('show');

            $.ajax({
                url: '{{ route('admin.login') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    window.location.href = res.redirect;
                },
                error: function(xhr) {
                    let errorMsg = 'بيانات الدخول غير صحيحة';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#loginError').text(errorMsg).addClass('show');
                    btn.prop('disabled', false).text('تسجيل الدخول');
                }
            });
        });
    </script>
</body>
</html>
