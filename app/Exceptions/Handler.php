<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * The list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	public function render($request, Throwable $e)
	{
		$response = parent::render($request, $e);

		/** @var Response $response */
		if (app()->environment(['local', 'testing']) && in_array($response->status(), [500, 503, 404, 403])) {
			return Inertia::render('Errors/Error', ['status' => $response->status()])
				->toResponse($request)
				->setStatusCode($response->status());
		} elseif ($response->status() === 419) {
			return back()->with([
				'message' => 'A página expirou, por favor tente novamente.',
			]);
		}

		return $response;
	}

	/**
	 * Register the exception handling callbacks for the application.
	 */
	public function register(): void
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}
}
