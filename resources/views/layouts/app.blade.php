<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', ($seoSettings['seoTitle'] ?? 'الأسطورة رونق قلب الخليج | شركة تنظيف احترافية في القصيم'))</title>
    <meta name="description" content="@yield('meta_description', ($seoSettings['seoDesc'] ?? 'شركة تنظيف احترافية في القصيم، خدمات تنظيف منازل وفلل وكنب وسجاد في بريدة وعنيزة والرس'))">
    <meta name="keywords" content="@yield('meta_keywords', ($seoSettings['seoKeys'] ?? 'شركة تنظيف بالقصيم, تنظيف منازل بالقصيم, تنظيف فلل بالقصيم'))">

    @if(!empty($seoSettings['seoGA']))
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSettings['seoGA'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $seoSettings['seoGA'] }}');
    </script>
    @endif

    @if(!empty($seoSettings['seoPx']))
    <!-- Meta Pixel -->
    <script>
      !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $seoSettings['seoPx'] }}');
      fbq('track', 'PageView');
    </script>
    @endif

    {!! $seoSettings['seoHead'] ?? '' !!}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/localization/messages_ar.min.js"></script>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <script>
        // Force clear browser cache/service workers on page load if needed
        if (navigator.serviceWorker) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for(let registration of registrations) {
                    registration.unregister();
                }
            });
        }
        // Optional: Clear storage if you suspect it's interfering
        // localStorage.clear();
        // sessionStorage.clear();
    </script>
</head>
<body>
    @yield('content')
    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Smooth Scroll
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $(this.hash);
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800, 'swing');
                }
            });

            $('.btn-whatsapp, .float-btn-wa').click(function() {
                $.post('{{ route('track.click') }}', { type: 'whatsapp', _token: '{{ csrf_token() }}' });
            });
            $('.btn-phone, .float-btn-phone, a[href^="tel:"]').click(function() {
                $.post('{{ route('track.click') }}', { type: 'phone', _token: '{{ csrf_token() }}' });
            });
        });

        function toggleMobile() {
            document.getElementById('mobileNav').classList.toggle('open');
        }

        // Close mobile nav when clicking a link
        $(document).on('click', '#mobileNav a', function() {
            $('#mobileNav').removeClass('open');
        });
    </script>
</body>
</html>
