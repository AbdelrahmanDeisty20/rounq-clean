<section id="areas-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-map-marker-alt"></i> مناطق الخدمة</div>
      <h2>نخدم <span class="text-gold">جميع أنحاء القصيم</span></h2>
      <p>نصلك أينما كنت في منطقة القصيم</p>
    </div>
    <div class="areas-grid">
      @php
        $areas = [
          ['icon' => '🏙️', 'name' => 'بريدة', 'desc' => 'العاصمة الرئيسية'],
          ['icon' => '🌆', 'name' => 'عنيزة', 'desc' => 'مدينة الورود'],
          ['icon' => '🏘️', 'name' => 'الرس', 'desc' => 'المدينة التاريخية'],
          ['icon' => '🏡', 'name' => 'البكيرية', 'desc' => 'المدينة الزراعية'],
          ['icon' => '🌿', 'name' => 'المذنب', 'desc' => 'مدينة النخيل'],
          ['icon' => '🏗️', 'name' => 'البدائع', 'desc' => 'المدينة الحديثة'],
          ['icon' => '🌄', 'name' => 'رياض الخبراء', 'desc' => 'المدينة الجميلة'],
          ['icon' => '💧', 'name' => 'عيون الجواء', 'desc' => 'مدينة العيون'],
          ['icon' => '⭐', 'name' => 'الشماسية', 'desc' => 'مدينة التراث'],
        ];
      @endphp
      @foreach($areas as $area)
        <div class="area-card">
          <div class="area-icon">{{ $area['icon'] }}</div>
          <h3>{{ $area['name'] }}</h3>
          <p>{{ $area['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
