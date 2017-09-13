<?php namespace App\Http\Controllers;

use App\Models\MAPosts;
use App\Models\MAUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class MAPostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /maposts
	 *
	 * @return Response
	 */
	public function index()
	{
        $posts = MAPosts::all();
        $response = [
            'posts' => $posts
        ];


        return response()->json($response, 200);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /maposts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /maposts
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $post = new MAPosts();
        $post->id =  Uuid::uuid4();
        $post->title = $request->title;
        $post->text = $request->text;
        $user = JWTAuth::parseToken()->toUser();
        $post->user_id = $user->id;


        if ($post->save()) {
            return response()->json(['post' => $post], 201);
        } else {
            return response()->json(['error' => 'Not saved'], 400);

        }
	}

	/**
	 * Display the specified resource.
	 * GET /maposts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $post = MAPosts::find($id);

        if ($post->save()) {
            return response()->json(['post' => $post], 200);
        } else {
            return response()->json(['error' => 'User not found!'], 400);

        }
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /maposts/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /maposts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $post =  MAPosts::find($id);
        $post->title = $request->title;
        $post->text = $request->text;


        if ($post->save()) {
            return response()->json(['post' => $post], 201);
        } else {
            return response()->json(['error' => 'Not saved'], 400);

        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /maposts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $post = MAPosts::where('id', $id)->delete();

        return response()->json(['succses' => $post], 200);
	}

}