<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {

try {

            $user = JWTAuth::parseToken()->authenticate();

            if( !$user ) throw new Exception('User Not Found');

        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                return response()->json([

                    'data' => null,
                    'status' => false,
                    'message' => 'Token Invalid',
                    'status_code' =>4003,
                     
                ]

            );

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                return response()->json([

                    'data' => null,
                    'status' => false,
                    'message' => 'Token Expired',
                    'status_code' =>4001,

                ]

            );

            }

            else{

                if( $e->getMessage() === 'User Not Found') {

                    return response()->json([

                        "data" => null,
                        "status" => false,
                        'message' => 'User Not Found',
                        'status_code' =>4002,

                    ]

                ); }

                    return response()->json([
                        
                        'data' => null,
                        'status' => false,
                        'message' => 'Authorization Token not found',
                        'status_code' =>4004,

                    ]

                );

                }

            }

            return $next($request);



        }
    }
