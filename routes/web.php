<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Product;
use App\Models\Pesanan;
use App\Models\Petugas;
use App\Models\Chat;

use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('login'))->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    return back()->withErrors(['email' => 'Email atau password salah']);

})->name('login.post');


Route::get('/register', fn() => view('register'))->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', 'Akun berhasil dibuat');

})->name('register.post');


/*
|--------------------------------------------------------------------------
| USER (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // =====================
    // CHAT USER
    // =====================

    Route::get('/chat', function () {

        $chats = Chat::where('user_id', Auth::id())->get();

        return view('chat', compact('chats'));

    })->name('chat.user');

    Route::post('/chat/send', function (Request $request) {

        Chat::create([
            'user_id' => Auth::id(),
            'petugas_id' => 1,
            'message' => $request->message,
            'sender' => 'user'
        ]);

        return back();

    })->name('chat.send');

    // =====================
// HOME & SEARCH
// =====================

Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/search-live', [ProductController::class, 'searchLive'])->name('search.live');

    // LOGOUT
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/login');
    })->name('logout');

}); // ✅ PENUTUP middleware hanya SEKALI di sini

// =====================
// FAVORITE (AMAN)
// =====================
Route::post('/favorite/{id}', function($id){

    $userId = Auth::id();

    if(!$userId){
        return back();
    }

    $existing = \App\Models\Favorite::where('user_id',$userId)
        ->where('product_id',$id)
        ->first();

    if($existing){
        $existing->delete();
    } else {
        \App\Models\Favorite::create([
            'user_id' => $userId,
            'product_id' => $id
        ]);
    }

    return back();

})->name('favorite.toggle')->middleware('auth');

    // DETAIL PRODUK
    Route::get('/product/{id}', function ($id) {
        $product = Product::find($id);
        if (!$product) return redirect()->route('home');
        return view('product', compact('product'));
    })->name('product.detail');

// HALAMAN FAVORIT
Route::get('/favorit', function(){

    $favorites = \App\Models\Favorite::where('user_id',Auth::id())
        ->with('product')
        ->get();

    return view('favorit', compact('favorites'));

})->middleware('auth')->name('favorit');

    // KERANJANG
    Route::get('/keranjang', function () {
        $cart = session()->get('cart', []);
        return view('keranjang', compact('cart'));
    })->name('keranjang');

    Route::post('/tambah-ke-keranjang', function (Request $request) {

        if (!$request->size) {
            return back()->with('error', 'Pilih ukuran dulu!');
        }

        $cart = session()->get('cart', []);
        $product = Product::find($request->id);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['qty']++;
        } else {
            $cart[$request->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "size" => $request->size,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('keranjang');

    })->name('keranjang.tambah');

    Route::get('/hapus-keranjang/{id}', function ($id) {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back();
    });

    // 🔥 PEMBAYARAN (FIXED)
    Route::get('/pembayaran/{id}', function ($id) {

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $item = $cart[$id];
    } else {

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home');
        }

        if (!request('size')) {
            return back()->with('error','Pilih ukuran dulu!');
        }

        $item = [
            "name" => $product->name,
            "price" => $product->price,
            "image" => $product->image,
            "size" => request('size')
        ];
    }

    return view('pembayaran', compact('item', 'id'));

})->name('pembayaran');

    Route::post('/proses-pembayaran/{id}', [PembayaranController::class, 'prosesPembayaran'])
->name('pembayaran.proses');

        Route::post('/upload-bukti/{id}', function (Request $request, $id) {

    $file = $request->file('bukti');

    if (!$file) {
        return back()->with('error', 'Upload bukti dulu!');
    }

    $namaFile = time().'.'.$file->getClientOriginalExtension();
    $file->move(public_path('bukti'), $namaFile);

    $pesanan = \App\Models\Pesanan::find($id);

    // 🔥 TAMBAHAN PENTING
    if (!$pesanan) {
        return back()->with('error', 'Pesanan tidak ditemukan!');
    }

    $pesanan->bukti = $namaFile;
    $pesanan->save();

    return redirect('/pesanan')->with('success','Bukti berhasil dikirim');
});

    // PESANAN USER
    Route::get('/pesanan', function () {
    $pesanans = Pesanan::where('nama_pembeli', Auth::user()->name)
        ->latest()
        ->get();

    return view('pesanan', compact('pesanans'));
});

Route::get('/detail/{id}', function($id){
    $pesanan = \App\Models\Pesanan::findOrFail($id);
    return view('detail', compact('pesanan'));
})->name('detail.pesanan');

Route::post('/pesanan/selesai/{id}', function($id){

    $pesanan = \App\Models\Pesanan::find($id);

    if(!$pesanan){
        return back();
    }

    $pesanan->status = 'selesai';
    $pesanan->save();

    return back()->with('success','Pesanan selesai dikonfirmasi');

})->middleware('auth');

    // PENGATURAN AKUN
    Route::get('/pengaturan', function () {
        return view('pengaturan');
    })->name('pengaturan');

    // PENGATURAN AKUN
Route::post('/pengaturan/update', function(Request $request){

    $request->validate([
        'name' => 'required',
        'alamat' => 'required',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $user = Auth::user();

    $user->name = $request->name;
    $user->alamat = $request->alamat;

    // =========================
    // HAPUS FOTO (AMAN)
    // =========================
    if($request->hapus_foto){
        if($user->photo && file_exists(public_path('profile/'.$user->photo))){
            unlink(public_path('profile/'.$user->photo));
        }
        $user->photo = null;
    }

    // =========================
    // UPLOAD FOTO BARU
    // =========================
    if ($request->hasFile('photo')) {

        // hapus foto lama
        if($user->photo && file_exists(public_path('profile/'.$user->photo))){
            unlink(public_path('profile/'.$user->photo));
        }

        $file = $request->file('photo');

        $namaFile = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('profile'), $namaFile);

        $user->photo = $namaFile;
    }

    // =========================
    // CROPPED BASE64 (OPSIONAL)
    // =========================
    if($request->photo_cropped){

        // hapus lama
        if($user->photo && file_exists(public_path('profile/'.$user->photo))){
            unlink(public_path('profile/'.$user->photo));
        }

        $image = str_replace('data:image/jpeg;base64,', '', $request->photo_cropped);
        $image = str_replace(' ', '+', $image);

        $imageName = time().'.jpg';

        file_put_contents(public_path('profile/'.$imageName), base64_decode($image));

        $user->photo = $imageName;
    }

    $user->save();

    return redirect()->route('home')->with('success','Profil berhasil diupdate');

})->name('akun.update');

// LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/login');
})->name('logout');

function cekAdmin() {
    if (!session('admin')) {
        return redirect('/admin/login')->send();
    }
}

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', fn() => view('admin.login'));

Route::post('/admin/login', function (Request $request) {

    if ($request->email == 'admin@gmail.com' && $request->password == 'admin123') {

        $request->session()->regenerate(); // ✅ BENAR

        $request->session()->put('admin', true);

        return redirect('/admin');
    }

    return back()->with('error', 'Login admin gagal');
});

Route::prefix('admin')->group(function () {

    // DASHBOARD
    Route::get('/', function () {
        cekAdmin();
        return view('admin.dashboard');
    });

    // =====================
    // PRODUK
    // =====================

    Route::get('/produk', function () {
        cekAdmin();
        $products = Product::all();
        return view('admin.product', compact('products'));
    })->name('admin.product');

    Route::get('/produk/edit/{id}', function ($id) {
        cekAdmin();
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    })->name('admin.product.edit');

    Route::post('/produk/update/{id}', function (Request $request, $id) {
        cekAdmin();

        $product = Product::findOrFail($id);

        $harga = str_replace(['Rp', '.', ' '], '', $request->price);

        $product->name = $request->name;
        $product->price = $harga;

        // upload gambar baru (opsional)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $namaFile = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $namaFile);

            $product->image = $namaFile;
        }

        $product->save();

        return redirect('/admin/produk')->with('success','Produk berhasil diupdate');
    })->name('admin.product.update');

    Route::delete('/produk/hapus/{id}', function ($id) {
        cekAdmin();

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/produk')->with('success','Produk berhasil dihapus');
    })->name('admin.product.delete');

    Route::post('/produk/tambah', function (Request $request) {

        cekAdmin();

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image'
        ]);

        $file = $request->file('image');
        $namaFile = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images'), $namaFile);

        $harga = str_replace(['Rp', '.', ' '], '', $request->price);

        Product::create([
            'name' => $request->name,
            'price' => $harga,
            'image' => $namaFile
        ]);

        return redirect('/admin/produk')->with('success','Produk berhasil ditambahkan');

    })->name('admin.product.tambah');

    // =====================
    // USER
    // =====================

    Route::get('/user', function () {
        cekAdmin();
        $users = User::all();
        return view('admin.user', compact('users'));
    })->name('admin.user');

    Route::get('/user/hapus/{id}', function ($id) {

    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/admin/user')->with('success','User berhasil dihapus');

})->name('admin.user.delete');

    // =====================
    // PETUGAS
    // =====================

    Route::get('/petugas', function () {
    cekAdmin();
    return app(PetugasController::class)->index();
})->name('admin.petugas');

Route::post('/petugas/store', function (Request $request) {
    cekAdmin();
    return app(PetugasController::class)->store($request);
});

Route::get('/petugas/delete/{id}', function ($id) {
    cekAdmin();
    return app(PetugasController::class)->delete($id);
});

    // =====================
    // TRANSAKSI
    // =====================

    Route::get('/transaksi', function () {
    cekAdmin();

    $pesanans = \App\Models\Pesanan::whereNotNull('bukti')->get();

    return view('admin.transaksi', compact('pesanans'));
})->name('admin.transaksi');

    // =====================
    // PESANAN
    // =====================

    Route::get('/pesanan', function () {
    cekAdmin();

    $pesanans = \App\Models\Pesanan::all();

    return view('admin.pesanan', compact('pesanans'));
})->name('admin.pesanan');

// =====================
// PENGIRIMAN
// =====================

Route::get('/pengiriman', function () {
    cekAdmin();
    $pesanans = Pesanan::all();
    return view('admin.pengiriman', compact('pesanans'));
})->name('admin.pengiriman');

}); // ✅ PENUTUP ADMIN GROUP

/*
|-------------------------------------------------------------------------- 
| PETUGAS
|-------------------------------------------------------------------------- 
*/

