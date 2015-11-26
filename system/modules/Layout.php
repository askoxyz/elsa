<?php

class Layout {

	public function make($name, $data = []) {

		if(file_exists(ELSA . '/app/layout/' . $name . '.php')) {

			if(!empty($data)) {

				foreach($data as $key => $value) {

					$$key = $value;

				}

			}

			ob_start();

			require ELSA . '/app/layout/' . $name . '.php';

			$template = ob_get_clean();

			ob_flush();

			return $template;

		}

	}

}
