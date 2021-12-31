<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductDetail;
use App\Mail\ResetPassword;
use App\Models\Admin\Attribute;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Customer;
use App\Models\Admin\Page;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentMethodSetting;
use App\Models\Admin\Product;
use App\Models\Admin\ProductDetail as AdminProductDetail;
use App\Models\Web\Order;
use App\Services\Web\HomeService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IndexController extends Controller
{

    public function getcall()
    {
        $url = "https://eu-test.oppwa.com/v1/payments";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=92.00" .
            "&currency=EUR" .
            "&paymentBrand=VISA" .
            "&paymentType=DB" .
            "&card.number=4200000000000000" .
            "&card.holder=Jane Jones" .
            "&card.expiryMonth=05" .
            "&card.expiryYear=2034" .
            "&card.cvv=123";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
    public function Index()
    {
        // return ini_get('memory_limit');
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('home', compact('data', 'setting'));
    }

    public function contactUs()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        return view('contactus', compact('data'));
    }

    public function aboutUs()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        return view('aboutus', compact('data'));
    }

    public function productDetail($product, $slug)
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        // dd($data);
        return view('product-detail', compact('data', 'product'));
    }

    public function searchProduct(Request $request){
        $products = DB::table('products AS t1')
        ->select('t1.id', 't2.title', 't1.product_slug', 't3.name as gallary_name', 't1.price', 't1.discount_price')
        ->join('product_detail AS t2', 't2.product_id', '=', 't1.id')
        ->join('gallary AS t3', 't3.id', '=', 't1.gallary_id')
        ->where('t2.title', 'like', '%' . $request->name . '%')
        ->where('t2.language_id', 1)->get();
        return response()->json($products);
    }
    

    public function shop()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $attribute = new Attribute;
        $languageId = $data['selectedLenguage'];
        $attribute = $attribute->getAttributeDetailByLanguageId($languageId);
        $attribute = $attribute->getVariationDetailByLanguageId($languageId);
        $attribute = $attribute->get();
        $brand = Brand::all();
        $data['attribute'] = $attribute;
        $data['price_range'] = ['0-500', '500-1000', '1000-2000'];
        $data['brand'] = $brand;
        return view('shop', compact('data'));
    }

    public function cartPage()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('cartpage', compact('data', 'setting'));
    }

    public function login()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('login', compact('data', 'setting'));
    }

    public function register()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('register', compact('data', 'setting'));
    }

    public function forgetPassword()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('forget-password', compact("data", "setting"));
    }

    public function postForgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", "email", "exists:customers"],
        ], [
            "email.exists" => "Email hasn't been registered",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            $customer = Customer::where("email", $request->email)->first();
            if ($customer != null) {

                $token = Str::random(40);
                $customerDetail = [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'token' => $token,
                ];
                $customer->update(["reset_token" => $token]);
                Mail::send('email.forgetPassword', ['token' => $token, "email" => $request->email], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Reset Password');
                });
                // Mail::to($request->email)->send(new ResetPassword($customerDetail));
                return response()->json(['msg' => 'Password reset link has been successfully sent to your email']);
            } else {
                return response()->json(['error_msg' => 'Your email doesn\'t exist in our database. Please register']);
            }
        }

    }

