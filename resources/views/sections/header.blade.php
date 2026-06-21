<!-- TOP BAR -->
<div class="topbar">
  <div class="container">
    <div>
      <a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}"><i class="fas fa-phone"></i> {{ $contactSettings['phone'] ?? '0550000000' }}</a>
      <span style="margin:0 10px;opacity:.3">|</span>
      <a href="mailto:{{ $contactSettings['email'] ?? 'info@alostora.com' }}"><i class="fas fa-envelope"></i> {{ $contactSettings['email'] ?? 'info@alostora.com' }}</a>
    </div>
    <div class="topbar-right">
      @if($contactSettings['snapchat'] ?? false) <a href="{{ $contactSettings['snapchat'] }}"><i class="fab fa-snapchat"></i></a> @endif
      @if($contactSettings['instagram'] ?? false) <a href="{{ $contactSettings['instagram'] }}"><i class="fab fa-instagram"></i></a> @endif
      @if($contactSettings['tiktok'] ?? false) <a href="{{ $contactSettings['tiktok'] }}"><i class="fab fa-tiktok"></i></a> @endif
      @if($contactSettings['twitter'] ?? false) <a href="{{ $contactSettings['twitter'] }}"><i class="fab fa-twitter"></i></a> @endif
      <a href="{{ route('login') }}"><i class="fas fa-user-shield"></i> الإدارة</a>
    </div>
  </div>
</div>

<!-- HEADER -->
<header id="siteHeader">
  <div class="header-inner">
    <a href="{{ url('/') }}" class="logo">
      <div class="logo-icon"><i class="fas fa-star"></i></div>
      <div class="logo-text">
        <h1>{{ $seoSettings['seoSite'] ?? 'الأسطورة رونق قلب الخليج' }}</h1>
        <span>{{ $seoSettings['seoSlogan'] ?? 'شركة تنظيف احترافية - القصيم' }}</span>
      </div>
    </a>
    <nav id="mainNav">
      <a href="#home" class="active">الرئيسية</a>
      <a href="#why-us">من نحن</a>
      <a href="#services">خدماتنا</a>
      <a href="#gallery-section">معرض الأعمال</a>
      <a href="#blog">المقالات</a>
      <a href="#contact">تواصل معنا</a>
    </nav>
    <div class="header-actions">
      @php 
        $waHeader = $contactSettings['whatsapp'] ?? $contactSettings['phone'] ?? '966550000000';
        if (!str_contains($waHeader, 'wa.me') && !str_contains($waHeader, 'http')) {
            $waHeader = str_replace(['+', ' ', '-', '(', ')'], '', $waHeader);
            if (str_starts_with($waHeader, '0')) { $waHeader = '966' . substr($waHeader, 1); }
            $waHeader = 'https://wa.me/' . $waHeader;
        }
      @endphp
      <a href="{{ $waHeader }}" class="btn btn-whatsapp" id="headerWaBtn"><i class="fab fa-whatsapp"></i> واتساب</a>
      <a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}" class="btn btn-gold btn-call" id="headerCallBtn"><i class="fas fa-phone-alt"></i> تواصل الآن</a>
    </div>
    <button class="mobile-toggle" onclick="toggleMobile()"><i class="fas fa-bars"></i></button>
  </div>
  <div class="mobile-nav" id="mobileNav">
    <a href="#home">الرئيسية</a>
    <a href="#why-us">من نحن</a>
    <a href="#services">خدماتنا</a>
    <a href="#gallery-section">معرض الأعمال</a>
    <a href="#blog">المقالات</a>
    <a href="#contact">تواصل معنا</a>
    @php 
      $waMobile = $contactSettings['whatsapp'] ?? $contactSettings['phone'] ?? '966550000000';
      $waMobile = str_replace(['+', ' ', '-', '(', ')'], '', $waMobile);
      if (str_starts_with($waMobile, '0')) { $waMobile = '966' . substr($waMobile, 1); }
    @endphp
    <a href="https://wa.me/{{ $waMobile }}" style="color:var(--green)"><i class="fab fa-whatsapp"></i> واتساب</a>
  </div>
</header>
