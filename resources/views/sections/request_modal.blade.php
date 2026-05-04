<div class="modal-overlay" id="requestModal">
  <div class="modal">
    <div class="modal-header">
      <h3><i class="fas fa-calendar-check" style="color:var(--gold)"></i> طلب خدمة</h3>
      <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
    </div>
    <form id="bookingForm">
      <div class="form-row">
        <div class="form-group"><label>الاسم الكامل *</label><input type="text" name="name" placeholder="أدخل اسمك الكريم"></div>
        <div class="form-group"><label>رقم الجوال *</label><input type="text" name="phone" placeholder="05XXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')"></div>
      </div>
      <div class="form-row">
        <div class="form-group"><label>المدينة *</label>
          <select name="city">
            <option value="">اختر المدينة</option>
            <option>بريدة</option><option>عنيزة</option><option>الرس</option><option>البكيرية</option>
          </select>
        </div>
        <div class="form-group"><label>نوع الخدمة *</label>
          <select name="service">
            <option value="">اختر الخدمة</option>
            @foreach($services as $s) <option>{{ $s->name }}</option> @endforeach
          </select>
        </div>
      </div>
      <div class="form-group"><label>التاريخ المناسب</label><input type="date" name="date"></div>
      <div class="form-group"><label>ملاحظات إضافية</label><textarea name="notes" placeholder="أي تفاصيل أخرى تود إخبارنا بها..."></textarea></div>
      <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-paper-plane"></i> إرسال الطلب الآن</button>
    </form>
  </div>
</div>
