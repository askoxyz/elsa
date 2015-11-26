<?php

class ContentTypes {
	
	public static function get() {

		$contentFolders = glob(ELSA . '/content/*', GLOB_ONLYDIR);
		$contentTypes = [];

		foreach($contentFolders as $contentFolder) {

			$contentTypes[] = [
				'slug' => substr($contentFolder, strrpos($contentFolder, '/') + 1),
				'name' => ucfirst(substr($contentFolder, strrpos($contentFolder, '/') + 1))
			];

		}

		return json_decode(json_encode($contentTypes));

	}

}