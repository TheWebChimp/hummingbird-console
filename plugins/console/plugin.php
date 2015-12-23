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

			$site->registerStyle('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic,300,300italic|Raleway|Oswald:400,300' );
			$site->registerStyle('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css' );

			$site->registerStyle('codemirror', $site->baseUrl('/plugins/console/css/codemirror.css') );
			$site->registerStyle('codemirror.monokai', $site->baseUrl('/plugins/console/css/codemirror.monokai.css'), array('codemirror') );

			$site->registerStyle('console', $site->baseUrl('/plugins/console/css/console.css'), array('google-fonts', 'font-awesome', 'codemirror.monokai') );

			$site->registerScript('codemirror', $site->baseUrl('/plugins/console/js/codemirror.min.js') );
			$site->registerScript('console', $site->baseUrl('/plugins/console/js/console.js'), array('jquery', 'codemirror', 'jquery.form') );
		}
	}

	class ConsoleView extends View {
		function init() {

			global $site;
			$this->pages_dir = $site->baseDir('/plugins/console/pages');
			$this->parts_dir = $site->baseDir('/plugins/console/parts');
		}
	}

	class ConsoleController extends Controller {

		public $view;

		function init() {
			$this->view = new ConsoleView();
		}

		function indexAction() {
			global $site;
			$request = $site->mvc->getRequest();
			$login = get_item($_SESSION, 'login');

			switch ($request->type) {
				case 'get':
					$site->enqueueStyle('console');
					$site->enqueueScript('console');

					if( $this->checkLogin($login) ) {

						$this->view->render('/index-page');

					} else {

						$this->view->render('/login-page');
					}
					break;
				case 'post':

					if( $this->checkLogin($login) ) {

						$code = $request->post('code');
						$code = preg_replace('/^\s*\<\?php/', '', $code);
						$code = preg_replace('/\?\>\s*$/', '', $code);
						eval($code);

					} else {

						$password = md5( $request->post('password') );

						if( $this->checkLogin($password) ) {

							$_SESSION['login'] = $password;
							$site->redirectTo($site->urlTo('/console'));

						} else {

							$site->redirectTo($site->urlTo('/console?msg=400'));
						}
					}

					break;
			}
		}

		function showAction($id) {
			global $site;
			$site->enqueueStyle('console');
			$site->enqueueScript('console');
			$this->view->render('/index-page');
		}

		function checkLogin($password) {
			global $site;
			return md5($site->getOption('console_password')) == $password;
		}
	}

	$console = new Console();
?>