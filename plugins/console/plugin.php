<?php

	/**
	 * Hummingbird Console
	 *
	 * @version 0.1
	 * @author  biohzrdmx <github.com/biohzrdmx>
	 * @uses    MVC
	 * @license MIT
	 */

	// ============================================================================================
	//   Console Implementation
	// ============================================================================================

	class Console {

		function __construct() {

			global $site;
			$site->getRouter()->addRoute('/console', 'Console::indexAction', true);

			$site->registerStyle('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic,300,300italic|Raleway|Oswald:400,300', true);
			$site->registerStyle('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', true);
			$site->registerStyle('codemirror', $site->baseUrl('/plugins/console/css/codemirror.css'), true);
			$site->registerStyle('codemirror.monokai', $site->baseUrl('/plugins/console/css/codemirror.monokai.css'), true, ['codemirror']);
			$site->registerStyle('console', $site->baseUrl('/plugins/console/css/console.css'), true, ['google-fonts', 'font-awesome', 'codemirror.monokai']);

			$site->registerScript('codemirror', $site->baseUrl('/plugins/console/js/codemirror.min.js'), true);
			$site->registerScript('jquery.form', '//cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js', true);
			$site->registerScript('console', $site->baseUrl('/plugins/console/js/console.js'), true, ['jquery', 'codemirror', 'jquery.form']);
		}

		static public function indexAction() {
			global $site;
			$request = $site->getRequest();
			$response = $site->getResponse();
			$login = get_item($_SESSION, 'login');

			switch ($request->type) {
				case 'get':
					$site->enqueueStyle('console');
					$site->enqueueScript('console');

					if( Console::checkLogin($login) ) {

						$site->render('/index-page', [], $site->baseDir('/plugins/console/pages'));

					} else {

						$site->render('/login-page', [], $site->baseDir('/plugins/console/pages'));
					}
				break;
				case 'post':

					if( Console::checkLogin($login) ) {

						$code = $request->post('code');
						$code = preg_replace('/^\s*\<\?php/', '', $code);
						$code = preg_replace('/\?\>\s*$/', '', $code);

						ob_start();
						eval($code);
						$data = ob_get_clean();

						$response->setStatus(200);
						return $response->ajaxRespond('success', $data, '');

					} else {

						$password = $request->post('password');

						if( Console::checkLogin($password) ) {

							$_SESSION['login'] = $password;
							$site->redirectTo($site->urlTo('/console'));

						} else {

							$site->redirectTo($site->urlTo('/console?msg=400'));
						}
					}

				break;
			}

			return $response->respond();
		}

		static public function checkLogin($password) {
			global $site;
			return $site->getOption('console_password') == md5($password);
		}
	}

	$console = new Console();
?>