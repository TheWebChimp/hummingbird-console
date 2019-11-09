<?php

	$msg = get_item($_GET, 'msg');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $site->getPageTitle(); ?> | Console</title>

	<link rel="shortcut icon" href="<?php $site->img('favicon.ico'); ?>">
	<link rel="icon" href="<?php $site->img('favicon.png'); ?>" type="image/png">

	<?php $site->includeStyles(); ?>
	<?php $site->includeScript('modernizr'); ?>
	<?php $site->includeScript('respond'); ?>
	<?php $site->includeScriptVars(); ?>
</head>
<body class="<?php $site->bodyClass() ?>">

	<div class="login-box">

		<?php if($msg == 400): ?>
			<div class="message message-error">The password is incorrect</div>
		<?php endif; ?>

		<form action="" method="post">
			<div class="form-fields">
				<h2 class="title"><i class="fa fa-fw fa-code"></i> Console</h2>
				<div class="form-group">
					<input class="hide" type="text" name="user" autocomplete="username">
					<input placeholder="Enter console password to proceed" class="input-block form-control" type="password" name="password" id="password" autocomplete="new-password">
				</div>
			</div>
			<div class="form-actions">
				<button class="button button-block button-primary">Access</button>
			</div>
		</form>
	</div>

	<?php $site->includeScripts(); ?>
</body>
</html>