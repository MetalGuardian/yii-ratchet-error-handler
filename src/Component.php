<?php

namespace metalguardian\rollbar;

class Component extends \CApplicationComponent
{

	/**
	 * Your project access token.
	 * @var string
	 */
	public $access_token;
	public $agent_log_location;
	public $base_api_url;
	public $batch_size;
	public $batched;
	public $branch;
	public $capture_error_stacktraces;
	public $code_version;
	public $environment;
	public $error_sample_rates;
	public $handler;
	public $host;
	public $included_errno;
	public $logger;
	public $person;
	public $person_fn;
	public $root;
	public $scrub_fields;
	public $shift_function;
	public $timeout;
	public $report_suppressed;
	public $use_error_reporting;
	public $max_errno;

	public $set_exception_handler = false;
	public $set_error_handler = false;
	public $report_fatal_errors = false;

	public function init() {
		\Rollbar::init(
			array(
				'access_token' => $this->access_token,
				'agent_log_location' => $this->agent_log_location,
				'base_api_url' => $this->base_api_url,
				'batch_size' => $this->batch_size,
				'batched' => $this->batched,
				'branch' => $this->branch,
				'capture_error_stacktraces' => $this->capture_error_stacktraces,
				'code_version' => $this->code_version,
				'environment' => $this->environment,
				'error_sample_rates' => $this->error_sample_rates,
				'handler' => $this->handler,
				'host' => $this->host,
				'included_errno' => $this->included_errno,
				'logger' => $this->logger,
				'person' => $this->person,
				'person_fn' => $this->person_fn,
				'root' => $this->root,
				'scrub_fields' => $this->scrub_fields,
				'shift_function' => $this->shift_function,
				'timeout' => $this->timeout,
				'report_suppressed' => $this->report_suppressed,
				'use_error_reporting' => $this->use_error_reporting,
				'max_errno' => $this->max_errno,
			),
			$this->set_exception_handler,
			$this->set_error_handler,
			$this->report_fatal_errors
		);

		parent::init();
	}
}
