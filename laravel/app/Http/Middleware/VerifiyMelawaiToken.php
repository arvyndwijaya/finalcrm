<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Helpers\TokenApiHelper;

class VerifiyMelawaiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try
        {
            $validKey = TokenApiHelper::VerifyToken($request->bearerToken());
            if (!$validKey)
            {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid token'
                ]);
            }
        }
        catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
        return $next($request);
    }
}
