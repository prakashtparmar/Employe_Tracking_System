<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


Step To Run This WebSite

#composer create-project --prefer-dist laravel/laravel ECommerce
#composer require intervention/image-laravel
#composer update
#php artisan migrate
#php artisan db:seed
#php artisan vendor:publish --provider="Intervention\Image\Laravel\ServiceProvider"
#enable extension=gd in XAMP
#XAMP->Config->php.in

php artisan make:controller Admin/ProductController --resource
php artisan make:model Product -m
php artisan tinker
-------------------------
$product = new App\Models\Product;
$product->category_id = 4;
$product->brand_id = 0;
$product->admin_id = 1;
$product->admin_type = 'admin';
$product->product_name = 'Green Casual Shirt';
$product->product_code = 'GCS001';
$product->product_color = 'Green';
$product->family_color = 'Green';
$product->group_code = 'GRP001';
$product->product_price = 1000;
$product->product_discount = 20;
$product->product_discount_amount = 200;
$product->discount_applied_on = 'product';
$product->product_gst = 0;
$product->final_price = 800;
$product->main_image = "";
$product->product_weight = 400;
$product->product_video = "";
$product->description = 'This is a stylish blue casual shirt for men.';
$product->wash_care = 'Machine wash cold.';
$product->search_keywords = 'blue shirt, casual wear, men shirt';
$product->fabric = 'Cotton';
$product->pattern = 'Solid';
$product->sleeve = 'Full Sleeve';
$product->fit = 'Regular Fit';
$product->occasion = 'Casual';
$product->stock = 50;
$product->sort = 1;
$product->meta_title = 'Green Casual Shirt';
$product->meta_description = 'Buy Green Casual Shirt for Men Online.';
$product->meta_keywords = 'Green, casual, men, shirt';
$product->is_featured = 'Yes';
$product->status = 1;
$product->save();





-------------------------------------

          <div class="mb-3">
              <label for="category_name">Category Level*</label>
              <select name="parent_id" class="form-control">
                  <option value="">Select</option>
                  <option value="" @if($category->parent_id == null) selected @endif>Main Category</option>
                 {{--  @foreach($getCategories as $cat)
                      <option value="{{ $cat['id'] }}" @if(isset($category['parent_id']) && $category['parent_id'] == $cat['id']) selected @endif>
                          {{ $cat['name'] }}
                      </option>
                      @if(!empty($cat['subcategories']))
                          @foreach($cat['subcategories'] as $subcat)
                              <option value="{{ $subcat['id'] }}" @if(isset($category['parent_id']) && $category['parent_id'] == $subcat['id']) selected @endif>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo; {{ $subcat['name'] }}
                              </option>
                              @if(!empty($subcat['subcategories']))
                                  @foreach($subcat['subcategories'] as $subsubcat)
                                      <option value="{{ $subsubcat['id'] }}"
                                          @if(isset($category['parent_id']) && $category['parent_id'] == $subsubcat['id']) selected @endif>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo;{{ $subsubcat['name'] }}
                                      </option>
                                  @endforeach
                              @endif
                          @endforeach
                      @endif
                  @endforeach --}}
              </select>
          </div>