Route::get('/petugas/login', function (Request $request) {

    // 🔥 reset token biar gak warisan dari session lama
    $request->session()->regenerateToken();

    return view('petugas.login');

});

Route::post('/petugas/login', function (Request $request) {

    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $petugas = Petugas::where('email', trim($request->email))->first();

    if ($petugas && $request->password == $petugas->password) {

        // 🔥 URUTAN BENAR
        $request->session()->regenerate();
        $request->session()->forget('admin');
        session(['petugas' => $petugas->id]);

        return redirect('/petugas/dashboard');
    }

    return back()->with('error', 'Login petugas gagal');

})->name('petugas.login.post');

function cekPetugas() {
    if (!session()->has('petugas')) {
        return redirect('/petugas/login')->send();
    }
}

// DASHBOARD
Route::get('/petugas/dashboard', function () {
    cekPetugas();
    return view('petugas.dashboard');
});

// DATA PESANAN
Route::get('/petugas/pesanan', function () {
    cekPetugas();
    $pesanans = Pesanan::all();
    return view('petugas.pesanan', compact('pesanans'));
});

// PENGIRIMAN
Route::get('/petugas/pengiriman', function () {
    cekPetugas();
    $pesanans = Pesanan::all();
    return view('petugas.pengiriman', compact('pesanans'));
});

