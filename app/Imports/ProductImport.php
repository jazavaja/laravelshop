<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\PriceChange;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if(is_integer($row[2])){
                $post = Product::where(function ($query) use($row) {
                    $query->where('title', $row[0])
                        ->orWhere('product_id', $row[1]);
                })->first();
                if($post){
                    if ($row[3]){
                        $price = round((int)$row[1] - ((int)$row[1] * $row[3] / 100));
                    }else{
                        $price = (int)$row[1];
                    }
                    $post = Product::create([
                        'title' => $row[0],
                        'titleSeo' => $row[0],
                        'keywordSeo' => $row[0],
                        'imageAlt' => $row[0],
                        'currency_id' => 0,
                        'off' => $row[3],
                        'product_id' => $row[1],
                        'offPrice' => $row[1],
                        'price' => $price,
                        'user_id' => auth()->user()->id,
                        'status' => 1,
                        'weight' => 0,
                        'maxCart' => 10,
                        'showcase' => 0,
                        'used' => 0,
                        'inquiry' => 0,
                        'priceCurrency' => $row[1],
                        'count' => $row[4],
                        'image' => json_encode(explode(',',$row[5])),
                        'short' => $row[6],
                        'bodySeo' => $row[6],
                        'body' => $row[7],
                        'slug' => $row[8],
                        'ability' => json_encode([]),
                        'size' => json_encode([]),
                        'specifications' => json_encode([]),
                        'colors' => json_encode([]),
                    ]);
                    PriceChange::create([
                        'price' => $price,
                        'product_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
