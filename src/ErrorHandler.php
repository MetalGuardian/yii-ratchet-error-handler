<?php
/**
 * Author: metal
 * Email: metal
 */

namespace metalguardian\rollbar;

/**
 * Class ErrorHandler
 * @package metalguardian\rollbar
 */
class ErrorHandler extends \CErrorHandler
{
	/**
	 * If this exception need to be ignored by rollbar
	 * By default 404 error is ignored. You need set false to avoid this
	 * @var \Closure
	 */
	public $ignoreException;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if (is_null($this->ignoreException)) {
			$this->ignoreException = function ($exception) {
				/** @var \CHttpException $exception */
				return ($exception instanceof \CHttpException && $exception->statusCode == 404);
			};
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function handleException($exception)
	{
		$ignored = is_callable($this->ignoreException) && call_user_func($this->ignoreException, $exception);

		if (!$ignored) {
			\Rollbar::report_exception($exception);
		}

		parent::handleException($exception);
	}

	/**
	 * @inheritdoc
	 */
	protected function handleError($event)
	{
		\Rollbar::report_php_error($event->code, $event->message, $event->file, $event->line);

		parent::handleError($event);
	}

	/**
	 * @param \ErrorException $exception
	 */
	protected function handleFatalError($exception)
	{
		\Rollbar::report_php_error($exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine());

		parent::handleException($exception);
	}

	/**
	 * @inheritdoc
	 */
	public function handle($event)
	{
		// set event as handled to prevent it from being handled by other event handlers
		$event->handled = true;

		if ($this->discardOutput) {
			$gzHandler = false;
			foreach (ob_list_handlers() as $h) {
				if (strpos($h, 'gzhandler') !== false) {
					$gzHandler = true;
				}
			}
			// the following manual level counting is to deal with zlib.output_compression set to On
			// for an output buffer created by zlib.output_compression set to On ob_end_clean will fail
			for ($level = ob_get_level(); $level > 0; --$level) {
				if (!@ob_end_clean()) {
					ob_clean();
				}
			}
			// reset headers in case there was an ob_start("ob_gzhandler") before
			if ($gzHandler && !headers_sent() && ob_list_handlers() === array()) {
				if (function_exists('header_remove')) {// php >= 5.3
					header_remove('Vary');
					header_remove('Content-Encoding');
				} else {
					header('Vary:');
					header('Content-Encoding:');
				}
			}
		}

		if ($event instanceof \CExceptionEvent) {
			$this->handleException($event->exception);
		} elseif ($event instanceof \CErrorEvent) {
			$this->handleError($event);
		} elseif ($event instanceof FatalErrorEvent) {
			$this->handleFatalError($event->exception);
		}
	}
} 
