<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الأسطورة رونق قلب الخليج</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Almarai:wght@400;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Cairo', sans-serif; background: var(--gray-100); margin: 0; padding: 0; }
        .admin-wrap { display: flex !important; min-height: 100vh; }
    </style>
</head>
<body>
    @include('admin.main')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_ar.min.js"></script>
    @vite(['resources/js/app.js'])

    <script>
        // Set up CSRF token for all AJAX requests immediately
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // Global AJAX error handling
        $(document).ajaxError(function(event, xhr, settings, thrownError) {
            console.error('AJAX Error:', thrownError, xhr.responseText);
            if(xhr.status !== 422) { // 422 is handled by forms
                showNotif('خطأ في الاتصال بالسيرفر: ' + thrownError, 'error');
            }
        });

        // Admin Panel Scripts
        window.showPanel = (id, el) => {
            $('.admin-panel').removeClass('active');
            $('#'+id).addClass('active');
            if(el) {
                $('.admin-nav a').removeClass('active');
                $(el).addClass('active');
            }
            // Update title
            const title = $(el).text().trim();
            if(title) $('#adminPageTitle').text(title);
        };

        window.doLogout = () => {
            $.post('{{ route('admin.logout') }}', { _token: '{{ csrf_token() }}' }, () => {
                window.location.href = '/';
            });
        };

        window.goToSite = () => window.location.href = '/';

        // Load Initial Stats
        $(document).ready(() => {
            refreshStats();
            
            // Handle Hash
            const hash = window.location.hash.substring(1);
            if(hash && $('#'+hash).length) {
                const navItem = $(`.admin-nav a[onclick*="${hash}"]`);
                showPanel(hash, navItem[0]);
            }
        });

        function refreshStats() {
            // This would call your API routes
        }

        function showNotif(text, type='success') {
            const notif = $('<div class="notification show '+(type==='error'?'error':'')+'"><i class="fas fa-'+(type==='error'?'exclamation-triangle':'check-circle')+'"></i> <span>'+text+'</span></div>');
            $('body').append(notif);
            setTimeout(() => {
                notif.removeClass('show');
                setTimeout(() => notif.remove(), 400);
            }, 3000);
        }

        function showRemoteErrors(errors, form) {
            form.find('.error-msg').remove();
            form.find('.error-field').removeClass('error-field');
            $.each(errors, function(field, messages) {
                const input = form.find(`[name="${field}"]`);
                input.addClass('error-field');
                input.after(`<span class="error-msg" style="color:#ef9090; font-size:12px; margin-top:4px; display:block">${messages[0]}</span>`);
            });
        }
    </script>

    <!-- NOTIFICATION PLACEHOLDER -->
    <div id="notifArea"></div>
</body>
</html>
