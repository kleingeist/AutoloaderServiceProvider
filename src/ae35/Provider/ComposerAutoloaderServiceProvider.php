<?php

namespace ae35\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

use Composer\Autoload\ClassLoader;

class ComposerAutoloaderServiceProvider implements ServiceProviderInterface
{
	protected $loader;
	
	function __construct(ClassLoader $loader) 
	{
		$this->loader = $loader;
	}
	
	public function register(Application $app)
	{
		$self = $this;
		
		$app['autoloader'] = function() use ($self) {
			return $self;
		};
	}

	public function boot(Application $app)
	{
	}
	
	/**
	* Registers a namespace.
	*
	* @param string $namespace The namespace
	* @param array|string $paths The location(s) of the namespace
	*
	*/
	public function registerNamespace($namespace, $paths) 
	{
		$this->loader->add($namespace, $paths);
	}
	
	/**
	 * Overloading to pass calls to the ClassLoader
	 */
	public function __call($name, $arguments)
	{
		if (!method_exists($this->loader, $name)) {
			throw new BadMethodCallException();
		}
		
		return call_user_func_array(array($this->loader, $name), $arguments);
	}

	
}
