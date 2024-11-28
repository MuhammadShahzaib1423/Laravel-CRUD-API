<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message ?? 'Post Created Successfully.',
            'status' => $this->status ?? 200,
            'data' => $this->data ?? null,
        ];
    }
    

    /**
     * Automatically handle token validation response.
     *
     * @param  Request  $request
     * @return static
     */
    public static function fromRequest(Request $request): static
    {
        if (!$request->bearerToken()) {
            return new static((object) [
                'message' => 'Token not provided',
                'status' => 401,
            ]);
        }
        return new static((object) [
            'message' => 'Token provided',
            'status' => 200,
        ]);
    }
    
    public function tokenvalid():static {
        return new static((object) [
            'message' => 'Token provided',  
            'status' => 200,
    
        ]);
    
    
    }

    /**
     * Create a success response.
     *
     * @param  mixed $posts
     * @return static
     */
    public static function success($posts): static
    {
        return new static((object) [
            
            'message' => 'Post Created successfully.',
            'status' => 200,
            'data' => $posts,
        ]);
    }

    /**
     * Create an updated post response.
     *
     * @param  mixed $posts
     * @return static
     */
    public static function updatedata($posts): static
    {
        return new static((object) [
           
            'message' => 'Post Updated successfully.',
            'status' => 200,
            'data' => $posts,
            
        ]);
    }

    /**
     * Create a deleted post response.
     *
     * @param  mixed $posts
     * @return static
     */
    public static function destroydata($posts): static
    {
        return new static((object) [
            'message' => 'Post deleted successfully.',
            'status' => 200,
            'data' => $posts,
        ]);
    }

    /**
     * Handle missing post response.
     *
     * @param  mixed $posts
     * @return static
     */
    public static function missing($posts): static
    {
        return new static((object) [
            'message' => 'Post not found.',
            'status' => 404,
            'data' => $posts,
        ]);
    }
}
