<section id="areas-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-map-marker-alt"></i> مناطق الخدمة</div>
      <h2>نخدم <span class="text-gold">جميع أنحاء القصيم</span></h2>
      <p>نصلك أينما كنت في منطقة القصيم</p>
    </div>
    <div class="areas-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px">
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
        <div class="area-card" style="background: white; padding: 25px; border-radius: 20px; text-align: center; box-shadow: var(--shadow); transition: var(--transition)">
          <div class="area-icon" style="font-size: 32px; margin-bottom: 10px">{{ $area['icon'] }}</div>
          <h3 style="font-size: 16px; color: var(--primary); margin-bottom: 5px">{{ $area['name'] }}</h3>
          <p style="font-size: 12px; color: var(--gray-500)">{{ $area['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
