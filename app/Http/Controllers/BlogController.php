<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;
class BlogController extends Controller
{
    public function index($kat = null)
    {
        if(isset($kat))
        {
            $findKat = BlogCategory::where('slug', $kat)->first();
            if($findKat)
            {
                $data = Blog::where('kategori_id', $findKat->id)->get();
            }else{
                $data = [];
            }
        }else{
            $data = Blog::get();
        }
        
        $cat = BlogCategory::get();
        return view('blog.index')->with(['data' => $data, 'category' => $cat]);
    }

    public function show($kategori, $pages)
    {
        $findKat = BlogCategory::where('slug', $kategori)->first();

        if(!$findKat)
        {
            abort(404);
        }

        $findBlog = Blog::where(['kategori_id' => $findKat->id, 'slug' => $pages])->first();


        if(!$findBlog)
        {
            abort(404);
        }

        $data = $findBlog;
        $cat = BlogCategory::get();

        return view('blog.show')->with(['data' => $data, 'category' => $cat]);

    }
}
