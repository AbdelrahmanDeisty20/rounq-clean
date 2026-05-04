<section id="gallery" style="background:white">
  <div class="container">
    <div class="section-title">
      <h2 style="font-size:42px; font-weight:900; color:#1e3a8a">أعمالنا <span class="text-gold">تتحدث عنا</span></h2>
      <p style="color:#64748b; font-size:16px; margin-top:10px">صور قبل وبعد من مشاريع نظافة حقيقية نفذناها في القصيم</p>
    </div>
    
    <div class="gallery-grid" style="display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-top:40px">
      @foreach($gallery as $img)
      <div class="gallery-card" style="background:#eef5ff; border-radius:24px; aspect-ratio:1/1; display:flex; flex-direction:column; align-items:center; justify-content:center; position:relative; cursor:pointer; transition:all 0.3s ease; overflow:hidden">
        <div class="gallery-icon-wrap" style="transition:all 0.3s ease; display:flex; flex-direction:column; align-items:center">
           @if($img->url)
             <img src="{{ $img->url }}" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0; transition:all 0.3s ease">
           @endif
           
           @if($img->icon)
             <i class="fas {{ $img->icon }}" style="font-size:40px; color:#94a3b8; margin-bottom:15px"></i>
           @else
             <i class="fas fa-home" style="font-size:40px; color:#94a3b8; margin-bottom:15px"></i>
           @endif
           <span style="font-size:14px; font-weight:700; color:#64748b">{{ $img->title ?? 'تنظيف شامل' }}</span>
        </div>
        
        <div class="gallery-hover-overlay" style="position:absolute; inset:0; background:rgba(30,58,138,0.7); display:flex; align-items:center; justify-content:center; opacity:0; transition:all 0.3s ease; backdrop-filter:blur(2px)">
           <i class="fas fa-search-plus" style="font-size:32px; color:white"></i>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<style>
.gallery-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(30,58,138,0.1); }
.gallery-card:hover .gallery-hover-overlay { opacity: 1; }
.gallery-card:hover .gallery-icon-wrap img { opacity: 1; }
</style>
