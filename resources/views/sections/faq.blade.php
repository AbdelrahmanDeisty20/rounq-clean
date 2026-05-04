<section id="faq">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-question-circle"></i> الأسئلة الشائعة</div>
      <h2>أسئلة <span class="text-gold">يسألها عملاؤنا</span></h2>
    </div>
    <div class="faq-list">
      @foreach($faqs as $faq)
        <div class="faq-item" style="background: white; border-radius: 15px; margin-bottom: 15px; overflow: hidden; box-shadow: var(--shadow)">
          <div class="faq-question" style="padding: 20px 25px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 700; color: var(--primary)">
            <span>{{ $faq->question }}</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="faq-answer" style="padding: 0 25px 20px; display: none; color: var(--gray-700); font-size: 14px">
            {{ $faq->answer }}
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<script>
$(document).ready(function(){
  $('.faq-question').click(function(){
    $(this).next('.faq-answer').slideToggle();
    $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
  });
});
</script>
