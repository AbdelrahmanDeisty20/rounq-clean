<footer>
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a href="#" class="logo">
          <div class="logo-icon"><i class="fas fa-star"></i></div>
          <div class="logo-text"><h1>{{ $seoSettings['seoSite'] ?? 'الأسطورة رونق قلب الخليج' }}</h1><span>{{ $seoSettings['seoSlogan'] ?? 'شركة تنظيف احترافية' }}</span></div>
        </a>
        <p>شركة متخصصة في خدمات التنظيف الشامل للمنازل والفلل والمكاتب في منطقة القصيم. نلتزم بالجودة والدقة والأمانة في كل مهمة.</p>
        <div class="social-links">
          @if($contactSettings['snapchat'] ?? false) <a href="{{ $contactSettings['snapchat'] }}" class="social-link"><i class="fab fa-snapchat"></i></a> @endif
          @if($contactSettings['instagram'] ?? false) <a href="{{ $contactSettings['instagram'] }}" class="social-link"><i class="fab fa-instagram"></i></a> @endif
          @if($contactSettings['tiktok'] ?? false) <a href="{{ $contactSettings['tiktok'] }}" class="social-link"><i class="fab fa-tiktok"></i></a> @endif
          @if($contactSettings['twitter'] ?? false) <a href="{{ $contactSettings['twitter'] }}" class="social-link"><i class="fab fa-twitter"></i></a> @endif
          <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="footer-col">
        <h4>الصفحات</h4>
        <ul>
          <li><a href="#home">الرئيسية</a></li>
          <li><a href="#why-us">من نحن</a></li>
          <li><a href="#services">خدماتنا</a></li>
          <li><a href="#gallery-section">معرض الأعمال</a></li>
          <li><a href="#blogGrid">المقالات</a></li>
          <li><a href="#contact">تواصل معنا</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>خدماتنا</h4>
        <ul>
          <li><a href="#">تنظيف المنازل</a></li>
          <li><a href="#">تنظيف الفلل</a></li>
          <li><a href="#">تنظيف الكنب</a></li>
          <li><a href="#">تنظيف السجاد</a></li>
          <li><a href="#">تنظيف المجالس</a></li>
          <li><a href="#">التعقيم والتطهير</a></li>
          <li><a href="#">تنظيف بعد التشطيب</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>تواصل معنا</h4>
        <ul>
          <li><a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}"><i class="fas fa-phone"></i> {{ $contactSettings['phone'] ?? '0550000000' }}</a></li>
          @php 
            $waNumFooter = $contactSettings['whatsapp'] ?? '966550000000';
            if (str_starts_with($waNumFooter, '0')) {
                $waNumFooter = '966' . substr($waNumFooter, 1);
            }
          @endphp
          <li><a href="https://wa.me/{{ $waNumFooter }}"><i class="fab fa-whatsapp"></i> واتساب</a></li>
          <li><a href="mailto:{{ $contactSettings['email'] ?? 'info@alostora.com' }}"><i class="fas fa-envelope"></i> {{ $contactSettings['email'] ?? 'info@alostora.com' }}</a></li>
          <li><a href="#"><i class="fas fa-map-marker-alt"></i> {{ $contactSettings['address'] ?? 'بريدة، القصيم' }}</a></li>
          <li><a href="#"><i class="fas fa-clock"></i> {{ $contactSettings['hours'] ?? 'السبت-الخميس 7ص-10م' }}</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2025 الأسطورة رونق قلب الخليج. جميع الحقوق محفوظة.</span>
      <span>شركة تنظيف احترافية في القصيم | بريدة | عنيزة | الرس</span>
    </div>
  </div>
</footer>
