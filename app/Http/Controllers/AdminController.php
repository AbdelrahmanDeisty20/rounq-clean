<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\FaqRequest;
use App\Http\Requests\OfferRequest;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\TestimonialRequest;
use App\Services\BlogService;
use App\Services\BookingService;
use App\Services\FaqService;
use App\Services\MessageService;
use App\Services\OfferService;
use App\Services\ServiceService;
use App\Services\SettingService;
use App\Services\TestimonialService;
use App\Models\Service;
use App\Models\Offer;
use App\Models\Booking;
use App\Models\Message;
use App\Services\GalleryService;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $serviceService;
    protected $offerService;
    protected $bookingService;
    protected $blogService;
    protected $faqService;
    protected $testimonialService;
    protected $settingService;
    protected $messageService;
    protected $galleryService;

    public function __construct(
        ServiceService $serviceService,
        BookingService $bookingService,
        OfferService $offerService,
        TestimonialService $testimonialService,
        FaqService $faqService,
        BlogService $blogService,
        MessageService $messageService,
        SettingService $settingService,
        GalleryService $galleryService
    ) {
        $this->serviceService = $serviceService;
        $this->bookingService = $bookingService;
        $this->offerService = $offerService;
        $this->testimonialService = $testimonialService;
        $this->faqService = $faqService;
        $this->blogService = $blogService;
        $this->messageService = $messageService;
        $this->settingService = $settingService;
        $this->galleryService = $galleryService;
    }

    // Auth
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
        }
        return response()->json(['success' => false, 'message' => 'بيانات الدخول غير صحيحة'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Dashboard Home
    public function index()
    {
        $servicesCount = Service::count();
        $bookingsCount = Booking::count();
        $messagesCount = Message::count();
        $activeServicesCount = Service::where('is_active', 1)->count();
        
        $waClicks = \App\Models\Setting::where('key', 'wa_clicks')->value('value') ?? 0;
        $phoneClicks = \App\Models\Setting::where('key', 'phone_clicks')->value('value') ?? 0;
        $totalClicks = (int)$waClicks + (int)$phoneClicks;

        $bookings = Booking::latest()->take(5)->get();
        $messages = Message::latest()->take(5)->get();

        return view('admin.pages.dashboard', compact(
            'servicesCount', 'bookingsCount', 'messagesCount', 
            'activeServicesCount', 'bookings', 'messages',
            'waClicks', 'phoneClicks', 'totalClicks'
        ));
    }

    public function services()
    {
        $services = $this->serviceService->getAll();
        return view('admin.pages.services', compact('services'));
    }

    public function bookings()
    {
        $bookings = $this->bookingService->getAll();
        return view('admin.pages.bookings', compact('bookings'));
    }

    public function offers()
    {
        $offers = $this->offerService->getAll();
        return view('admin.pages.offers', compact('offers'));
    }

    public function testimonials()
    {
        $testimonials = $this->testimonialService->getAll();
        $services = $this->serviceService->getAll();
        return view('admin.pages.testimonials', compact('testimonials', 'services'));
    }

    public function faqs()
    {
        $faqs = $this->faqService->getAll();
        return view('admin.pages.faqs', compact('faqs'));
    }

    public function blogs()
    {
        $blogs = $this->blogService->getAll();
        return view('admin.pages.blogs', compact('blogs'));
    }

    public function messages()
    {
        $messages = $this->messageService->getAll();
        return view('admin.pages.messages', compact('messages'));
    }

    public function gallery()
    {
        $gallery = $this->galleryService->getAll();
        return view('admin.pages.gallery', compact('gallery'));
    }

    public function seo()
    {
        $seoSettings = $this->settingService->get('seoSettings');
        return view('admin.pages.seo', compact('seoSettings'));
    }

    public function homeManager()
    {
        $homeSettings = $this->settingService->get('homeSettings');
        return view('admin.pages.home_manager', compact('homeSettings'));
    }

    public function contactSettings()
    {
        $contactSettings = $this->settingService->get('contactSettings');
        return view('admin.pages.contact_settings', compact('contactSettings'));
    }

    public function users()
    {
        $users = \App\Models\User::all();
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.pages.users', compact('users', 'roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'role' => 'required|string|exists:roles,name',
            'permissions' => 'nullable|array'
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@rounq.com',
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        // If subadmin and has specific permissions
        if ($request->role === 'SubAdmin' && $request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        return response()->json(['success' => true]);
    }

    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        if ($user->id == Auth::id()) {
            return response()->json(['success' => false, 'message' => 'لا يمكنك حذف نفسك!'], 400);
        }
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function analytics()
    {
        $waClicks = \App\Models\Setting::where('key', 'wa_clicks')->first()->value ?? 0;
        $phoneClicks = \App\Models\Setting::where('key', 'phone_clicks')->first()->value ?? 0;
        $bookingsCount = \App\Models\Booking::count();

        return view('admin.pages.analytics', compact('waClicks', 'phoneClicks', 'bookingsCount'));
    }

    public function changePassword()
    {
        return view('admin.pages.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'كلمة المرور الحالية مطلوبة',
            'new_password.required' => 'كلمة المرور الجديدة مطلوبة',
            'new_password.min' => 'يجب أن تكون كلمة المرور 6 أحرف على الأقل',
            'new_password.confirmed' => 'تأكيد كلمة المرور غير متطابق',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح ✅');
    }

    public function storeService(ServiceRequest $request)
    {
        return response()->json($this->serviceService->create($request->validated()));
    }

    public function updateService(ServiceRequest $request, $id)
    {
        return response()->json($this->serviceService->update($id, $request->validated()));
    }

    public function deleteService($id)
    {
        $this->serviceService->delete($id);
        return response()->json(['success' => true]);
    }

    // Bookings
    public function getBookings()
    {
        return response()->json($this->bookingService->getAll());
    }

    public function updateBookingStatus(Request $request, $id)
    {
        return response()->json($this->bookingService->updateStatus($id, $request->status));
    }

    public function deleteBooking($id)
    {
        $this->bookingService->delete($id);
        return response()->json(['success' => true]);
    }

    // Offers
    public function getOffers()
    {
        return response()->json($this->offerService->getAll());
    }

    public function storeOffer(OfferRequest $request)
    {
        return response()->json($this->offerService->create($request->validated()));
    }

    public function updateOffer(OfferRequest $request, $id)
    {
        return response()->json($this->offerService->update($id, $request->validated()));
    }

    public function deleteOffer($id)
    {
        $this->offerService->delete($id);
        return response()->json(['success' => true]);
    }

    // Testimonials
    public function getTestimonials()
    {
        return response()->json($this->testimonialService->getAll());
    }

    public function storeTestimonial(TestimonialRequest $request)
    {
        return response()->json($this->testimonialService->create($request->validated()));
    }

    public function updateTestimonial(TestimonialRequest $request, $id)
    {
        return response()->json($this->testimonialService->update($id, $request->validated()));
    }

    public function deleteTestimonial($id)
    {
        $this->testimonialService->delete($id);
        return response()->json(['success' => true]);
    }

    // FAQs
    public function getFaqs()
    {
        return response()->json($this->faqService->getAll());
    }

    public function storeFaq(FaqRequest $request)
    {
        return response()->json($this->faqService->create($request->validated()));
    }

    public function updateFaq(FaqRequest $request, $id)
    {
        return response()->json($this->faqService->update($id, $request->validated()));
    }

    public function deleteFaq($id)
    {
        $this->faqService->delete($id);
        return response()->json(['success' => true]);
    }

    // Blogs
    public function getBlogs()
    {
        return response()->json($this->blogService->getAll());
    }

    public function storeBlog(BlogRequest $request)
    {
        return response()->json($this->blogService->create($request->validated()));
    }

    public function updateBlog(BlogRequest $request, $id)
    {
        return response()->json($this->blogService->update($id, $request->validated()));
    }

    public function deleteBlog($id)
    {
        $this->blogService->delete($id);
        return response()->json(['success' => true]);
    }

    // Messages
    public function getMessages()
    {
        return response()->json($this->messageService->getAll());
    }

    public function markMessageReplied($id)
    {
        return response()->json($this->messageService->markAsReplied($id));
    }

    public function deleteMessage($id)
    {
        $this->messageService->delete($id);
        return response()->json(['success' => true]);
    }

    public function updateHomeSettings(Request $request)
    {
        $data = $request->all();
        if ($request->has('settings_json')) {
            $json = $request->settings_json;
            if (is_array($json)) {
                $data = $json;
            } else {
                $decoded = json_decode($json, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data = $decoded;
                } else {
                    return response()->json(['success' => false, 'error' => 'Invalid JSON data'], 422);
                }
            }
        }
        
        $this->settingService->updateHomeSettings($data);
        return response()->json(['success' => true]);
    }
    
    public function updateContactSettings(Request $request)
    {
        $data = $request->all();
        if ($request->has('settings_json')) {
            $json = $request->settings_json;
            $data = is_array($json) ? $json : json_decode($json, true);
        }
        $this->settingService->updateContactSettings($data);
        return response()->json(['success' => true]);
    }

    public function updateSeoSettings(Request $request)
    {
        $data = $request->all();
        if ($request->has('settings_json')) {
            $json = $request->settings_json;
            $data = is_array($json) ? $json : json_decode($json, true);
        }
        $this->settingService->set('seoSettings', $data);
        return response()->json(['success' => true]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);
            return response()->json(['url' => '/uploads/'.$imageName]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    // Gallery
    public function getGallery()
    {
        return response()->json($this->galleryService->getAll());
    }

    public function storeGallery(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'url' => 'nullable|string',
            'icon' => 'nullable|string',
            'category' => 'nullable|string',
            'is_active' => 'boolean'
        ]);
        return response()->json($this->galleryService->create($data));
    }

    public function deleteGallery($id)
    {
        $this->galleryService->delete($id);
        return response()->json(['success' => true]);
    }
}
