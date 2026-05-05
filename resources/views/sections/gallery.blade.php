<section id="gallery-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-images"></i> أعمالنا</div>
      <h2>أعمالنا <span class="text-gold">تتحدث عنا</span></h2>
      <p>صور من مشاريع نظافة حقيقية نفذناها في القصيم</p>
    </div>
    
    <div class="gallery-grid">
      @foreach($gallery as $img)
      <div class="gallery-item" style="background:white; border-radius:var(--radius); overflow:hidden; box-shadow:var(--shadow); display:flex; flex-direction:column; border:1px solid var(--gray-200)">
        <div class="gallery-img-wrap" style="aspect-ratio:4/3; overflow:hidden; background:#f8fafc; display:flex; align-items:center; justify-content:center; position:relative">
          @if($img->url)
            <img src="{{ asset($img->url) }}" alt="{{ $img->title }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s">
          @else
            <i class="fas {{ $img->icon ?? 'fa-home' }}" style="font-size:40px; color:var(--primary); opacity:0.6"></i>
          @endif
          
          <div class="gallery-overlay" style="position:absolute; inset:0; background:rgba(26,58,107,0.4); display:flex; align-items:center; justify-content:center; opacity:0; transition:0.3s">
            <i class="fas fa-search-plus" style="color:white; font-size:24px"></i>
          </div>
        </div>
        <div class="gallery-info" style="padding:15px; text-align:center; background:white">
          <h4 style="font-size:14px; font-weight:800; color:var(--primary); margin:0">{{ $img->title }}</h4>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
