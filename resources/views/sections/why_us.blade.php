<section id="why-us">
  <div class="container">
    <div class="why-grid">
      <div class="why-text">
        <div class="badge" style="display:inline-block;background:linear-gradient(135deg,var(--gold),#e8c56a);color:var(--dark);padding:6px 20px;border-radius:50px;font-size:13px;font-weight:700;margin-bottom:12px"><i class="fas fa-award"></i> {{ $homeSettings['why']['badge'] ?? 'لماذا نحن' }}</div>
        <h2>{!! $homeSettings['why']['title'] ?? 'لماذا تختار<br><span class="text-gold">الأسطورة رونق قلب الخليج؟</span>' !!}</h2>
        <p>{{ $homeSettings['why']['desc'] ?? 'نحن لسنا مجرد شركة تنظيف، نحن شركاؤك في الحفاظ على بيئة منزلية صحية ونظيفة. نجمع بين الخبرة العالية والمواد الآمنة والفريق المدرب لنقدم لك أفضل تجربة تنظيف في القصيم.' }}</p>
        <div class="why-features">
          @if(isset($homeSettings['why']['features']) && is_array($homeSettings['why']['features']))
            @foreach($homeSettings['why']['features'] as $feature)
              <div class="why-feature">
                <div class="icon"><i class="fas {{ $feature['icon'] ?? 'fa-check' }}"></i></div>
                <div class="info">
                  <h4>{{ $feature['title'] ?? '' }}</h4>
                  <p>{{ $feature['desc'] ?? '' }}</p>
                </div>
              </div>
            @endforeach
          @else
            <div class="why-feature"><div class="icon"><i class="fas fa-users"></i></div><div class="info"><h4>فريق مدرب ومحترف</h4><p>عمالة مدربة على أعلى مستوى من الكفاءة والأمانة</p></div></div>
            <div class="why-feature"><div class="icon"><i class="fas fa-leaf"></i></div><div class="info"><h4>مواد آمنة وصديقة للبيئة</h4><p>نستخدم منظفات آمنة لأسرتكم وأطفالكم وحيواناتكم الأليفة</p></div></div>
            <div class="why-feature"><div class="icon"><i class="fas fa-clock"></i></div><div class="info"><h4>التزام بالمواعيد</h4><p>نحترم وقتك ونلتزم بالموعد المحدد دائماً</p></div></div>
            <div class="why-feature"><div class="icon"><i class="fas fa-shield-alt"></i></div><div class="info"><h4>ضمان الرضا الكامل</h4><p>إذا لم تكن راضياً تماماً، سنعيد العمل مجاناً</p></div></div>
            <div class="why-feature"><div class="icon"><i class="fas fa-tags"></i></div><div class="info"><h4>أسعار تنافسية وشفافة</h4><p>لا رسوم خفية، أسعار واضحة قبل البدء بالعمل</p></div></div>
          @endif
        </div>
      </div>
      <div class="why-visual">
        <div class="why-img @if(!($homeSettings['why']['image'] ?? false)) img-placeholder @endif">
          @if($homeSettings['why']['image'] ?? false)
            <img src="{{ $homeSettings['why']['image'] }}" alt="Why Us">
          @else
            <i class="fas fa-spray-can"></i><span>فريق العمل أثناء التنظيف</span>
          @endif
        </div>
        <div class="why-badge">
          <span class="num">{{ $homeSettings['why']['badgeNum'] ?? '100%' }}</span>
          <span class="lbl">{{ $homeSettings['why']['badgeLabel'] ?? 'رضا العملاء' }}</span>
        </div>
      </div>
    </div>
  </div>
</section>
