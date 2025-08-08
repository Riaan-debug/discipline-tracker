<?php

namespace App\Http\Middleware;

use App\Services\AuditService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RateLimitAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveRequestSignature($request);

        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts())) {
            // Log rate limit event
            $routeName = $request->route()->getName();
            $identifier = $request->ip();
            if ($request->has('email')) {
                $identifier .= '|' . $request->email;
            }
            AuditService::logRateLimit($routeName, $identifier, [
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            return $this->buildResponse($key);
        }

        RateLimiter::hit($key, $this->decayMinutes() * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response, $this->maxAttempts(),
            $this->calculateRemainingAttempts($key)
        );
    }

    /**
     * Resolve request signature.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        $routeName = $request->route()->getName();
        $identifier = $request->ip();

        // Add email to signature for better rate limiting
        if ($request->has('email')) {
            $identifier .= '|' . $request->email;
        }

        return sha1($identifier . '|' . $routeName);
    }

    /**
     * Create a 'too many attempts' response.
     */
    protected function buildResponse(string $key): Response
    {
        $retryAfter = RateLimiter::availableIn($key);

        return response()->json([
            'message' => 'Too many attempts. Please try again later.',
            'retry_after' => $retryAfter,
        ], 429)->withHeaders([
            'Retry-After' => $retryAfter,
            'X-RateLimit-Reset' => $this->availableAt($retryAfter),
        ]);
    }

    /**
     * Add the limit header information to the given response.
     */
    protected function addHeaders(Response $response, int $maxAttempts, int $remainingAttempts): Response
    {
        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);
    }

    /**
     * Calculate the number of remaining attempts.
     */
    protected function calculateRemainingAttempts(string $key): int
    {
        return RateLimiter::remaining($key, $this->maxAttempts());
    }

    /**
     * Get the maximum number of attempts for the rate limiter.
     */
    protected function maxAttempts(): int
    {
        return 5; // 5 attempts per window
    }

    /**
     * Get the number of minutes to decay the rate limiter.
     */
    protected function decayMinutes(): int
    {
        return 15; // 15 minutes window
    }

    /**
     * Get the "available at" timestamp for the rate limiter.
     */
    protected function availableAt(int $delay): int
    {
        return now()->addSeconds($delay)->getTimestamp();
    }
}
