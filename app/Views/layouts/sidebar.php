<aside class="sidebar">
  <div class="brand"><div class="logo">▣</div><div><h2>EduManager</h2><p>Academic Portal</p></div></div>
  <nav>
    <a class="<?=($active??'')==='dashboard'?'active':''?>" href="index.php?route=dashboard">▦ Dashboard</a>
    <a class="<?=($active??'')==='students'?'active':''?>" href="index.php?route=students">👥 Students</a>
    <a class="<?=($active??'')==='services'?'active':''?>" href="index.php?route=services">▣ Services</a>
    <a class="<?=($active??'')==='bookings'?'active':''?>" href="index.php?route=bookings">▤ Bookings</a>
    <a class="<?=($active??'')==='presence'?'active':''?>" href="index.php?route=presence">✓ Presence</a>
  </nav>
  <div class="support"><small>Support Tier</small><b>Premium Enterprise</b></div>
</aside>
<main class="main"><header class="topbar"><form method="get" class="search"><input type="hidden" name="route" value="<?= htmlspecialchars($active ?? 'dashboard') ?>"><input name="q" value="<?= htmlspecialchars($q ?? '') ?>" placeholder="Search students or records..."></form><div class="userbar"><span>🔔</span><span><?= htmlspecialchars($user['name'] ?? 'Admin User') ?><small>Administrator</small></span><a href="index.php?route=logout">Logout</a></div></header><section class="content">
