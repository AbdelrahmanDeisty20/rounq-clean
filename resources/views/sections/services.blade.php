<section id="services">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-broom"></i> خدماتنا</div>
      <h2>خدمات التنظيف <span class="text-gold">المتكاملة</span></h2>
      <p>نوفر طيفاً واسعاً من خدمات التنظيف الاحترافية لتلبية كافة احتياجاتكم في منطقة القصيم</p>
    </div>
    
    <div class="services-grid">
      @foreach($services as $service)
      <div class="service-card" onclick="openModal('{{ $service->name }}')">
        <div class="svc-icon">
          @if(str_starts_with($service->icon, '/uploads/'))
            <img src="{{ $service->icon }}" alt="{{ $service->name }}" style="width:100%; height:100%; object-fit:contain">
          @else
            <i class="fas {{ $service->icon ?? 'fa-broom' }}"></i>
          @endif
        </div>
        <h3>{{ $service->name }}</h3>
        <p>{{ $service->short_desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
