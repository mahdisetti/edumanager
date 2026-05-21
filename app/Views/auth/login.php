<?php $config=require __DIR__.'/../../../config/config.php'; ?>
<!doctype html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Login - EduManager</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="login-body"><div class="login-wrap"><div class="login-brand"><div class="login-logo">▰</div><h1>EduManager</h1><p>Institutional Administration Portal</p></div>
<form method="post" action="index.php?route=login" class="login-card"><h2>Welcome Back</h2><p>Sign in to access your administrative dashboard.</p><?php if(!empty($error)):?><div class="alert"><?=htmlspecialchars($error)?></div><?php endif;?>
<label>Institutional Email</label><div class="input-icon">✉<input type="email" name="email" value="admin@edu-manager.com" required></div>
<label>Access Password <a href="#">Forgot password?</a></label><div class="input-icon">🔒<input type="password" name="password" value="admin123" id="password" required><button type="button" onclick="togglePassword()">👁</button></div>
<label class="check"><input type="checkbox"> Stay signed in for 30 days</label><button class="btn primary full">↪ Sign In to Portal</button><div class="secure">🛡 256-bit Encryption • Authorized Access Only</div></form>
<p class="help">Technical issues? <b>Contact IT Support</b></p></div><script src="assets/js/app.js"></script></body></html>
