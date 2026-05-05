<section id="steps-section">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-list-ol"></i> آلية العمل</div>
      <h2>كيف <span class="text-gold">نعمل؟</span></h2>
      <p>خطوات بسيطة للحصول على خدمة نظافة احترافية في منزلك</p>
    </div>
    <div class="steps-grid">
      @foreach($homeSettings['steps']['items'] ?? [] as $step)
        @php 
          $hasLinks = !empty($step['call_link']) || !empty($step['wa_link']);
        @endphp
        <div class="step-card {{ $hasLinks ? 'clickable' : '' }}" 
             @if($hasLinks) onclick="showStepContact('{{ $step['call_link'] ?? '' }}', '{{ $step['wa_link'] ?? '' }}')" @endif
             style="{{ $hasLinks ? 'cursor: pointer;' : '' }}">
          <div class="step-num"><i class="fas {{ $step['icon'] ?? 'fa-check' }}"></i></div>
          <h3>{{ $step['title'] ?? '' }}</h3>
          <p>{{ $step['desc'] ?? '' }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Step Contact Modal -->
<div class="modal-overlay" id="stepContactModal" style="z-index: 11000;">
    <div class="modal" style="max-width: 400px; text-align: center; padding: 30px;">
        <div class="modal-header" style="justify-content: center; margin-bottom: 20px;">
            <h3 style="font-family: var(--font-alt); font-weight: 900;">تواصل معنا الآن</h3>
            <button class="modal-close" onclick="closeStepContact()" style="position: absolute; left: 20px; top: 20px;">&times;</button>
        </div>
        <div class="modal-body" style="padding: 0;">
            <p style="margin-bottom: 25px; color: var(--gray-700); font-size: 15px;">اختر طريقة التواصل المناسبة لك لطلب الخدمة</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <a id="stepCallBtn" href="#" class="btn btn-primary" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px 10px; border-radius: 15px; gap: 10px; height: 120px;">
                    <i class="fas fa-phone" style="font-size: 28px;"></i>
                    <span>اتصال هاتفي</span>
                </a>
                <a id="stepWaBtn" href="#" class="btn btn-whatsapp" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 20px 10px; border-radius: 15px; gap: 10px; height: 120px;">
                    <i class="fab fa-whatsapp" style="font-size: 32px;"></i>
                    <span>مراسلة واتساب</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
window.showStepContact = function(call, wa) {
    if (call) {
        // Add tel: if it's just a number
        let callUrl = call;
        if (!call.startsWith('tel:') && !call.startsWith('http')) {
            callUrl = 'tel:' + call.replace(/\s/g, '');
        }
        $('#stepCallBtn').attr('href', callUrl).css('display', 'flex');
    } else {
        $('#stepCallBtn').hide();
    }
    
    if (wa) {
        // Ensure WhatsApp link is correct
        let waUrl = wa;
        if (!wa.startsWith('http')) {
            // Remove + and spaces, add wa.me
            let cleanWa = wa.replace(/\+|\s/g, '');
            waUrl = 'https://wa.me/' + cleanWa;
        }
        $('#stepWaBtn').attr('href', waUrl).attr('target', '_blank').css('display', 'flex');
    } else {
        $('#stepWaBtn').hide();
    }
    
    $('#stepContactModal').addClass('open');
};

window.closeStepContact = function() {
    $('#stepContactModal').removeClass('open');
};

// Close modal when clicking outside
$(document).on('click', '#stepContactModal', function(e) {
    if ($(e.target).hasClass('modal-overlay')) {
        closeStepContact();
    }
});
</script>
