<?php
namespace Marcohern\Products\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(ProductSeeder::class);
    $this->call(ProductCategorySeeder::class);
    $this->call(ProductPrdCatSeeder::class);
  }
}
