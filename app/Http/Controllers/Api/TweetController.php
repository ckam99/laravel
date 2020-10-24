<?php

namespace App\Http\Controllers\Api;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

class TweetController extends Controller
{
     /**
     * Tweets List.
     * @OA\Get(
     *     path="/tweets",
     *     tags={"Tweet"},
     *     operationId="tweet-list",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(type="array",
     *             @OA\Items(ref="#/components/schemas/Tweet")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     ),
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::all();
        return response($tweets, 200);
    }




    /**
     * Tweet By ID.
     * @OA\Get(
     *     path="/tweets/{id}",
     *     tags={"Tweet"},
     *     operationId="tweet-by-id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="tweet id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Tweet")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Not found",
     *     ),
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::findOrFail($id);
        return response($tweet, 200);
    }


    /**
     * Remove Tweet By ID.
     * @OA\Delete(
     *     path="/tweets/{id}",
     *     tags={"Tweet"},
     *     operationId="tweet-by-id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="tweet id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="successful operation",
     *         @OA\JsonContent(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Not found",
     *     ),
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();
        return response("", 204);
    }




    /**
     * @OA\Put(
     *     path="/tweets/{id}",
     *     tags={"Tweet"},
     *     operationId="tweet-by-id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="tweet id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         description="Pet object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Tweet"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Tweet")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Not found",
     *     ),
     * )
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        // validation goes here

        $tweet->likes = $request->likes;
        $tweet->save();

        return response()->json($tweet, 200);
    }
}