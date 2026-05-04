<section id="testimonials">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-comments"></i> آراء العملاء</div>
      <h2>ماذا يقول <span class="text-gold">عملاؤنا</span></h2>
      <p>آلاف العائلات السعودية تثق بنا للحفاظ على نظافة منازلهم</p>
    </div>
    <div class="testimonials-grid">
      @foreach($testimonials as $tst)
      <div class="testimonial-card">
        <div class="stars">
          @for($i=0; $i < ($tst->rating ?? 5); $i++)
            <i class="fas fa-star"></i>
          @endfor
        </div>
        <p>{{ $tst->content }}</p>
        <div class="testimonial-author">
          <div class="author-avatar">{{ mb_substr($tst->name, 0, 1) }}</div>
          <div class="author-info">
            <strong>{{ $tst->name }}</strong>
            <span>{{ $tst->city ?? 'القصيم' }} | {{ $tst->service ?? 'تنظيف منازل' }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
