<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->integer('category_id');
        $table->integer('brand_id');
        $table->integer('admin_id');
        $table->string('admin_type');
        $table->string('product_name');
        $table->string('product_code');
        $table->string('product_color');
        $table->string('family_color');
        $table->string('group_code');
        $table->float('product_price');
        $table->float('product_discount');
        $table->float('product_discount_amount');
        $table->string('discount_applied_on')->nullable(); // Added nullable()
        $table->float('product_gst')->nullable();           // Added nullable()
        $table->float('final_price')->nullable();         // Added nullable()
        $table->string('main_image')->nullable();           // Added nullable()
        $table->float('product_weight')->nullable();        // Added nullable()
        $table->string('product_video')->nullable();        // Changed to product_video and added nullable()
        $table->text('description')->nullable();           // Added nullable()
        $table->text('wash_care')->nullable();             // Added nullable()
        $table->text('search_keywords')->nullable();        // Added nullable()
        $table->string('fabric')->nullable();              // Added nullable()
        $table->string('pattern')->nullable();             // Added nullable()
        $table->string('sleeve')->nullable();              // Added nullable()
        $table->string('fit')->nullable();                 // Added nullable()
        $table->string('occasion')->nullable();            // Added nullable()
        $table->integer('stock')->nullable();                // Added nullable()
        $table->integer('sort')->nullable();                 // Added nullable()
        $table->string('meta_title')->nullable();          // Added nullable() to match the image.
        $table->string('meta_description')->nullable();
        $table->string('meta_keywords')->nullable();
        $table->enum('is_featured', ['No', 'Yes']);
        $table->tinyInteger('status')->nullable();
        $table->string('tinyInteger')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
