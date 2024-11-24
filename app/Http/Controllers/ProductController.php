<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
class ProductController extends Controller
{
    public function getProducts(){
      try{
        $products = Products::get();
        if ($products->isEmpty()) {
             return response()->json([
                 'error' => true,
                 'message' => 'No data found',
                 'data' => []
             ]);
        }else{
            return response()->json([
                'error' => false,
                'message' => 'Data retrieved successfully',
                'data' => $products
            ]);
        }

      }catch(Exception $e){
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
            'data' => []
        ]);
      }
      
    
    }
    public function calculateDiscount(Request $request){
        try{
            $discount_rate = 0;
            if($request->customerType ==='VIP') {
                $discount_rate = 0.20;
             }else if($request->customerType ==='REGULAR') {
                $discount_rate = 0.10;
             }else{
                $discount_rate = 0;
             }
             if( $request->totalAmount >0 &&  $discount_rate > 0){
                $discountedAmount = $request->totalAmount * $discount_rate;
             }else{
                $discountedAmount =0;
             }
               
            echo("Original Amount: $" .number_format($request->totalAmount,2) ."<br>");
            echo("Discounted Amount: $" .number_format($discountedAmount,2) ."<br>");
            echo("Original Amount: $" .number_format($request->totalAmount-$discountedAmount,2) ."<br>");
        }catch(Exception $e){
            echo($e->getMessage());
        }
    }
        //the logical error in the function wasIf the customerType is neither VIP nor REGULAR, the $discount_rate remains 0, 
        // which may not be intentional. This could lead to a misleading calculation of the discounted amount and final amount. 
        // i have added ans else condition for if else if if the user neither vip nor regular discount_rate will be 0
        //and i have added anothe rif else for total amount is greate than 0 we have to only calculate the dicounted amount if andn only iff
        //total amount grater than 0 and discount rate greater than 0 so this will remove unwantd operation
        //and added try catch for exception handling  

        public function sort($products){
            $n = count($products);//bubble sort 0(n^2) will beb time complexity
            for($i = 0; $i< $n -1 ; $i++){
                for($j = 0 ; $j <$n - $i -1 ;$j++){
                    if($products[$j]['price'] > $products[$j]['price']){
                        $temp = $products[$j];
                        $products[$j] = $products[$j+1];
                        $products[$j+1] = $temp;
                    }
                }
            }
        }
        public function filter($products,$quanity){
            $filterd_array =[];
            foreach($products as $product){
                if($product['quantity'] >= $quantity){
                    $filterd_array = $product;
                }
            }
            return $filtered;
        }
        public function toatal($products,$quanity){
            $total =0;
            foreach($products as $product){
               
                    $total  += $product['price'] * $product['quantity'];
                
            }
            return $total;
        }

        //in question 4  the function fetchALlProducts retrieve all product data from db which could lead to perfomance issues 
        //if thwre are 1000 of rows and also high memory usage of large array to store the products
        //and calculateTotalStockValue loop through the fetched data also increase the fetching time
        function getCache($key) {
            // fn to  fetch data from a cache
            // return false if cache is empty
            return false; 
        }
        
        function setCache($key, $value, $ttl) {
            // fn to  storing data in a cache 
        }
        
        function calculateTotalStockValueWithCache() {
            $cacheKey = 'total_stock_value';
            $cachedValue = getCache($cacheKey);
        
            if ($cachedValue !== false) {
                return $cachedValue; // Return cached value
            }
        
            $db = getDatabaseConnection();
            // optimized query to calculate total stock value directly in SQL
            $result = $db->query('SELECT SUM(price * quantity) AS total_stock_value FROM products');
            $row = $result->fetch_assoc();
            $totalStockValue = $row['total_stock_value'];
        
            // store the result in cache for 10 minutes
            setCache($cacheKey, $totalStockValue, 600);
        
            return $totalStockValue;
        }
        
      
       

    


    public function stringOperations($string, $rule){
       
            foreach ($rules as $rule => $value) {
                switch ($rule) {
                    case 'uppercase':
                        if ($value) {
                            $string = strtoupper($string);
                        }
                        break;
                    case 'lowercase':
                        if ($value) {
                            $string = strtolower($string);
                        }
                        break;
                    case 'capitalize':
                        if ($value) {
                            $string = ucwords(strtolower($string)); 
                        }
                        break;
                    case 'addPrefix':
                        $string = $value . $string;
                        break;
                    case 'addSuffix':
                        $string .= $value;
                        break;
                    case 'replace':
                        if (is_array($value) && isset($value['find'], $value['replace'])) {
                            $string = str_replace($value['find'], $value['replace'], $string);
                        }
                        break;
                    default:
                       echo 'something went wrong!';
                        break;
                }
            }
            return $string;
        
      
    }
}
