<section class="hero" id="home">
  <div class="hero-shape"></div>
  <div class="hero-shape2"></div>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-star"></i> {{ $homeSettings['hero']['badge'] ?? 'الأسطورة رونق قلب الخليج' }}</div>
        <h2>{!! $homeSettings['hero']['title'] ?? 'خدمات نظافة احترافية في القصيم<br>لمنزل <span>يليق بك</span>' !!}</h2>
        <p class="hero-desc">{{ $homeSettings['hero']['desc'] ?? 'نقدم أرقى خدمات التنظيف المتكاملة للمنازل والفلل والشقق والمكاتب في منطقة القصيم. فريق مدرب، مواد آمنة، نتائج مضمونة، وأسعار تنافسية.' }}</p>
        <div class="hero-actions">
          <a href="#" class="btn btn-gold" onclick="openModal()"><i class="fas fa-calendar-check"></i> {{ $homeSettings['hero']['btn1']['text'] ?? 'اطلب الخدمة الآن' }}</a>
          <a href="{{ $homeSettings['hero']['btn2']['link'] ?? 'https://wa.me/'.($contactSettings['wa'] ?? '966550000000') }}" class="btn btn-whatsapp">
            <i class="fab fa-whatsapp"></i> {{ $homeSettings['hero']['btn2']['text'] ?? 'تواصل واتساب' }}
          </a>
        </div>
        <div class="hero-stats">
          @if(isset($homeSettings['hero']['stats']) && is_array($homeSettings['hero']['stats']))
            @foreach($homeSettings['hero']['stats'] as $st)
              <div class="stat-card">
                <div class="num">{{ $st['num'] }}</div>
                <div class="lbl">{{ $st['label'] }}</div>
              </div>
            @endforeach
          @else
            <div class="stat-card"><div class="num">500+</div><div class="lbl">عميل راضٍ</div></div>
            <div class="stat-card"><div class="num">5+</div><div class="lbl">سنوات خبرة</div></div>
            <div class="stat-card"><div class="num">16</div><div class="lbl">خدمة متخصصة</div></div>
          @endif
        </div>
      </div>
      <div class="hero-visual">
        <div class="hero-img-main @if(!($homeSettings['hero']['image'] ?? false)) img-placeholder @endif">
          @if($homeSettings['hero']['image'] ?? false)
            <img src="{{ $homeSettings['hero']['image'] }}" alt="Hero">
          @else
            <i class="fas fa-home"></i><span>صورة فاخرة للتنظيف</span>
          @endif
        </div>
        <div class="hero-badge-floating">
          <div class="icon"><i class="fas fa-shield-alt"></i></div>
          <div class="info"><strong>ضمان الجودة</strong><span>رضاك أو استرداد أموالك</span></div>
        </div>
      </div>
    </div>
  </div>
</section>
