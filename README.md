# GameStore - Laravel E-commerce

Aplikasi toko online untuk penjualan game dan produk digital berbasis Laravel 11 dengan Tailwind CSS.

## 📋 Fitur Utama

- **Dashboard Admin** - Kelola produk, game, banner, testimonial
- **Manajemen Game** - CRUD lengkap dengan upload thumbnail & banner
- **Manajemen Produk** - Produk dengan kategori dan harga
- **Banner Management** - Slider banner untuk homepage
- **Testimonial** - Review dan rating pelanggan
- **Settings** - Konfigurasi website dan social media
- **Order Tracking** - Pelacakan pesanan dan statistik penjualan

## 🚀 Teknologi

- **Laravel 11** - Framework PHP
- **Tailwind CSS** - Styling framework
- **SQLite** - Database (bisa diganti MySQL/PostgreSQL)
- **Laravel Breeze** - Authentication scaffolding

## 📁 Struktur Proyek

```
app/
├── Http/Controllers/
│   ├── AdminController.php          # Dashboard utama
│   └── Admin/
│       ├── GameController.php       # Manajemen games
│       ├── ProductController.php    # Manajemen produk
│       ├── BannerController.php     # Manajemen banner
│       ├── TestimonialController.php# Manajemen testimonial
│       └── SettingController.php    # Pengaturan website
├── Models/
│   ├── Game.php                     # Model game
│   ├── Product.php                  # Model produk
│   ├── Category.php                 # Model kategori
│   ├── Banner.php                   # Model banner
│   ├── Testimonial.php              # Model testimonial
│   ├── Order.php                    # Model pesanan
│   ├── OrderItem.php                # Model item pesanan
│   └── Setting.php                  # Model pengaturan
└── Services/
    ├── FileUploadService.php        # Service upload file
    └── SettingService.php           # Service cache settings
```

## 🔧 Optimasi yang Telah Dilakukan

### ✅ Keamanan Model
- Mengganti `$guarded = []` dengan `$fillable` properties yang spesifik
- Menambahkan type casting untuk field yang sesuai
- Relationship dengan return type hints

### ✅ Optimasi Database
- Index pada field yang sering di-query (`slug`, `status`, dll)
- Eager loading untuk mencegah N+1 query problem
- Scope methods untuk query yang sering dipakai

### ✅ Refactoring Controller
- Memecah `AdminController` besar menjadi controller yang lebih fokus
- Setiap controller menghandle satu resource saja (Single Responsibility)
- Service classes untuk logic yang bisa dipakai berulang

### ✅ Cache Management
- Cache untuk settings website
- Service untuk mengelola cache dengan TTL
- Auto-clear cache saat data berubah

### ✅ File Upload Optimization
- Centralized file upload service
- Proper file naming convention
- Automatic old file cleanup

## 🔄 Migration dan Seeding

```bash
# Jalankan migration
php artisan migrate

# Jalankan migration dengan index optimization
php artisan migrate --path=database/migrations/2026_07_16_000001_add_database_indexes.php
```

## 🎯 Performance Tips

1. **Query Optimization**
   ```php
   // ❌ N+1 Problem
   $products = Product::all();
   foreach($products as $product) {
       echo $product->game->name; // N+1 query
   }
   
   // ✅ Eager Loading
   $products = Product::with(['game', 'category'])->get();
   ```

2. **Cache Usage**
   ```php
   // ❌ Query database setiap request
   $setting = Setting::first();
   
   // ✅ Use cached settings
   $setting = app(SettingService::class)->getFirstCached();
   ```

3. **Scope Methods**
   ```php
   // ❌ Raw where queries
   Product::where('status', true)->get();
   
   // ✅ Use scopes
   Product::active()->get();
   ```

## 📝 TODO Next Steps

- [ ] Implement proper image optimization (intervention/image)
- [ ] Add API endpoints untuk mobile app
- [ ] Implement proper logging dan monitoring
- [ ] Add automated testing (PHPUnit)
- [ ] Setup CI/CD pipeline
- [ ] Add search functionality dengan full-text search
- [ ] Implement proper backup strategy

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Commit changes dengan pesan yang jelas
4. Push ke branch
5. Create Pull Request

## 📄 License

Proyek ini menggunakan lisensi MIT. Lihat file LICENSE untuk detail lengkap.
