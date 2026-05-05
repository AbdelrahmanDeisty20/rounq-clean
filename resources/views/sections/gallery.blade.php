<section id="gallery-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-images"></i> أعمالنا</div>
      <h2>أعمالنا <span class="text-gold">تتحدث عنا</span></h2>
      <p>صور من مشاريع نظافة حقيقية نفذناها في القصيم</p>
    </div>
    
    <div class="gallery-grid">
      @foreach($gallery as $img)
      <div class="gallery-item @if(!$img->url) img-placeholder @endif">
        @if($img->url)
          <img src="{{ $img->url }}" alt="{{ $img->title ?? 'Gallery Image' }}">
        @else
          <i class="fas {{ $img->icon ?? 'fa-home' }}"></i>
          <span>{{ $img->title ?? 'تنظيف شامل' }}</span>
        @endif
        
        <div class="gallery-overlay">
          <i class="fas fa-search-plus"></i>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
