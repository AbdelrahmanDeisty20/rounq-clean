@if($videos->count() > 0)
<section id="videos" style="padding: 60px 0; background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
  <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    <div class="section-title" style="text-align: center; margin-bottom: 40px;">
      <div class="badge" style="background: rgba(197, 160, 89, 0.1); color: #c5a059; padding: 6px 15px; border-radius: 50px; display: inline-flex; align-items: center; gap: 8px; font-size: 13px; font-weight: bold; margin-bottom: 15px;">
        <i class="fas fa-video"></i> فيديوهات حية من الميدان
      </div>
      <h2 style="font-size: 32px; color: #1e293b; font-weight: 800; margin: 0 0 10px;">عروض <span class="text-gold" style="color: #c5a059;">فيديو حية</span> عملائنا</h2>
      <p style="color: #64748b; font-size: 15px; max-width: 600px; margin: 0 auto;">شاهد خدماتنا مباشرة واطلع على جودة ودقة العمل لعمالنا في الميدان</p>
    </div>
    
    <div class="videos-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px;">
      @foreach($videos as $video)
      <div class="video-card" onclick="playSiteVideo('{{ asset($video->url) }}')" style="background: black; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid #f1f5f9; position: relative; padding-top: 56.25%;">
        <!-- Video Element Pre-rendered with first frame metadata -->
        <video src="{{ asset($video->url) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" muted playsinline preload="metadata"></video>
        
        <!-- Play Button Overlay -->
        <div class="play-btn-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.4); display: flex; align-items: center; justify-content: center; transition: background 0.3s ease; z-index: 2;">
          <div class="play-btn-circle" style="width: 65px; height: 65px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(197, 160, 89, 0.4); transition: transform 0.3s ease, background-color 0.3s ease;">
            <i class="fas fa-play" style="color: #c5a059; font-size: 22px; margin-right: -4px;"></i>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Video Lightbox Modal -->
  <div id="siteVideoModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.95); z-index: 99999; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(10px);">
    <div style="position: absolute; top: 25px; left: 25px; color: white; font-size: 32px; cursor: pointer; z-index: 100000; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.15); border-radius: 50%; transition: background 0.2s;" onclick="closeSiteVideo()" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
      &times;
    </div>
    <div style="width: 100%; max-width: 960px; background: black; border-radius: 20px; overflow: hidden; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6); border: 1px solid rgba(255,255,255,0.1); position: relative;">
      <div style="position: relative; padding-top: 56.25%; background: black;">
        <video id="siteVideoTag" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; background: black;" controls autoplay playsinline></video>
      </div>
    </div>
  </div>
</section>

<!-- Additional Hover Styles -->
<style>
  .video-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(197, 160, 89, 0.2);
    border-color: rgba(197, 160, 89, 0.4);
  }
  .video-card:hover video {
    transform: scale(1.04);
  }
  .video-card:hover .play-btn-circle {
    transform: scale(1.12);
    background: #c5a059;
  }
  .video-card:hover .play-btn-circle i {
    color: white;
  }
  .video-card:hover .play-btn-overlay {
    background: rgba(15, 23, 42, 0.2);
  }
</style>

<script>
  function playSiteVideo(url) {
    const videoTag = document.getElementById('siteVideoTag');
    videoTag.src = url;
    videoTag.load();
    document.getElementById('siteVideoModal').style.display = 'flex';
    videoTag.play().catch(function(error) {
       console.log("Autoplay was prevented, waiting for user interaction");
    });
  }

  function closeSiteVideo() {
    const videoTag = document.getElementById('siteVideoTag');
    videoTag.pause();
    videoTag.src = '';
    document.getElementById('siteVideoModal').style.display = 'none';
  }
  
  // Close on backdrop click
  document.getElementById('siteVideoModal').addEventListener('click', function(e) {
    if (e.target === this) {
      closeSiteVideo();
    }
  });
</script>
@endif
