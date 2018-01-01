<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $content = json_decode(file_get_contents(public_path('data/products.json')), true);
        return response()->json($content, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $content = json_decode(file_get_contents(public_path('data/detail.json')), true);
        return response()->json($content, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filters(Request $request)
    {
        // $content = json_decode(file_get_contents(public_path('data/filters.json')), true);
        // return response()->json($content, 200);
        $data = [
            'categories' => $this->categories(),
            'shippings' => $this->shippings()
        ];
        return response()->json($data, 200);
    }

    private function categories()
    {
        $categories = [];
        for ($i=0; $i<10; $i++) {
            $categories[$i] = [ 
                'name' => 'Category Utama '. $i,
                'subs' => [],
                'count' => random_int(1000, 5000)
            ];
            for ($j=0; $j<10; $j++) {
                
                $categories[$i]['subs'][] = [ 
                    'name' => 'Sub Category '. $j,
                    'subs' => [],
                    'count' => random_int(1000, 5000)
                ];

                for ($k=0; $k<5; $k++) {
                    
                    $categories[$i]['subs'][$j]['subs'][] = [ 
                        'name' => 'Sub Sub Category '. $k,
                        'subs' => [],
                        'count' => random_int(1000, 5000)
                    ];

                }
            }
        }

        return $categories;
    }

    public function shippings()
    {
        return $shippings = [
            [
                'name'  => 'GO-SEND SAME DAY',
                'id'    => 1
            ],
            [
                'name'  => 'JNE Regular',
                'id'    => 2
            ],
            [
                'name'  => 'J&T Express',
                'id'    => 3
            ],
            [
                'name'  => 'JNE OKE',
                'id'    => 4
            ],
            [
                'name'  => 'Pos Kilat Khusus',
                'id'    => 5
            ],
            [
                'name'  => 'GO-SEND INSTANT',
                'id'    => 6
            ]
        ];

    }
}
