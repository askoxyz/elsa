<?php

class Content {

	private $folder;
	private $slug = false;
	private $orderby = 'timestamp';
	private $order = 'desc';
	private $extension = 'md';

	function __construct($folder) {

		$this->folder = $folder;

	}

	public static function in($folder) {

		$content = new Content($folder);

		return $content;

	}

	public function orderBy($orderby, $order) {

		$this->orderby = $orderby;
		$this->order = $order;

		return $this;

	}
	
	public function withSlug($slug) {

		$this->slug = $slug;

		return $this;

	}

	public function get() {

		$content = [];
		$count = 1;

		// initial object creation
		foreach(glob(ELSA . '/content/' . $this->folder . '/*.' . $this->extension) as $contentItem) {

			// parse content
			$frontmatter = new FrontMatter($contentItem);
			$parsedown = new ParsedownExtra();
			$meta = [];
			$type = preg_match('/content\/(.*)\//', $contentItem, $match);
			$type = $match[1];

			foreach($frontmatter->fetchMeta() as $key => $value) {

				$meta[$key] = $value;

			}

			// compose
			$content[$count]['id'] = (int) @explode('_', array_pop(explode('/', $contentItem)))[0];
			$content[$count]['slug'] = @explode('.', explode('_', array_pop(explode('/', $contentItem)))[1])[0];
			$content[$count]['content'] = $parsedown->text($frontmatter->fetchContent());
			$content[$count]['content_raw'] = $frontmatter->fetchContent();
			$content[$count]['type'] = $type;
			$content[$count]['meta'] = $meta;

			$count++;

		}

		// order
		usort($content, function($a, $b) {

			// id desc
			if($this->orderby === 'id' && $this->order === 'desc') {

				return $b['id'] - $a['id'];

			}

			// id asc
			if($this->orderby === 'id' && $this->order === 'asc') {

				return $a['id'] - $b['id'];

			}

			// timestamp desc
			if($this->orderby === 'timestamp' && $this->order === 'desc') {

				return $b['meta']['timestamp'] - $a['meta']['timestamp'];

			}

			// timestamp asc
			if($this->orderby === 'timestamp' && $this->order === 'asc') {

				return $a['meta']['timestamp'] - $b['meta']['timestamp'];

			}

		});

		// convert to objects
		$content = json_decode(json_encode($content));

		// with slug ...
		if($this->slug) {

			// find the content we want
			foreach($content as $contentItem) {

				if($contentItem->slug === $this->slug) {

					return $contentItem;
					break;

				}

			}

		}

		return $content;

	}

}
