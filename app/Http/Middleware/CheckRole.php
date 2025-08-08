<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Split roles by comma and check if user has any of the required roles
        $requiredRoles = array_map('trim', explode(',', $roles));
        
        if (!$this->hasAnyRole($user, $requiredRoles)) {
            abort(403, 'Access denied. You do not have permission to access this resource.');
        }

        return $next($request);
    }

    /**
     * Check if user has any of the specified roles
     */
    private function hasAnyRole($user, array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($user, $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user has the specified role
     */
    private function hasRole($user, string $role): bool
    {
        return match($role) {
            'admin' => $user->isAdmin(),
            'teacher' => $user->isTeacher(),
            'counselor' => $user->isCounselor(),
            'principal' => $user->isPrincipal(),
            'staff' => in_array($user->role, ['admin', 'teacher', 'counselor', 'principal']),
            'management' => in_array($user->role, ['admin', 'counselor', 'principal']),
            default => false,
        };
    }
} 