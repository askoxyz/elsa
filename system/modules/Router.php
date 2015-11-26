<?php

class Router {

	protected $routes = array();
	protected $namedRoutes = array();
	protected $basePath = '';
	protected $matchTypes = array(
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '.+?',
		'**' => '.++',
		''   => '[^/\.]++'
	);

	public function __construct($routes = array(), $basePath = '', $matchTypes = array()) {

		$this->addRoutes($routes);
		$this->setBasePath($basePath);
		$this->addMatchTypes($matchTypes);

	}

	public function getRoutes() {

		return $this->routes;

	}

	public function addRoutes($routes) {

		if(!is_array($routes) && !$routes instanceof Traversable) {

			throw new \Exception('Routes should be an array or an instance of Traversable');

		}

		foreach($routes as $route) {

			call_user_func_array(array($this, 'map'), $route);

		}

	}

	public function setBasePath($basePath) {

		$this->basePath = $basePath;

	}

	public function addMatchTypes($matchTypes) {

		$this->matchTypes = array_merge($this->matchTypes, $matchTypes);

	}

	public function map($method, $route, $target, $name = null) {

		$this->routes[] = array($method, $route, $target, $name);

		if($name) {

			if(isset($this->namedRoutes[$name])) {

				throw new \Exception("Can not redeclare route '{$name}'");

			} else {

				$this->namedRoutes[$name] = $route;

			}

		}

		return;

	}

	public function get($route, $target, $name = null) {

		$this->map('GET', $route, $target, $name);

	}

	public function post($route, $target, $name = null) {

		$this->map('POST', $route, $target, $name);

	}

	public function generate($routeName, array $params = array()) {

		if(!isset($this->namedRoutes[$routeName])) {

			throw new \Exception('Route ' . $routeName . ' does not exist');

		}

		$route = $this->namedRoutes[$routeName];
		$url = $this->basePath . $route;

		if(preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			foreach($matches as $match) {

				list($block, $pre, $type, $param, $optional) = $match;

				if($pre) $block = substr($block, 1);

				if(isset($params[$param])) {

					$url = str_replace($block, $params[$param], $url);

				} elseif($optional) {

					$url = str_replace($pre . $block, '', $url);

				}

			}

		}

		return $url;

	}

	public function match($requestUrl = null, $requestMethod = null) {

		$params = [];
		$match = false;

		if($requestUrl == null) {

			$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

		}

		// stip base path from request url
		$requestUrl = substr($requestUrl, strlen($this->basePath));

		// strip query string from request url
		if(($strpos = strpos($requestUrl, '?')) !== false) {

			$requestUrl = substr($requestUrl, 0, $strpos);

		}

		// set request method if it isn't passed as a parameter
		if($requestMethod == null) {

			$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

		}

		foreach($this->routes as $handler) {

			list($method, $_route, $target, $name) = $handler;

			$methods = explode('|', $method);
			$method_match = false;

			// check if request method matches. If not, abandon early.
			foreach($methods as $method) {

				if(strcasecmp($requestMethod, $method) === 0) {

					$method_match = true;
					break;

				}

			}

			// method did not match, continue to next route
			if(!$method_match) continue;

			// check for a wildcard (matches all)
			if($_route === '*') {

				$match = true;

			} elseif(isset($_route[0]) && $_route[0] === '@') {

				$pattern = '`' . substr($_route, 1) . '`u';
				$match = preg_match($pattern, $requestUrl, $params);

			} else {

				$route = null;
				$regex = false;
				$j = 0;
				$n = isset($_route[0]) ? $_route[0] : null;
				$i = 0;

				while(true) {

					if(!isset($_route[$i])) {

						break;

					} elseif(false === $regex) {

						$c = $n;
						$regex = $c === '[' || $c === '(' || $c === '.';

						if(false === $regex && false !== isset($_route[$i+1])) {

							$n = $_route[$i+1];
							$regex = $n === '?' || $n === '+' || $n === '*' || $n === '{';

						}

						if(false === $regex && $c !== '/' && (!isset($requestUrl[$j]) || $c !== $requestUrl[$j])) {

							continue 2;

						}

						$j++;

					}

					$route .= $_route[$i++];

				}

				$regex = $this->compileRoute($route);
				$match = preg_match($regex, $requestUrl, $params);

			}

			if(($match == true || $match > 0)) {

				if($params) {

					foreach($params as $key => $value) {

						if(is_numeric($key)) unset($params[$key]);

					}

				}

				return ['target' => $target, 'params' => $params, 'name' => $name];

			}

		}

		return false;

	}

	public function dispatchController($match) {

		$controller = @explode('@', $match['target'])[0];
		$method = @explode('@', $match['target'])[1];

		if(class_exists($controller)) {

			$dispatchedController = new $controller;

			if(method_exists($dispatchedController, $method)) {

				if(!empty($match['params'])) {

					$params = json_decode(json_encode($match['params']));

					return $dispatchedController->$method($params);

				}

				return $dispatchedController->$method();

			}

			return Error::make('Route does not exist');

		}

		return Error::make('Route does not exist!');

	}

	private function compileRoute($route) {

		if(preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			$matchTypes = $this->matchTypes;

			foreach($matches as $match) {

				list($block, $pre, $type, $param, $optional) = $match;

				if(isset($matchTypes[$type])) $type = $matchTypes[$type];
				if($pre === '.') $pre = '\.';

				$pattern = '(?:' . ($pre !== '' ? $pre : null) . '(' . ($param !== '' ? "?P<$param>" : null) . $type . '))' . ($optional !== '' ? '?' : null); 
				$route = str_replace($block, $pattern, $route);

			}

		}

		return "`^$route$`u";

	}

}
