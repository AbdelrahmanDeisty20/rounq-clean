<div class="admin-panel active" id="panelStats">
  <div class="stats-row">
    <div class="stat-box">
      <div class="stat-icon blue"><i class="fas fa-clipboard-list"></i></div>
      <div class="stat-info">
        <div class="num" id="statReqs">0</div>
        <div class="lbl">طلبات الخدمة</div>
      </div>
    </div>
    <div class="stat-box">
      <div class="stat-icon gold"><i class="fas fa-envelope"></i></div>
      <div class="stat-info">
        <div class="num" id="statMsgs">0</div>
        <div class="lbl">رسائل التواصل</div>
      </div>
    </div>
    <div class="stat-box">
      <div class="stat-icon green"><i class="fas fa-broom"></i></div>
      <div class="stat-info">
        <div class="num" id="statSvcs">{{ $services->count() }}</div>
        <div class="lbl">الخدمات النشطة</div>
      </div>
    </div>
    <div class="stat-box">
      <div class="stat-icon red"><i class="fas fa-chart-line"></i></div>
      <div class="stat-info">
        <div class="num" id="statClicks">0</div>
        <div class="lbl">نقرات الاتصال</div>
      </div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
    <div class="admin-card">
      <div class="admin-card-header"><h3>آخر طلبات الخدمة</h3><button class="admin-btn secondary" onclick="showPanel('panelBookings')">عرض الكل</button></div>
      <div class="admin-card-body" id="latestReqs" style="font-size:14px;color:var(--gray-500);text-align:center;padding:30px">لا توجد طلبات بعد</div>
    </div>
    <div class="admin-card">
      <div class="admin-card-header"><h3>آخر رسائل التواصل</h3><button class="admin-btn secondary" onclick="showPanel('panelMessages')">عرض الكل</button></div>
      <div class="admin-card-body" id="latestMsgs" style="font-size:14px;color:var(--gray-500);text-align:center;padding:30px">لا توجد رسائل بعد</div>
    </div>
  </div>
</div>
