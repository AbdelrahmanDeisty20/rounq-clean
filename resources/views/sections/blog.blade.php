<section id="blog" style="background:#f0f7ff">
  <div class="container">
    <div class="section-title">
      <div class="badge" style="background:#eab308; color:#1e3a8a"><i class="fas fa-newspaper"></i> المقالات</div>
      <h2 style="font-size:36px; font-weight:900">نصائح ومعلومات <span class="text-gold">مفيدة</span></h2>
      <p style="color:#64748b">مقالات متخصصة في عالم التنظيف والنظافة المنزلية</p>
    </div>
    
    <div class="blog-grid">
      @foreach($blogs as $item)
      <div class="blog-card" style="background:white; border-radius:24px; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden; transition:all 0.3s ease">
        <div class="blog-thumb" style="aspect-ratio:16/10; background:#dbeafe; display:flex; align-items:center; justify-content:center; position:relative">
          @if($item->image)
            <img src="{{ $item->image }}" style="width:100%; height:100%; object-fit:cover">
          @else
            <i class="fas fa-rss" style="font-size:48px; color:#93c5fd; opacity:0.8"></i>
          @endif

        </div>
        <div class="blog-body" style="padding:25px; text-align:right">
          <h3 style="font-size:18px; font-weight:900; color:#1e3a8a; margin-bottom:12px; line-height:1.5">{{ $item->title }}</h3>
          <p style="font-size:14px; color:#64748b; line-height:1.8; margin-bottom:20px">{{ Str::limit(strip_tags($item->content), 90) }}</p>
          <div class="blog-meta" style="display:flex; justify-content:flex-end; gap:15px; font-size:12px; color:#94a3b8; border-top:1px solid #f1f5f9; padding-top:15px">
             <span><i class="far fa-clock"></i> 5 دقائق</span>
             <span><i class="far fa-calendar-alt"></i> {{ $item->created_at->format('Y-01-d') }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
