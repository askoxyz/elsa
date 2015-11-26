<?php

class View {

	private $viewname;
	private $data = array();
	private $before;
	private $after;

	function __construct($viewname) {

		$this->viewname = $viewname;

	}

	public static function make($viewname) {

		$view = new View($viewname);

		return $view;

	}

	public function with($key, $value) {

		array_push($this->data, array($key => $value));

		return $this;

	}

	public function makeBefore($viewname) {

		$this->before = $viewname;

		return $this;

	}

	public function makeAfter($viewname) {

		$this->after = $viewname;

		return $this;

	}

	public function get() {

		// data to variables
		if(!empty($this->data)) {

			foreach($this->data as $data) {

				foreach($data as $key => $val) {

					$$key = $val;

				}

			}

		}

		// before view
		if(!empty($this->before)) {

			if(file_exists(ELSA . '/app/views/' . $this->before . '.php')) {

				ob_start();

				require_once ELSA . '/app/views/' . $this->before . '.php';

				$viewBefore = ob_get_contents();

				ob_end_clean();

				echo $viewBefore;

			}

		}

		// actual view
		if(file_exists(ELSA . '/app/views/' . $this->viewname . '.php')) {

			ob_start();

			require_once ELSA . '/app/views/' . $this->viewname . '.php';

			$view = ob_get_contents();

			ob_end_clean();

			echo $view;

		}

		// after view
		if(!empty($this->after)) {

			if(file_exists(ELSA . '/app/views/' . $this->after . '.php')) {

				ob_start();

				require_once ELSA . '/app/views/' . $this->after . '.php';

				$viewAfter = ob_get_contents();

				ob_end_clean();

				echo $viewAfter;

			}

		}

	}

	public function getInSystem() {

		// data to variables
		if(!empty($this->data)) {

			foreach($this->data as $data) {

				foreach($data as $key => $val) {

					$$key = $val;

				}

			}

		}

		// before view
		if(!empty($this->before)) {

			if(file_exists(ELSA . '/system/views/' . $this->before . '.php')) {

				ob_start();

				require_once ELSA . '/system/views/' . $this->before . '.php';

				$viewBefore = ob_get_contents();

				ob_end_clean();

				echo $viewBefore;

			}

		}

		// actual view
		if(file_exists(ELSA . '/system/views/' . $this->viewname . '.php')) {

			ob_start();

			require_once ELSA . '/system/views/' . $this->viewname . '.php';

			$view = ob_get_contents();

			ob_end_clean();

			echo $view;

		}

		// after view
		if(!empty($this->after)) {

			if(file_exists(ELSA . '/system/views/' . $this->after . '.php')) {

				ob_start();

				require_once ELSA . '/system/views/' . $this->after . '.php';

				$viewAfter = ob_get_contents();

				ob_end_clean();

				echo $viewAfter;

			}

		}

	}

}
