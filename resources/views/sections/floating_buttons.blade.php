<div class="floating-buttons">
  <a href="https://wa.me/{{ $contactSettings['whatsapp'] ?? '966550000000' }}?text=السلام عليكم، أود الاستفسار" class="float-btn float-btn-wa" id="floatWa">
    <i class="fab fa-whatsapp"></i>
    <span class="tooltip">تواصل واتساب</span>
  </a>
  <a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}" class="float-btn float-btn-phone" id="floatPhone">
    <i class="fas fa-phone"></i>
    <span class="tooltip">اتصل الآن</span>
  </a>
</div>
