<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->withCount('products')->latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $input = $request->all();
        if ($request->hasFile('cover')) {
            $destination_path = 'public/images/categories';
            $image = $request->file('cover');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('cover')->storeAs($destination_path, $image_name);

            $input = $image_name;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'cover' => $input,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $keranjangs = Keranjang::findOrFail($id);
        $keranjangs->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil DiHapus',
        ]);
    }

}