// UPDATE STATUS

Route::post('/petugas/pengiriman/update/{id}', function (Request $request, $id) {

    cekPetugas(); // 🔥 penting biar session dicek

    $pesanan = \App\Models\Pesanan::find($id);

    if (!$pesanan) {
        return redirect('/petugas/pesanan');
    }

    $pesanan->status = $request->status; // 🔥 pakai request
    $pesanan->save();

    return redirect('/petugas/pengiriman')
        ->with('success','Status berhasil diupdate');

})->name('petugas.pengiriman.update');

Route::get('/petugas/pesanan/{id}', function ($id) {
    cekPetugas();

    $pesanan = \App\Models\Pesanan::find($id);

    if (!$pesanan) {
        return redirect('/petugas/pesanan');
    }

    return view('petugas.detail', compact('pesanan'));
});

// =====================
// CHAT PETUGAS
// =====================

Route::get('/petugas/chat', function () {

    cekPetugas();

    $users = User::whereIn('id', function($q){
        $q->select('user_id')->from('chats')->distinct();
    })->get();

    return view('petugas.chat', compact('users'));

});

Route::post('/petugas/chat/send', function (Request $request) {

    cekPetugas();

    Chat::create([
        'user_id' => $request->user_id,
        'petugas_id' => session('petugas'),
        'message' => $request->message,
        'sender' => 'petugas'
    ]);

    return back();

});

Route::get('/petugas/chat/{user_id}', function ($user_id) {

    cekPetugas();

    $chats = Chat::where('user_id', $user_id)->get();
    $user = User::find($user_id);

    return view('petugas.chat_detail', compact('chats','user'));
});

Route::get('/petugas/transaksi', function () {
    cekPetugas();

    $pesanans = \App\Models\Pesanan::whereNotNull('bukti')->get();

    return view('petugas.transaksi', compact('pesanans'));
});