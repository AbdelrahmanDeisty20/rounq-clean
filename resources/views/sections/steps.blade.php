<section id="steps-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-list-ol"></i> آلية العمل</div>
      <h2>كيف <span class="text-gold">نعمل؟</span></h2>
      <p>خطوات بسيطة للحصول على خدمة نظافة احترافية في منزلك</p>
    </div>
    <div class="steps-grid">
      @foreach($homeSettings['steps']['items'] ?? [] as $step)
        <div class="step-card">
          <div class="step-num"><i class="fas {{ $step['icon'] ?? 'fa-check' }}"></i></div>
          <h3>{{ $step['title'] ?? '' }}</h3>
          <p>{{ $step['desc'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
