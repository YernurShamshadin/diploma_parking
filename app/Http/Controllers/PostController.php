<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/posts",
	 *     operationId="GetPostIndex",
	 *     tags={"Test Post"},
	 *     @OA\Response(
	 *         response="200",
	 *         description="Returns data",
	 *         @OA\JsonContent(
	 *               type="array",
	 *
	 *               @OA\Items(ref="#/components/schemas/PostResourceV1")
	 *        )
	 *     ),
	 * )
	 */
    public function index()
    {
        $posts = Post::all();

        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

	/**
	 * @OA\Post(
	 *     path="/api/posts",
	 *     operationId="PostPostStore",
	 *     tags={"Test Post"},
	 *     security={{"bearerAuth": {} }},
	 *     @OA\RequestBody(
	 *
	 *           @OA\MediaType(
	 *                mediaType="application/json",
	 *
	 *                @OA\Schema(ref="#/components/schemas/PostStoreRequestV1")
	 *            )
	 *       ),
	 *     @OA\Response(
	 *         response="200",
	 *         description="Returns data",
	 *         @OA\JsonContent(ref="#/components/schemas/PostResourceV1")
	 *     ),
	 * )
	 */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);

        return PostResource::make($post);
    }

	/**
	 * @OA\Get(
	 *     path="/api/posts/{post}",
	 *     operationId="GetPostShow",
	 *     tags={"Test Post"},
	 *     @OA\Parameter(
	 *     	   description="ID of post",
	 *     	   in="path",
	 *         name="post",
	 *     	   required=true,
	 *     	   example="1"
	 *	   ),
	 *     @OA\Response(
	 *         response="200",
	 *         description="Returns data",
	 *         @OA\JsonContent(ref="#/components/schemas/PostResourceV1")
	 *     ),
	 * )
	 */
    public function show(string $id)
    {
        return PostResource::make(Post::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

	/**
	 * @OA\Put(
	 *     path="/api/posts/{post}",
	 *     operationId="GetPostUpdate",
	 *     tags={"Test Post"},
	 *     security={{"bearerAuth": {} }},
	 *     @OA\RequestBody(
	 *
	 *            @OA\MediaType(
	 *                 mediaType="application/json",
	 *
	 *                 @OA\Schema(ref="#/components/schemas/PostUpdateRequestV1")
	 *             )
	 *     ),
	 *     @OA\Parameter(
	 *           description="ID of post",
	 *           in="path",
	 *           name="post",
	 *           required=true,
	 *           example="1"
	 *     ),
	 *     @OA\Response(
	 *         response="200",
	 *         description="Returns data",
	 *         @OA\JsonContent(ref="#/components/schemas/PostResourceV1")
	 *     )
	 * )
	 */
    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $post = Post::find($id);
        $post->update($data);

        return PostResource::make($post);
    }

	/**
	 * @OA\Delete(
	 *     path="/api/posts/{post}",
	 *     operationId="GetPostDelete",
	 *     tags={"Test Post"},
	 *     security={{"bearerAuth": {} }},
	 *     @OA\Parameter(
	 *           description="ID of post",
	 *           in="path",
	 *           name="post",
	 *           required=true,
	 *           example="1"
	 *       ),
	 *     @OA\Response(
	 *         response="200",
	 *         description="Post deleted successfully"
	 *     )
	 * )
	 */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
           'message' => 'Post deleted successfully',
        ]);
    }
}
