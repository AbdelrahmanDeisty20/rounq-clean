<section id="offers">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-percent"></i> عروضنا</div>
      <h2>عروض وباقات <span class="text-gold">لكل ميزانية</span></h2>
      <p>اختر الباقة التي تناسبك واستمتع بأفضل خدمات التنظيف في القصيم</p>
    </div>
    <div class="offers-grid">
      @foreach($offers as $offer)
      <div class="offer-card {{ $offer->is_featured ? 'featured' : '' }}">
        @if($offer->is_featured) <div class="offer-badge">الأكثر طلباً</div> @endif
        <div class="offer-header">
          <h3>{{ $offer->title }}</h3>
          <div class="offer-price">
            @if($offer->old_price) <span class="old" style="text-decoration: line-through; font-size: 16px; color: var(--gray-500); display: block">{{ $offer->old_price }} ر.س</span> @endif
            <span class="new">{{ $offer->price }}</span>
            <span class="unit">ر.س</span>
          </div>
        </div>
        <div class="offer-body">
          <ul class="offer-features" style="list-style: none; padding: 0; margin-bottom: 25px; text-align: right">
            @foreach(explode("\n", $offer->features) as $f)
              @if(trim($f))
              <li style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px; font-size: 14px">
                <i class="fas fa-check" style="color: var(--green)"></i> {{ $f }}
              </li>
              @endif
            @endforeach
          </ul>
          <button class="btn btn-primary" style="width: 100%; justify-content: center" onclick="openModal()">اطلب هذه الباقة</button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
