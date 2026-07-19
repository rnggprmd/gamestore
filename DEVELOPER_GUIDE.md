# 👨‍💻 Developer Guide - GameStore Admin Panel

**Quick Reference for Development & Maintenance**

---

## 🚀 Quick Start

### Setup Development Environment
```bash
# Clone repository
git clone [repo-url]
cd gamestore

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed (optional)

# Build assets
npm run dev

# Start development server
php artisan serve
```

### Access Admin Panel
- **URL:** `http://localhost:8000/admin`
- **Email:** `admin@example.com`
- **Password:** `password`

---

## 📁 Project Structure

```
gamestore/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin controllers
│   │   │   │   ├── GameController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CategoryController.php ✨ NEW
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── BannerController.php
│   │   │   │   ├── TestimonialController.php
│   │   │   │   └── SettingController.php
│   │   │   └── LandingController.php
│   │   └── Requests/            # Form requests
│   ├── Models/
│   │   ├── Game.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── ...
│   └── Services/                # Business logic
│       ├── GameService.php
│       ├── FileUploadService.php
│       └── SettingService.php
│
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── layout.blade.php     # Admin layout
│   │   │   ├── dashboard.blade.php
│   │   │   ├── games/
│   │   │   ├── products/
│   │   │   ├── categories/ ✨ NEW
│   │   │   ├── orders/ ✨ UPDATED
│   │   │   └── ...
│   │   └── landing/                 # Public pages
│   └── css/
│       └── app.css                  # Tailwind + Watt theme
│
├── routes/
│   └── web.php                      # All routes
│
├── database/
│   ├── migrations/
│   │   ├── ...
│   │   └── 2026_07_19_074603_add_slug_column_to_categories_table.php ✨ NEW
│   └── factories/
│
└── public/
    └── img/                         # Uploaded images
```

---

## 🎨 Design System

### Watt Dark Theme

#### Colors
```css
--color-watt-bg: #09090b           /* Main background */
--color-watt-surface: #121214       /* Card/surface */
--color-watt-cyan: #00e5ff          /* Primary */
--color-watt-red: #ff453a           /* Danger */
--color-watt-green: #32d74b         /* Success */
--color-watt-border: #1f1f23        /* Border */
--color-watt-text-sec: #a1a1aa      /* Secondary text */
--color-watt-hover: #1e1e24         /* Hover state */
```

#### Components
```html
<!-- Card -->
<div class="admin-form-card p-5">
  <!-- Content -->
</div>

<!-- Input -->
<input type="text" class="admin-field">

<!-- Label -->
<label class="admin-field-label">Label</label>

<!-- Button Primary -->
<button class="admin-button-primary">Submit</button>

<!-- Button Secondary -->
<button class="admin-button-secondary">Cancel</button>

<!-- Table -->
<table class="admin-table">
  <thead>
    <tr class="admin-table-head">
      <th>Column</th>
    </tr>
  </thead>
  <tbody class="divide-y divide-watt-border">
    <tr class="admin-table-row">
      <td>Data</td>
    </tr>
  </tbody>
</table>

<!-- Modal -->
<div class="fixed inset-0 z-50 hidden">
  <div class="admin-modal-content">
    <div class="admin-modal-header"></div>
    <div class="admin-modal-body"></div>
    <div class="admin-modal-footer"></div>
  </div>
</div>

<!-- Status Badge -->
<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-watt-green/10 text-watt-green border border-watt-green/20 text-[10px] font-bold">
  <span class="w-1.5 h-1.5 rounded-full bg-watt-green animate-pulse"></span>
  Aktif
</span>
```

### Icons (Lucide)
```html
<!-- All using Lucide icons -->
<i data-lucide="plus"></i>
<i data-lucide="edit-3"></i>
<i data-lucide="trash-2"></i>
<i data-lucide="eye"></i>
<i data-lucide="search"></i>
<i data-lucide="download"></i>
```

---

## 🔄 Common Development Tasks

### Add New Admin Module

#### 1. Create Controller
```bash
php artisan make:controller Admin/ModuleController --resource
```

#### 2. Create Model
```bash
php artisan make:model Module --migration --resource
```

#### 3. Create Views
```
resources/views/admin/modules/
├── index.blade.php      # List
├── create.blade.php     # Create (optional if using modal)
└── edit.blade.php       # Edit (optional if using modal)
```

#### 4. Add Route
```php
Route::resource('modules', ModuleController::class);
```

#### 5. Use Template
```blade
@extends('admin.layout')

@section('page_title', 'Module Title')

@section('content')
<div class="space-y-6">
  <div class="admin-form-card p-5 space-y-4">
    <!-- Content -->
  </div>
</div>
@endsection
```

