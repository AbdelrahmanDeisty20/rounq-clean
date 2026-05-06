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
      <a href="#gallery">معرض الأعمال</a>
      <a href="#blog">المقالات</a>
      <a href="#contact">تواصل معنا</a>
    </nav>
    <div class="header-actions">
      @php 
        $waNum = $contactSettings['whatsapp'] ?? '966550000000';
        if (str_starts_with($waNum, '0')) {
            $waNum = '966' . substr($waNum, 1);
        }
      @endphp
      <a href="https://wa.me/{{ $waNum }}" class="btn btn-whatsapp" id="headerWaBtn"><i class="fab fa-whatsapp"></i> واتساب</a>
      <a href="#" class="btn btn-gold" onclick="openModal()"><i class="fas fa-calendar-check"></i> اطلب الخدمة</a>
    </div>
    <button class="mobile-toggle" onclick="toggleMobile()"><i class="fas fa-bars"></i></button>
  </div>
  <div class="mobile-nav" id="mobileNav">
    <a href="#home">الرئيسية</a>
    <a href="#why-us">من نحن</a>
    <a href="#services">خدماتنا</a>
    <a href="#gallery-section">معرض الأعمال</a>
    <a href="#blogGrid">المقالات</a>
    <a href="#contact">تواصل معنا</a>
    @php 
      $waNumFooter = $contactSettings['whatsapp'] ?? '966550000000';
      if (str_starts_with($waNumFooter, '0')) {
          $waNumFooter = '966' . substr($waNumFooter, 1);
      }
    @endphp
    <li><a href="https://wa.me/{{ $waNumFooter }}"><i class="fab fa-whatsapp"></i> واتساب</a></li>
  </div>
</header>
