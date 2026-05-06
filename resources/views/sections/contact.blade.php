<section id="contact">
  <div class="container">
    <div class="section-title">
      <div class="badge"><i class="fas fa-envelope"></i> تواصل معنا</div>
      <h2>نحن هنا <span class="text-gold">لخدمتك</span></h2>
    </div>
    <div class="contact-grid">
      <div class="contact-info">
        <h3>بيانات التواصل</h3>
        <div class="contact-item">
          <div class="icon"><i class="fas fa-phone"></i></div>
          <div class="info"><strong>الهاتف الأساسي</strong><a href="tel:{{ $contactSettings['phone'] ?? '0550000000' }}">{{ $contactSettings['phone'] ?? '0550000000' }}</a></div>
        </div>
        <div class="contact-item">
          <div class="icon" style="background:linear-gradient(135deg,#25d366,#128c7e)"><i class="fab fa-whatsapp"></i></div>
          <div class="info"><strong>واتساب</strong><a href="https://wa.me/{{ $contactSettings['whatsapp'] ?? '966550000000' }}">{{ $contactSettings['phone'] ?? '0550000000' }}</a></div>
        </div>
        <div class="contact-item">
          <div class="icon" style="background:linear-gradient(135deg,var(--gold),#e8c56a)"><i class="fas fa-envelope"></i></div>
          <div class="info"><strong>البريد الإلكتروني</strong><a href="mailto:{{ $contactSettings['email'] ?? 'info@alostora.com' }}">{{ $contactSettings['email'] ?? 'info@alostora.com' }}</a></div>
        </div>
        <div class="contact-item">
          <div class="icon" style="background:linear-gradient(135deg,var(--green),var(--green-light))"><i class="fas fa-map-marker-alt"></i></div>
          <div class="info"><strong>العنوان</strong><p>{{ $contactSettings['address'] ?? 'بريدة، منطقة القصيم، المملكة العربية السعودية' }}</p></div>
        </div>
        <div class="contact-item">
          <div class="icon" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)"><i class="fas fa-clock"></i></div>
          <div class="info"><strong>ساعات العمل</strong><p>{{ $contactSettings['hours'] ?? 'السبت - الخميس: 7ص - 10م' }}</p></div>
        </div>
        <div style="height:200px;background:var(--gray-100);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--gray-500);margin-top:20px">
          <div style="text-align:center"><i class="fas fa-map" style="font-size:32px;margin-bottom:8px;display:block"></i><span style="font-size:14px">خريطة Google Maps</span></div>
        </div>
      </div>
      <div class="contact-form">
        <h3 style="font-size:20px;font-weight:900;color:var(--primary);margin-bottom:24px;font-family:var(--font-alt)">أرسل رسالة</h3>
        <form id="contactForm">
          <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:15px">
            <div class="form-group"><label>الاسم الكامل</label><input type="text" name="name" placeholder="أدخل اسمك"></div>
            <div class="form-group"><label>رقم الجوال</label><input type="text" name="phone" placeholder="05XXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')"></div>
          </div>
          <div class="form-group" style="margin-top:15px"><label>البريد الإلكتروني</label><input type="email" name="email" placeholder="example@email.com"></div>
          <div class="form-group" style="margin-top:15px"><label>الموضوع</label><input type="text" name="subject" placeholder="موضوع رسالتك"></div>
          <div class="form-group" style="margin-top:15px"><label>الرسالة</label><textarea name="message" placeholder="اكتب رسالتك هنا..."></textarea></div>
          <button type="submit" class="btn btn-primary" style="margin-top:15px"><i class="fas fa-paper-plane"></i> إرسال الرسالة</button>
        </form>
      </div>
    </div>
  </div>
</section>
