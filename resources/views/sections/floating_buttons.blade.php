<div class="floating-buttons">
  @php 
    $waFloat = $contactSettings['whatsapp'] ?? '966550000000';
    $waFloat = str_replace(['+', ' '], '', $waFloat);
    if (str_starts_with($waFloat, '0')) { $waFloat = '966' . substr($waFloat, 1); }
  @endphp
  <a href="https://wa.me/{{ $waFloat }}?text=السلام عليكم، أود الاستفسار" class="float-btn float-btn-wa" id="floatWa">
    <i class="fab fa-whatsapp"></i>
    <span class="tooltip">تواصل واتساب</span>
  </a>
  <a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}" class="float-btn float-btn-phone" id="floatPhone">
    <i class="fas fa-phone"></i>
    <span class="tooltip">اتصل الآن</span>
  </a>
</div>