// Mail::to($request->email)->send(new ResetPassword($customerDetail));

    public function showResetPasswordForm($token)
    {
        if (Customer::where("reset_token", $token)->exists()) {
            $homeService = new HomeService;
            $data = $homeService->homeIndex();
            $setting = getSetting();
            $customer = Customer::where("reset_token", $token)->first();
            $email = $customer->email;
            // return view('resetLink', ['email' => $email, 'token' => $token], compact('data', 'setting'));
            return view('resetLink', ['email' => $email, 'token' => $token], compact('data', 'setting', 'email'));
        } else {
            return "<h2 style='color: red;'>The link has been expired or doesn't exist.</h2>";
        }

    }

    public function updateCustomerPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", "email", "exists:customers"],
            "password" => ["required", "min:6", "confirmed"],
            "password_confirmation" => ["required"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            $customer = Customer::where("email", $request->email)->first();
            if ($customer != null) {
                $customer->update(["password" => Hash::make($request->password), "reset_token" => null]);
                return response(["msg" => "Password Reset Successfully", "redirectRoute" => url('/login')]);
            } else {
                return response()->json(['error_msg' => "Something went wrong"]);
            }
        }
    }

    public function blogDetail($slug)
    {

        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();

        return view('blog.blog-detail', compact('data', 'setting', 'slug'));
    }

    public function blog()
    {

        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();

        return view('blog.blog', compact('data', 'setting'));
    }

    public function checkout()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        $payment_method_setting = PaymentMethodSetting::where('payment_method_id', '3')->get();
        $payment_method = PaymentMethod::whereIn('id', ['3', '4'])->where('status', '1')->get();
        // $payment_method_default = PaymentMethod::whereNotIn('id', ['3', '4'])->where('default', '1')->get();
        $payment_method_default = PaymentMethod::whereNotIn('id', ['1', '2', '3'])->where('status', '1')->get();
        return view('checkout', compact('data', 'setting', 'payment_method', 'payment_method_default', 'payment_method_setting'));
    }

    public function wishlist()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('wishlist', compact('data', 'setting'));
    }
    public function compare()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('compare', compact('data', 'setting'));
    }

    public function profile()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('profile', compact('data', 'setting'));
    }

    public function thankyou()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('thankyou', compact('data', 'setting'));
    }

    public function changePassword()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('change-password', compact('data', 'setting'));
    }

    public function shippingAddress()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('shipping-address', compact('data', 'setting'));
    }

    public function orders()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('orders', compact('data', 'setting'));
    }

    public function ordersDetail($id)
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('order-detail', compact('data', 'setting', 'id'));
    }

    public function term()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('term', compact('data', 'setting'));
    }

    public function refund()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('refund', compact('data', 'setting'));
    }

    public function privacy()
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();
        return view('privacy', compact('data', 'setting'));
    }

    public function page($slug)
    {
        $homeService = new HomeService;
        $data = $homeService->homeIndex();
        $setting = getSetting();

        $languageId = $data['selectedLenguage'];

        $page = new Page;
        $page = $page->getPageDetailByLanguageId($languageId);
        $page = $page->where('slug', $slug);
        $page = $page->first();

        // return $page;
        return view('page', compact('data', 'setting', 'page'));
    }

    public function orderStats()
    {

        $totalOrders = Order::all();
        $thisYearOrders = Order::whereYear('created_at', date('Y'))->get();
        $lastYearOrders = Order::whereYear('created_at', now()->subYear()->year)
            ->get();
        $thisWeekOrders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $totalProducts = Product::all();
        $thisYearProducts = Product::whereYear('created_at', date('Y'))->get();
        $lastYearProducts = Product::whereYear('created_at', now()->subYear()->year)
            ->get();
        $thisWeekProducts = Product::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $totalCustomers = Customer::all();
        $thisYearCustomers = Customer::whereYear('created_at', date('Y'))->get();
        $lastYearCustomers = Customer::whereYear('created_at', now()->subYear()->year)
            ->get();
        $thisWeekCustomer = Customer::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $totalSales = Order::where('order_status', 'Complete')->sum('order_price');
        $thisYearSales = Order::where('order_status', 'Complete')->whereYear('created_at', date('Y'))->sum('order_price');
        $lastYearSales = Order::where('order_status', 'Complete')->whereYear('created_at', now()->subYear()->year)
            ->sum('order_price');

        $thisWeekSales = Order::where('order_status', 'Complete')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('order_price');

        $customerMonthly = Customer::select(DB::raw('count(id) as `id`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('MONTHNAME(created_at) month'), DB::raw('MONTH(created_at) monthNumber'))
            ->groupby('month')
            ->whereYear('created_at', date('Y'))
            ->orderBy('monthNumber', 'ASC')
            ->get();

        $saleMonthly = Order::select(DB::raw('sum(order_price) as `amount`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('MONTHNAME(created_at) month'), DB::raw('MONTH(created_at) monthNumber'))
            ->where('order_status', 'Complete')
            ->groupby('month')
            ->whereYear('created_at', date('Y'))
            ->orderBy('monthNumber', 'ASC')
            ->get();

        return [
            'totalOrders' => count($totalOrders), 'thisYearOrders' => count($thisYearOrders), 'lastYearOrders' => count($lastYearOrders),
            'totalProducts' => count($totalProducts), 'thisYearProducts' => count($thisYearProducts), 'lastYearProducts' => count($lastYearProducts),
            'totalCustomers' => count($totalCustomers), 'thisYearCustomers' => count($thisYearCustomers), 'lastYearCustomers' => count($lastYearCustomers), 'lastYear' => now()->subYear()->year,

            'totalSales' => $totalSales, 'thisYearSales' => $thisYearSales, 'lastYearSales' => $lastYearSales,
            'thisWeekOrders' => $thisWeekOrders, 'thisWeekProducts' => $thisWeekProducts, 'thisWeekCustomer' => $thisWeekCustomer,
            'thisWeekSales' => $thisWeekSales, 'customerMonthly' => $customerMonthly, 'saleMonthly' => $saleMonthly,

        ];
    }

    /* public function query()
{
$vendorId = \Auth::user()->vendor_id;
return Earning::with('user', 'vendor')->when($this->type == "vendors", function ($query) {
return $query->whereNotNull('vendor_id')->when(\Auth::user()->hasAnyRole('city-admin'), function ($query) {
return $query->whereHas("vendor", function ($query) {
return $query->where('creator_id', Auth::id());
});
});
}, function ($query) use ($vendorId) {
return $query->whereNotNull('user_id')->when($vendorId, function ($query) use ($vendorId) {
return $query->whereHas("user", function ($q) use ($vendorId) {
return $q->where('vendor_id', $vendorId);
});
})->when(\Auth::user()->hasAnyRole('city-admin'), function ($query) {
return $query->whereHas("user", function ($query) {
return $query->where('creator_id', Auth::id());
});
});
})->where("amount",">", 0);
} */
}
