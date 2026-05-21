<div class="page-head"><div><h1>Administrative Overview</h1><p>Real-time metrics for academic year 2024/2025.</p></div></div>
<div class="cards four">
  <div class="stat"><span class="icon">👥</span><small>Total Students</small><h2><?=number_format($studentCounts['total'])?></h2><b class="green">+12%</b></div>
  <div class="stat"><span class="icon">▣</span><small>Total Services</small><h2><?=number_format($serviceCounts['total'])?></h2><b>Stable</b></div>
  <div class="stat"><span class="icon">▤</span><small>Active Bookings</small><h2><?=number_format($activeBookings)?></h2><b class="red">-4%</b></div>
  <div class="stat"><span class="icon">💵</span><small>Revenue (MTD)</small><h2>$1.4M</h2><b class="green">+28%</b></div>
</div>
<div class="grid-two">
  <section class="panel"><div class="panel-head"><div><h2>Registration Trends</h2><p>New enrollments over the last 6 months</p></div><select><option>Last 6 Months</option></select></div><canvas id="trendChart" height="260"></canvas></section>
  <section class="panel"><div class="panel-head"><h2>Recent Activity</h2><a>See All</a></div><?php foreach($activities as $a):?><div class="activity"><span>✓</span><div><b><?=htmlspecialchars($a['type'])?></b><p><?=htmlspecialchars($a['student_name'].' - '.$a['content'])?></p><small><?=htmlspecialchars($a['created_at'])?></small></div></div><?php endforeach;?></section>
</div>
<section class="panel table-panel"><div class="panel-head"><h2>Popular Services</h2><div><button onclick="exportTable('popularTable')" class="btn light">Export CSV</button><a class="btn primary" href="index.php?route=services">Add New Service</a></div></div>
<table id="popularTable"><thead><tr><th>Service Name</th><th>Category</th><th>Enrollments</th><th>Status</th><th>Actions</th></tr></thead><tbody><?php foreach(array_slice($services,0,3) as $s):?><tr><td><b><?=htmlspecialchars($s['name'])?></b></td><td><?=htmlspecialchars($s['category'])?></td><td><?=rand(120,2410)?></td><td><span class="badge active"><?=htmlspecialchars($s['status'])?></span></td><td>⋮</td></tr><?php endforeach;?></tbody></table></section>