### Add Filter to Existing Module
```php
// In Controller index method
if ($request->filled('search')) {
    $query->where('name', 'LIKE', "%{$request->search}%");
}

if ($request->filled('status')) {
    $query->where('status', $request->status);
}

$items = $query->paginate(15);
```

### Add Modal Form
```blade
<!-- Modal -->
<div id="modal-create-item" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeModal('modal-create-item')"></div>
  <div class="admin-modal-content">
    <div class="admin-modal-header">
      <h3 class="text-base font-semibold text-white">Add Item</h3>
      <button onclick="closeModal('modal-create-item')" class="p-1.5 rounded-lg hover:bg-watt-hover">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </div>
    <form action="{{ route('admin.items.store') }}" method="POST" class="flex flex-col flex-1 min-h-0">
      @csrf
      <div class="admin-modal-body">
        <!-- Form fields -->
      </div>
      <div class="admin-modal-footer">
        <button type="button" onclick="closeModal('modal-create-item')" class="admin-button-secondary">Cancel</button>
        <button type="submit" class="admin-button-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(id) {
  document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
  document.getElementById(id).classList.add('hidden');
}
</script>
```

### Add File Upload
```blade
<div class="space-y-1.5">
  <label class="admin-field-label">Image Upload</label>
  <input type="file" name="image" accept="image/*" class="admin-field">
</div>
```

```php
// In Controller
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('img'), $filename);
    $validated['image'] = $filename;
}
```

### Add Search with Auto-Submit
```blade
<input type="text" name="search" value="{{ request('search') }}" 
    placeholder="Search..." class="admin-field"
    onkeyup="autoSubmitForm(this)">

<script>
let searchTimeout;
function autoSubmitForm(button) {
    clearTimeout(searchTimeout);
    const form = button.closest('form') || button.closest('.search-filter-form');
    searchTimeout = setTimeout(() => {
        form.submit();
    }, 500);
}
</script>
```

---

## 🐛 Debugging Tips

### Enable Debug Mode
```env
APP_DEBUG=true
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
grep -i error storage/logs/laravel.log
```

### Database Debugging
```php
// In code
\DB::enableQueryLog();
// ... code ...
\Log::info(\DB::getQueryLog());
```

### Tinker Console
```bash
php artisan tinker

# Test model
> User::count()
> Product::find(1)
> Product::where('status', 1)->get()
> Auth::attempt(['email' => 'admin@example.com', 'password' => 'password'])
```

### SQL Debugging
```bash
# Show queries in log
QUERY_LOG=true

# Check with sqlite
sqlite3 database/database.sqlite
> SELECT * FROM products;
```

---

## 🧪 Testing

### Run Tests
```bash
php artisan test
php artisan test --filter=GameControllerTest
```

### Create Test
```bash
php artisan make:test GameControllerTest
```

### Test Database
```php
use Tests\TestCase;

class GameControllerTest extends TestCase {
    public function test_can_list_games() {
        $response = $this->get('/admin/games');
        $response->assertStatus(200);
    }
}
```

---

## 📊 Database Queries

### Common Queries

#### List with Relationships
```php
$products = Product::with(['game', 'category'])->paginate(15);
```

#### Count Related
```php
$categories = Category::withCount('products')->get();
```

#### Search
```php
$products = Product::where('name', 'LIKE', "%{$search}%")
                   ->orWhere('description', 'LIKE', "%{$search}%")
                   ->paginate(15);
```

#### Filter
```php
$products = Product::when($status, fn($q) => $q->where('status', $status))
                   ->when($game_id, fn($q) => $q->where('game_id', $game_id))
                   ->paginate(15);
```

#### Cascade Delete
```php
DB::transaction(function () use ($id) {
    $game = Game::find($id);
    $game->products()->delete();
    $game->delete();
});
```

---

## 🚀 Performance Optimization

### Query Optimization
```php
// ❌ Bad - N+1 query
$products = Product::all();
foreach ($products as $product) {
    echo $product->game->name;
}

// ✅ Good - Use eager loading
$products = Product::with('game')->get();
foreach ($products as $product) {
    echo $product->game->name;
}
```

### Cache Usage
```php
// Cache query results
$products = Cache::remember('products_list', 3600, function () {
    return Product::with(['game', 'category'])->paginate(15);
});

// Invalidate when updating
Cache::forget('products_list');
```

### Database Indexes
```php
// Migration
Schema::table('products', function (Blueprint $table) {
    $table->index('game_id');
    $table->index('category_id');
    $table->fullText('name');
});
```

---

## 🔐 Security Practices

