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

	public function getCode()
	{
		return $this->exception->getCode();
	}

	public function getMessage()
	{
		return $this->exception->getMessage();
	}

	public function getFile()
	{
		return $this->exception->getFile();
	}

	public function getLine()
	{
		return $this->exception->getLine();
	}
}
