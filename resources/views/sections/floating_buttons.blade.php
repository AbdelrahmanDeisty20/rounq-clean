<div class="floating-buttons">
  @php 
    $waFloat = $contactSettings['whatsapp'] ?? $contactSettings['phone'] ?? '966550000000';
    if (!str_contains($waFloat, 'wa.me') && !str_contains($waFloat, 'http')) {
        $waFloat = str_replace(['+', ' ', '-', '(', ')'], '', $waFloat);
        if (str_starts_with($waFloat, '0')) { $waFloat = '966' . substr($waFloat, 1); }
        $waFloat = 'https://wa.me/' . $waFloat;
    }
  @endphp
  <a href="{{ $waFloat }}?text=السلام عليكم، أود الاستفسار" class="float-btn float-btn-wa" id="floatWa">
    <i class="fab fa-whatsapp"></i>
    <span class="tooltip">تواصل واتساب</span>
  </a>
  <a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}" class="float-btn float-btn-phone" id="floatPhone">
    <i class="fas fa-phone"></i>
    <span class="tooltip">اتصل الآن</span>
  </a>
</div>
