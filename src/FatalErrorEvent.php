<?php
/**
 * Author: metal
 * Email: metal
 */

namespace metalguardian\rollbar;

/**
 * Class FatalErrorEvent
 * @package core\components
 */
class FatalErrorEvent extends \CEvent
{

	/**
	 * @var \ErrorException the exception that this event is about.
	 */
	public $exception;

	/**
	 * Constructor.
	 *
	 * @param mixed $sender sender of the event
	 * @param \ErrorException $exception the exception
	 */
	public function __construct($sender, $exception)
	{
		$this->exception = $exception;
		parent::__construct($sender);
	}
}
