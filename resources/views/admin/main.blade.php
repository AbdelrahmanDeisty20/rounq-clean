<div class="admin-wrap" id="adminWrap">

<!-- SIDEBAR -->
<div class="admin-sidebar" id="adminSidebar">
  <div class="admin-logo">
    <h2><i class="fas fa-star" style="color:var(--gold)"></i> لوحة التحكم</h2>
    <span>الأسطورة رونق قلب الخليج</span>
  </div>
  <div class="admin-nav">
    <div class="admin-nav-section">الرئيسية</div>
    <a href="javascript:void(0)" class="nav-item active" onclick="showPanel('panelStats',this)"><i class="fas fa-chart-line"></i> لوحة التحكم</a>

    <div class="admin-nav-section">إدارة المحتوى</div>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelHomeManager',this)"><i class="fas fa-home"></i> إدارة الصفحة الرئيسية</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelServices',this)"><i class="fas fa-broom"></i> الخدمات</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelOffers',this)"><i class="fas fa-percent"></i> العروض والباقات</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelTestimonials',this)"><i class="fas fa-star"></i> آراء العملاء</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelFaq',this)"><i class="fas fa-question-circle"></i> الأسئلة الشائعة</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelGallery',this)"><i class="fas fa-images"></i> معرض الصور</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelBlog',this)"><i class="fas fa-blog"></i> المقالات</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelSeo',this)"><i class="fas fa-search"></i> إعدادات SEO</a>

    <div class="admin-nav-section">الطلبات والرسائل</div>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelBookings',this)"><i class="fas fa-clipboard-list"></i> طلبات الخدمة <span class="badge-count" id="reqCount">0</span></a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelMessages',this)"><i class="fas fa-envelope"></i> رسائل التواصل <span class="badge-count" id="msgCount">0</span></a>

    <div class="admin-nav-section">الإعدادات</div>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelSettings',this)"><i class="fas fa-cogs"></i> إعدادات الموقع</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelUsers',this)"><i class="fas fa-users-cog"></i> إدارة المستخدمين</a>
    <a href="javascript:void(0)" class="nav-item" onclick="showPanel('panelAnalytics',this)"><i class="fas fa-chart-bar"></i> الإحصائيات</a>

    <div class="admin-nav-section">الحساب</div>
    <a href="javascript:void(0)" onclick="doLogout()" style="color:#ef9090"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
  </div>
</div>

<!-- MAIN -->
<div class="admin-main">
  <div class="admin-header">
    <h1 id="adminPageTitle">لوحة التحكم الرئيسية</h1>
    <div class="admin-header-actions">
      <a href="javascript:void(0)" onclick="goToSite()" class="admin-btn secondary"><i class="fas fa-eye"></i> عرض الموقع</a>
      <span style="font-size:13px;color:var(--gray-500)"><i class="fas fa-user-circle"></i> مرحباً، المدير العام</span>
    </div>
  </div>

  <div class="admin-content">
    @include('admin.panels.stats')
    @include('admin.panels.bookings')
    @include('admin.panels.messages')
    @include('admin.panels.services')
    @include('admin.panels.settings')
    @include('admin.panels.home_manager')
    @include('admin.panels.users')
    <div class="admin-panel" id="panelAnalytics">
        <div class="admin-card">
            <div class="admin-card-header"><h3>إحصائيات النقرات</h3></div>
            <div class="admin-card-body">قريباً...</div>
        </div>
    </div>
    @include('admin.panels.offers')
    @include('admin.panels.testimonials')
    @include('admin.panels.faq')
    @include('admin.panels.gallery')
    @include('admin.panels.blog')
    @include('admin.panels.seo')
  </div>
</div>
</div>
