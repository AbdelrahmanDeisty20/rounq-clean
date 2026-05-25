<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة التحكم | الأسطورة رونق قلب الخليج</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="admin-wrap">
        <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-logo">
            <h2><i class="fas fa-star" style="color:var(--gold)"></i> لوحة التحكم</h2>
            <span>الأسطورة رونق قلب الخليج</span>
        </div>
            <nav class="admin-nav">
                <div class="admin-nav-section">الرئيسية</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> لوحة التحكم
                </a>

                <div class="admin-nav-section">إدارة المحتوى</div>
                @can('manage home settings')
                <a href="{{ route('admin.home-manager') }}" class="nav-item {{ request()->routeIs('admin.home-manager') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> الصفحة الرئيسية
                </a>
                @endcan
                @can('manage services')
                <a href="{{ route('admin.services') }}" class="nav-item {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                    <i class="fas fa-broom"></i> الخدمات
                </a>
                @endcan
                @can('manage offers')
                <a href="{{ route('admin.offers') }}" class="nav-item {{ request()->routeIs('admin.offers') ? 'active' : '' }}">
                    <i class="fas fa-percent"></i> العروض والباقات
                </a>
                @endcan
                @can('manage gallery')
                <a href="{{ route('admin.gallery') }}" class="nav-item {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> معرض الصور
                </a>
                @endcan
                @can('manage videos')
                <a href="{{ route('admin.videos') }}" class="nav-item {{ request()->routeIs('admin.videos') ? 'active' : '' }}">
                    <i class="fas fa-video"></i> الفيديوهات
                </a>
                @endcan
                @can('manage testimonials')
                <a href="{{ route('admin.testimonials') }}" class="nav-item {{ request()->routeIs('admin.testimonials') ? 'active' : '' }}">
                    <i class="fas fa-star"></i> آراء العملاء
                </a>
                @endcan
                @can('manage blogs')
                <a href="{{ route('admin.blogs') }}" class="nav-item {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                    <i class="fas fa-blog"></i> المقالات
                </a>
                @endcan
                @can('manage faqs')
                <a href="{{ route('admin.faqs') }}" class="nav-item {{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
                    <i class="fas fa-question-circle"></i> الأسئلة الشائعة
                </a>
                @endcan

                <div class="admin-nav-section">الطلبات والرسائل</div>
                @can('manage bookings')
                <a href="{{ route('admin.bookings') }}" class="nav-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> طلبات الخدمة
                    <span class="badge-count">{{ $newBookingsCount ?? 0 }}</span>
                </a>
                @endcan
                @can('manage messages')
                <a href="{{ route('admin.messages') }}" class="nav-item {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> رسائل التواصل
                    <span class="badge-count">{{ $newMessagesCount ?? 0 }}</span>
                </a>
                @endcan

                <div class="admin-nav-section">الإعدادات</div>
                @can('manage contact settings')
                <a href="{{ route('admin.contact_settings') }}" class="nav-item {{ request()->routeIs('admin.contact_settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> إعدادات التواصل
                </a>
                @endcan
                @can('manage seo')
                <a href="{{ route('admin.seo') }}" class="nav-item {{ request()->routeIs('admin.seo') ? 'active' : '' }}">
                    <i class="fas fa-search"></i> إعدادات SEO
                </a>
                @endcan
                @can('manage users')
                <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> المستخدمون
                </a>
                @endcan
                @can('view analytics')
                <a href="{{ route('admin.analytics') }}" class="nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> الإحصائيات
                </a>
                @endcan
                <a href="{{ route('admin.change_password') }}" class="nav-item {{ request()->routeIs('admin.change_password') ? 'active' : '' }}">
                    <i class="fas fa-key"></i> تغيير كلمة المرور
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="nav-item" style="width: 100%; border: none; background: none; cursor: pointer; color: #ef9090;">
                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                    </button>
                </form>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <button class="mobile-toggle-admin" onclick="toggleAdminSidebar()"><i class="fas fa-bars"></i></button>
                <h1>@yield('title', 'لوحة التحكم')</h1>
                <div class="admin-header-actions">
                    <a href="{{ route('site.home') }}" target="_blank" class="admin-btn secondary" style="padding: 8px 15px; font-size: 13px;">
                        <i class="fas fa-external-link-alt"></i> عرض الموقع
                    </a>
                </div>
            </header>
            <div class="admin-content">
                @if(session('success'))
                    <div class="notification show" id="success-notif">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <div id="sidebarBackdrop" class="admin-sidebar-backdrop"></div>

    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            } else {
                sidebar.classList.add('open');
                backdrop.classList.add('show');
            }
        }

        $(document).ready(function() {
            // Close sidebar when clicking backdrop
            $('#sidebarBackdrop').on('click', function() {
                toggleAdminSidebar();
            });

            // Close sidebar when clicking the close button inside it
            $('.close-sidebar-admin').on('click', function() {
                toggleAdminSidebar();
            });

            // CSRF Setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setTimeout(function() {
                $('#success-notif').removeClass('show');
            }, 3000);
        });

        // Global Utility Functions
        window.showNotif = function(msg, type = 'success') {
            const id = type === 'success' ? 'success-notif' : 'error-notif';
            let el = $('#' + id);
            if(el.length === 0) {
                $('body').append(`<div class="notification" id="${id}"><i class="fas ${type==='success'?'fa-check-circle':'fa-exclamation-circle'}"></i> <span></span></div>`);
                el = $('#' + id);
            }
            el.find('span').text(msg);
            el.addClass('show');
            setTimeout(() => el.removeClass('show'), 4000);
        }

        window.showRemoteErrors = function(errors, form) {
            $('.error-msg').remove();
            Object.keys(errors).forEach(key => {
                const input = form.find(`[name="${key}"]`);
                input.after(`<div class="error-msg" style="color:#ef5350; font-size:12px; margin-top:4px">${errors[key][0]}</div>`);
            });
        }

        window.uploadImage = function(e, successCallback) {
            const file = e.target.files[0];
            if (!file) return;
            const formData = new FormData();
            formData.append('image', file);
            
            showNotif('جاري رفع الصورة...', 'success');
            
            $.ajax({
                url: '/admin/upload-image',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    showNotif('تم الرفع بنجاح ✅');
                    successCallback(res.url);
                },
                error: function() {
                    showNotif('فشل الرفع، يرجى التأكد من حجم ونوع الصورة', 'error');
                }
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
