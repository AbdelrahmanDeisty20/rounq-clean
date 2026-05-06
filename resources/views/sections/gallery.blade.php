<section id="gallery-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-images"></i> أعمالنا</div>
      <h2>أعمالنا <span class="text-gold">تتحدث عنا</span></h2>
      <p>صور من مشاريع نظافة حقيقية نفذناها في القصيم</p>
    </div>
    
    <div class="gallery-grid">
      @foreach($gallery as $img)
      <div class="gallery-card">
        <div class="card-img-container">
          @if($img->url)
            <img src="{{ asset($img->url) }}" alt="{{ $img->title }}" class="card-img">
          @else
            <div class="card-img-placeholder">
              <i class="fas {{ $img->icon ?? 'fa-home' }}"></i>
            </div>
          @endif
          <div class="card-overlay">
            <i class="fas fa-expand"></i>
          </div>
        </div>
        <div class="card-content">
          <h4>{{ $img->title }}</h4>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