### Input Validation
```php
// Always validate
$validated = $request->validate([
    'name' => 'required|string|max:255|unique:products',
    'price' => 'required|numeric|min:0',
    'image' => 'nullable|image|max:2048',
]);
```

### Prevent Mass Assignment
```php
// Model
protected $fillable = ['name', 'price', 'game_id'];
// Don't use $guarded = []
```

### Escape Output
```blade
<!-- ✅ Blade automatically escapes -->
{{ $product->name }}

<!-- ✅ Explicitly escape if needed -->
{!! htmlspecialchars($product->name) !!}
```

### CSRF Protection
```blade
<!-- Always include in forms -->
<form method="POST">
    @csrf
    <!-- fields -->
</form>
```

---

## 📝 Coding Standards

### File Organization
```
Controller: 
  - index(), create(), store()
  - show(), edit(), update()
  - destroy()

Model:
  - Relationships first
  - Scopes
  - Accessors/Mutators
  - Methods
```

### Naming Conventions
```
Tables: products, product_categories (plural)
Models: Product, ProductCategory (singular)
Controllers: ProductController
Methods: index, store, show, update, destroy
Routes: /admin/products
Variables: $product, $products (lowercase)
Classes: GameController, FileUploadService
```

### Code Style
```php
// Use type hints
public function store(Request $request): RedirectResponse

// Use arrow functions for simple callbacks
$items = collect($data)->map(fn($item) => $item['name']);

// Use named arguments
redirect()->route('admin.products.show', ['product' => $product->id])

// Group related imports
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
```

---

## 🔄 Git Workflow

### Branch Naming
```
feature/add-product-filter
bugfix/modal-validation-error
hotfix/database-connection-issue
```

### Commit Messages
```
feat: add product filter by status
fix: modal closes automatically after submit
refactor: improve query performance
docs: update admin panel guide
test: add validation tests for products
```

### Pull Request Checklist
- [ ] Branch is up to date with main
- [ ] Code follows style guide
- [ ] All tests pass
- [ ] No breaking changes
- [ ] Documentation updated

---

## 📚 Useful Commands

```bash
# Laravel
php artisan migrate              # Run migrations
php artisan migrate:rollback     # Rollback migrations
php artisan tinker              # Interactive shell
php artisan make:model Model    # Create model
php artisan make:controller Name # Create controller
php artisan route:list          # Show all routes
php artisan cache:clear         # Clear cache

# Composer
composer install                # Install dependencies
composer update                 # Update dependencies
composer require package/name   # Add package
composer remove package/name    # Remove package
composer audit                  # Check vulnerabilities

# NPM
npm install                     # Install dependencies
npm run dev                     # Dev build
npm run build                   # Production build
npm run watch                   # Watch for changes

# Git
git clone url                   # Clone repo
git checkout -b branch-name     # Create branch
git add .                       # Stage changes
git commit -m "message"         # Commit
git push origin branch-name     # Push
git pull                        # Pull changes
```

---

## 📞 When You're Stuck

### Resources
1. **Laravel Docs:** https://laravel.com/docs
2. **Tailwind Docs:** https://tailwindcss.com/docs
3. **Blade Docs:** https://laravel.com/docs/blade
4. **Stack Overflow:** Tag with `laravel`
5. **Laravel Forum:** https://laracasts.com

### Troubleshooting

**Problem:** Routes not found (404)
```bash
php artisan route:clear
php artisan route:cache
```

**Problem:** Class not found
```bash
composer dump-autoload
```

**Problem:** Permission denied on storage
```bash
chmod -R 777 storage bootstrap/cache
```

**Problem:** Database connection error
```bash
# Check .env credentials
php artisan config:show DB_HOST
# Test connection
php artisan tinker
> DB::connection()->getPdo()
```

**Problem:** Blank page (white screen of death)
```bash
# Check logs
tail -f storage/logs/laravel.log
# Enable debug
APP_DEBUG=true
```

---

## 🎯 Next Steps for Development

1. **Add More Validations:** Enhance input validation rules
2. **Add Tests:** Create unit & feature tests
3. **Add Notifications:** Email/SMS for order updates
4. **Add Reports:** Export functionality
5. **Add Audit Logs:** Track all changes
6. **Add Multi-language:** Internationalization
7. **Add User Roles:** Admin, Staff, Viewer roles
8. **Add API:** REST API for mobile app

---

## 📞 Getting Help

- **Team Chat:** Slack/Discord channel
- **Documentation:** Check docs folder
- **Issues:** GitHub issues
- **Code Review:** Create PR for feedback

---

**Last Updated:** 19 July 2026  
**Version:** 1.0.0  
**Maintained By:** Development Team

Happy Coding! 🚀
