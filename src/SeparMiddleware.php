<?php

/*
 * This file is part of Laravel Separ.
 *
 * (c) Aboozar Ghaffari <aboozar.ghf@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tartan\Separ;

use Closure;

/**
 * This is the Separ middleware class.
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class SeparMiddleware
{
    /**
     * The Separ instance.
     *
     * @var \Tartan\Separ\Separ
     */
    protected $separ;

    /**
     * Create a new Separ middleware class.
     *
     * @param \Tartan\Separ\Separ $separ
     *
     * @return void
     */
    public function __construct(Separ $separ)
    {
        $this->separ = $separ;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $user
     *
     * @return mixed
     */
    public function handle($request, Closure $next, string $user = null)
    {
        $this->separ->verify($request->getUser(), $request->getPassword(), $user);

        return $next($request);
    }
}
