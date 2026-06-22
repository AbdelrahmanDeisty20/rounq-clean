<?php

namespace App\Http\Controllers;

use App\Services\ServiceService;
use App\Services\OfferService;
use App\Services\TestimonialService;
use App\Services\FaqService;
use App\Services\BlogService;
use App\Services\SettingService;
use App\Services\BookingService;
use App\Services\MessageService;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ContactRequest;
use App\Services\GalleryService;
use App\Services\VideoService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    protected $serviceService;
    protected $offerService;
    protected $testimonialService;
    protected $faqService;
    protected $blogService;
    protected $settingService;
    protected $bookingService;
    protected $messageService;
    protected $galleryService;
    protected $videoService;

    public function __construct(
        ServiceService $serviceService,
        OfferService $offerService,
        TestimonialService $testimonialService,
        FaqService $faqService,
        BlogService $blogService,
        SettingService $settingService,
        BookingService $bookingService,
        MessageService $messageService,
        GalleryService $galleryService,
        VideoService $videoService
    ) {
        $this->serviceService = $serviceService;
        $this->offerService = $offerService;
        $this->testimonialService = $testimonialService;
        $this->faqService = $faqService;
        $this->blogService = $blogService;
        $this->settingService = $settingService;
        $this->bookingService = $bookingService;
        $this->messageService = $messageService;
        $this->galleryService = $galleryService;
        $this->videoService = $videoService;
    }

    public function index()
    {
        $services = $this->serviceService->getAllActive();
        $offers = $this->offerService->getAllActive();
        $testimonials = $this->testimonialService->getAllActive();
        $faqs = $this->faqService->getAllActive();
        $blogs = $this->blogService->getPublished(3);
        $gallery = $this->galleryService->getAll();
        $videos = $this->videoService->getAllActive();
        
        return view('welcome', compact('services', 'offers', 'testimonials', 'faqs', 'blogs', 'gallery', 'videos'));
    }

    public function about()
    {
        $services = $this->serviceService->getAllActive();
        return view('about', compact('services'));
    }

    public function services()
    {
        $services = $this->serviceService->getAllActive();
        return view('services', compact('services'));
    }

    public function gallery()
    {
        $services = $this->serviceService->getAllActive();
        $gallery = $this->galleryService->getAll();
        return view('gallery', compact('services', 'gallery'));
    }

    public function blog()
    {
        $services = $this->serviceService->getAllActive();
        $blogs = $this->blogService->getPublished(12);
        return view('blog', compact('services', 'blogs'));
    }

    public function contact()
    {
        $services = $this->serviceService->getAllActive();
        return view('contact', compact('services'));
    }

    public function storeBooking(BookingRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'new';
        
        $booking = $this->bookingService->create($data);
        
        // Here you could send an email notification:
        // Mail::to(config('mail.from.address'))->send(new NewBooking($booking));

        return response()->json(['success' => true, 'booking' => $booking]);
    }

    public function storeContact(ContactRequest $request)
    {
        $data = $request->validated();
        $message = $this->messageService->create($data);
        return response()->json(['success' => true, 'message' => 'تم استلام رسالتك بنجاح']);
    }

    public function trackClick(Request $request)
    {
        $type = $request->type; // 'whatsapp' or 'phone'
        $key = ($type == 'whatsapp') ? 'wa_clicks' : 'phone_clicks';
        
        $setting = \App\Models\Setting::where('key', $key)->first();
        if ($setting) {
            $setting->update(['value' => (int)$setting->value + 1]);
        } else {
            \App\Models\Setting::create(['key' => $key, 'value' => 1]);
        }
        
        return response()->json(['success' => true]);
    }
}
