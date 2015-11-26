<?php

class ElsaController {

	public function index() {

		// signed in?
		if(Session::get('user_email')) return Request::redirect('/elsa/content');

		// not signed in?
		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

	}

	public function signIn() {

		// if signed in, redirect to content
		if(Session::get('user_email')) return Request::redirect('/elsa/content');

		if(Input::all()) {

			$email = Input::get('email');
			$password = Input::get('password');

			if($email && $password && User::find($email) && Hash::verify($password, User::find($email)->password)) {

				Session::put('user_email', $email);

				return Request::redirect('/elsa/content');

			}

		}

		return View::make('signin')->getInSystem();

	}

	public function signOut() {

		Session::flush();

		return Request::redirect('/elsa/signin');

	}

	public function content($params = false) {

		// not signed in?
		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		foreach(ContentTypes::get() as $contentType) {

			$first_type = $contentType->slug;
			break;

		}

		if(!$params) return Request::redirect('/elsa/content/type/' . $first_type);

		if($params) $type = $params->type;

		return View::make('content')
			->with('type', $type)
			->with('sidebar', 'content')
			->with('active', 'content')
			->with('title', ucfirst($type))
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();

	}

	public function editContent($params) {

		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		return View::make('content-edit')
			->with('type', $params->type)
			->with('content', Content::in($params->type)->withSlug($params->slug)->get())
			->with('sidebar', 'edit-content')
			->with('active', 'content')
			->with('title', 'Edit Content')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();

	}

	public function deleteContent($params) {

	}

	public function createContent() {

		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		return View::make('content-create')
			->with('sidebar', 'create-content')
			->with('active', 'content')
			->with('title', 'Create Content')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();
		
	}

	public function stats() {

		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		return View::make('stats')
			->with('sidebar', 'stats')
			->with('active', 'stats')
			->with('title', 'Stats')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();

	}

	public function users() {

		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		return View::make('users')
			->with('sidebar', 'users')
			->with('active', 'users')
			->with('title', 'Users')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();

	}

	public function settings() {

		if(!Session::get('user_email')) return Request::redirect('/elsa/signin');

		return View::make('settings')
			->with('sidebar', 'settings')
			->with('active', 'settings')
			->with('title', 'Settings')
			->makeBefore('partials/header')
			->makeAfter('partials/footer')
			->getInSystem();

	}

}
