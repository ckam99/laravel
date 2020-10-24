<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 * )
 * @OA\Server(
 *   url="/api",
 *   description="Example api Documentation" 
 * )
 * @OA\Components(
 *    @OA\Schema(
 *     schema="Tweet",
 *     required={"fullname", "username", "avatar", "quote"},
 *     @OA\Xml(name="Tweet"),
 *     @OA\Property(type="integer",format="int64", property="id"),
 *     @OA\Property(type="string", property="fullname"),
 *     @OA\Property(type="string", property="username"),
 *     @OA\Property(type="string", property="avatar"),
 *     @OA\Property(type="string", property="quota"),
 *     @OA\Property(type="integer", property="likes"),
 *     @OA\Property(type="integer", property="retweets"),
 *     @OA\Property(type="integer", property="comments"),
 *     @OA\Property(type="date-time", property="created_at"),
 *     @OA\Property(type="date-time", property="updated_at"),
 *    )
 * )
 */