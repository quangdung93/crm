<?php 

namespace App\Helpers;

use Carbon\Carbon;

class SchemaHelper{

    public static function schemaProduct($product){
        try{
            $comments = $product->comments;
            $review = [];
            if($comments){
                foreach ($comments as $item) {
                    $review[] = [
                        "@type" => "Review",
                        "author"=> $item->name,
                        "datePublished" => Carbon::parse($item->created_at)->format('Y-m-d'),
                        "reviewBody" => $item->message,
                        "reviewRating" => [ 
                            "@type" => "Rating",
                            "bestRating" => 5,
                            "ratingValue"=> 5,
                        ],
                    ];
                }
            }

            $result = [
                "@context"            => "https://schema.org/",
                "@type"               => "Product",
                "name"                => $product->name,
                "image"               => asset($product->image),
                "url"                 => url($product->link()),
                "description"         => $product->meta_description,
                "sku"                 => $product->sku,
                "mpn"                 => $product->id,
                "brand"               => [
                    "@type"           => "Thing",
                    "name"            => $product->brand->name,
                    "url"             => url($product->brand->link())
                ],
                "review"              => $review,
                "aggregateRating" => [
                    "@type" => "AggregateRating",
                    "bestRating" => 5,
                    "worstRating" => 3,
                    "ratingValue" => 5,
                    "ratingCount" => $product->rating_count,
                ],
                "additionalProperty" => [ 
                    [
                        "@type"=> "PropertyValue",
                        "name"=> "Nơi sản xuất",
                        "value"=> $product->origin
                    ]
                ],
                "offers"              => [
                    "@type"           => "Offer",
                    "priceCurrency"   => "VND",
                    "price"           => $product->price,
                    "priceValidUntil" => Carbon::now()->addDays(7)->format('Y-m-d'),
                    "itemCondition"   => "https://schema.org/NewCondition",
                    "availability"    => "https://schema.org/InStock",
                    "url"             => url($product->link()),
                    "seller"          => [
                        "@type"           => "Organization",
                        "name"            => "kangenvietnam.vn"
                    ]
                ]
            ];
            return json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
        catch(\Exception $e){
            return null;
        }
    }

    public static function schemaPost($post){
        try{
            $result = [
                "@context"         => "https://schema.org",
                "@type"            => "NewsArticle",
                "mainEntityOfPage" => [
                "@type"            => "WebPage",
                "@id"              => url($post->link())
                ],
                "headline"         => $post->name,
                "image"            => asset($post->image),
                "author"           => [
                    "@type"            => "Organization",
                    "name"             => "kangenvietnam.vn"
                ],
                "publisher"        => [
                    "@type"            => "Organization",
                    "name"             => "kangenvietnam.vn",
                    "logo"             => [
                        "@type"            => "ImageObject",
                        "url"              => asset(theme('logo.image'))
                    ]
                ],
                "description"      => $post->meta_description,
                "keywords"         => $post->meta_keywords ?? null,
                "datePublished"    => Carbon::parse($post->created_at)->format('Y-m-d'),
                "dateModified"     => Carbon::parse($post->created_at)->addDays(30)->format('Y-m-d')
            ];
            return json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }
        catch(\Exception $e){
            return null;
        }
    }

}