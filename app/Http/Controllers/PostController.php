<?php
namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::paginate(3);
        return response()->json([
            'posts' => $posts
        ]);
    }

   
    public function store(PostRequest $request)
    {
        
        $tokenResponse = PostResponse::fromRequest($request);
        if ($tokenResponse->status === 401) {
            return $tokenResponse; 
        }
              
        $img = $request->file('Image_path'); 
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images'), $imageName);

        $posts = Post::create([
            'Name' => $request->input('Name'),  
            'Description' => $request->input('Description'),
            'Image_path' => $imageName,  
            'Status' => 1,  
        ]);
    
        return PostResponse::success($posts);
    }
    

    
    public function update(PostRequest $request, string $id)
{
   
    $tokenResponse = PostResponse::fromRequest($request);
    if ($tokenResponse->status === 401) {
        return $tokenResponse; 
    }

 
    $posts = Post::find($id);
    if (!$posts) {
       
        return response()->json([
            'message' => 'Post not found',
            'status' => 404
        ], 404);
    }

    if ($request->hasFile('Image_path')) {
        $img = $request->file('Image_path');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images'), $imageName);

        
        $posts->Image_path = $imageName;
    }

   
    $posts->Name = $request->input('Name');
    $posts->Description = $request->input('Description');
    $posts->Status = $request->input('Status', 1); 
    $posts->save();  

   
    return PostResponse::updatedata($posts);
}

    public function destroy(string $id)
    {
         
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Token not provided',
                'status'=>401
            ], 401);
        }
    
        $posts=Post::find($id);
        if(!$posts){
            return PostResponse::missing($posts);
        }
        $posts->delete();
        return PostResponse::destroydata($posts);
    }
    public function show(string $id)
{
    $posts = Post::find($id); 

    if (!$posts) {
        return PostResponse::missing($posts);
    }

    return response()->json([
        'post' => $posts
    ]);

}

}

