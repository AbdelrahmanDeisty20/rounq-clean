@extends('layouts.app')

@section('content')
    <div class="site-wrap" id="siteWrap">
        @include('sections.header')
        @include('sections.hero')
        @include('sections.videos')
        @include('sections.services')
        @include('sections.why_us')
        @include('sections.steps')
        @include('sections.offers')
        @include('sections.testimonials')
        @include('sections.gallery')
        @include('sections.areas')
        @include('sections.faq')
        @include('sections.blog')
        @include('sections.cta')
        @include('sections.contact')
        @include('sections.footer')
        @include('sections.request_modal')
        @include('sections.floating_buttons')
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <span id="notifText">تم الإجراء بنجاح</span>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            window.openModal = (serviceName = '') => {
                if (serviceName) {
                    $('#requestModal').find('select[name="service"]').val(serviceName);
                }
                $('#requestModal').addClass('open');
            };
            window.closeModal = () => $('#requestModal').removeClass('open');
            window.toggleMobile = () => $('#mobileNav').toggleClass('open');

            // Contact Form Submission
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const btn = form.find('button[type="submit"]');

                // Basic Validation
                const name = form.find('[name="name"]').val();
                const phone = form.find('[name="phone"]').val();
                const message = form.find('[name="message"]').val();

                if (!name || !phone || !message) {
                    showSiteNotif('يرجى ملء الاسم ورقم الجوال ونص الرسالة', 'error');
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...');

                $.ajax({
                    url: '{{ route('contact.store') }}',
                    method: 'POST',
                    data: form.serialize(),
                    success: function () {
                        showSiteNotif('تم إرسال رسالتك بنجاح ✅ سنتواصل معك قريباً');
                        form[0].reset();
                    },
                    error: function () {
                        showSiteNotif('حدث خطأ أثناء الإرسال، يرجى المحاولة لاحقاً', 'error');
                    },
                    complete: function () {
                        btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> إرسال الرسالة');
                    }
                });
            });

            // Request Modal Submission
            $('#bookingForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const btn = form.find('button[type="submit"]');

                // Validation
                const name = form.find('[name="name"]').val();
                const phone = form.find('[name="phone"]').val();
                const city = form.find('[name="city"]').val();
                const service = form.find('[name="service"]').val();

                if (!name || !phone || !city || !service) {
                    showSiteNotif('يرجى إكمال البيانات المطلوبة (الاسم، الجوال، المدينة، الخدمة)', 'error');
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...');

                $.ajax({
                    url: '{{ route('booking.store') }}',
                    method: 'POST',
                    data: form.serialize(),
                    success: function () {
                        showSiteNotif('تم استلام طلبك بنجاح ✅ سنتصل بك فوراً');
                        form[0].reset();
                        closeModal();
                    },
                    error: function () {
                        showSiteNotif('حدث خطأ أثناء الإرسال، يرجى المحاولة لاحقاً', 'error');
                    },
                    complete: function () {
                        btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> إرسال الطلب الآن');
                    }
                });
            });

            window.showSiteNotif = function (msg, type = 'success') {
                const notif = $('#notification');
                notif.find('#notifText').text(msg);
                notif.find('i').attr('class', type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle');
                notif.css('background', type === 'success' ? 'var(--primary)' : '#ef5350');
                notif.addClass('show');
                setTimeout(() => notif.removeClass('show'), 5000);
            };
        });
    </script>
@endsection