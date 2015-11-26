<?php

class SiteController {

	public function work() {

		return View::make('work')
			->with('about', Content::in('pages')->withSlug('about')->get())
			->with('work', Content::in('work')->get())
			->with('active', 'work')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->get();

	}

	public function blog() {

		return View::make('blog')
			->with('posts', Content::in('posts')->get())
			->with('active', 'blog')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->get();

	}

	public function blogPost($params) {

		// if article don't exist, 404
		if(!Content::in('posts')->withSlug($params->slug)->get()) return Request::redirect('/404');

		return View::make('blog-post')
			->with('post', Content::in('posts')->withslug($params->slug)->get())
			->with('active', 'blog')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->get();

	}

	public function page($params) {

		// if page don't exist, 404
		if(!Content::in('pages')->withSlug($params->slug)->get()) return Request::redirect('/404');

		return View::make('page')
			->with('page', Content::in('pages')->withSlug($params->slug)->get())
			->with('active', $params->slug)
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->get();

	}

}
