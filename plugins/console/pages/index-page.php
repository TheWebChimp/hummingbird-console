<?php
	$default = 'echo "Hello World";';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $site->getPageTitle(); ?></title>

	<link rel="shortcut icon" href="<?php $site->img('favicon.ico'); ?>">
	<link rel="icon" href="<?php $site->img('favicon.png'); ?>" type="image/png">

	<?php $site->includeStyles(); ?>
	<?php $site->includeScript('modernizr'); ?>
	<?php $site->includeScript('respond'); ?>
	<?php $site->includeScriptVars(); ?>
</head>
<body class="<?php $site->bodyClass() ?>">

		<div class="console-wrapper">
			<header class="console-header">
				<div class="boxfix-vert">
					<div class="margins">
						<h2><i class="fa fa-fw fa-code"></i> Console</h2>
					</div>
				</div>
			</header>
			<section>
				<div class="boxfix-vert">
					<div class="margins">
						<div class="row row-10">
							<div class="col col-6">
								<form id="form-code" class="form-code" action="" method="post">
									<div class="form-group codemirror" data-mode="text/x-php">
										<textarea name="code" id="code"><?php echo $default; ?></textarea>
									</div>
									<div class="text-right">
										<button type="submit" class="button button-primary">Execute</button>
									</div>
								</form>
							</div>
							<div class="col col-6">
								<div class="box box-output">
									<div class="console-output"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="console-push"></div>
		</div>

		<footer class="console-footer">
			<div class="boxfix-vert">
				<div class="margins">
					<div class="footer-copyright">
						<small class="cf">
							<span class="copyright-left">Copyright &copy; 2015 biohzrdmx &amp; tets</span>
							<span class="copyright-right">Made with <strong>Hummingbird</strong> &amp; <strong>Chimplate</strong> and tons of <i class="fa fa-heart"></i></span>
						</small>
					</div>
				</div>
			</div>
		</footer>

	<?php $site->includeScripts(); ?>
</body>
</html>