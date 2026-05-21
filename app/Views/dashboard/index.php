<?php
// Inline styles scoped to this view only
?>
<style>
.select-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.select-icon-left {
    position: absolute;
    left: 10px;
    pointer-events: none;
    color: #64748b;
    display: flex;
    align-items: center;
}

.time-select {
    appearance: none;
    -webkit-appearance: none;
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    color: #1e293b;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 36px 8px 32px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    min-width: 148px;
}

.time-select:hover {
    border-color: #94a3b8;
    background: #f8fafc;
}

.time-select:focus {
    border-color: #3b5bdb;
    box-shadow: 0 0 0 3px rgba(59, 91, 219, 0.12);
}

.select-chevron {
    position: absolute;
    right: 10px;
    pointer-events: none;
    color: #64748b;
    display: flex;
    align-items: center;
    transition: color 0.2s;
}

.time-select:hover ~ .select-chevron,
.time-select:focus ~ .select-chevron {
    color: #3b5bdb;
}
</style>

<!-- Page Header -->
<div class="page-head">
    <div>
        <h1>Administrative Overview</h1>
        <p>Real-time metrics for academic year 2024/2025.</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="cards four">
    <div class="stat">
        <span class="icon">👥</span>
        <small>Total Students</small>
        <h2><?= number_format($studentCounts['total']) ?></h2>
        <b class="green">+12%</b>
    </div>
    <div class="stat">
        <span class="icon">▣</span>
        <small>Total Services</small>
        <h2><?= number_format($serviceCounts['total']) ?></h2>
        <b>Stable</b>
    </div>
    <div class="stat">
        <span class="icon">▤</span>
        <small>Active Bookings</small>
        <h2><?= number_format($activeBookings) ?></h2>
        <b class="red">-4%</b>
    </div>
    <div class="stat">
        <span class="icon">💵</span>
        <small>Revenue (MTD)</small>
        <h2>$1.4M</h2>
        <b class="green">+28%</b>
    </div>
</div>

<!-- Charts & Activity -->
<div class="grid-two">
    <section class="panel">
        <div class="panel-head">
            <div>
                <h2>Registration Trends</h2>
                <p>New enrollments over the last 6 months</p>
            </div>

            <div class="select-wrapper">
                <select class="time-select" id="timeRange">
                    <option value="6m">Last 6 months</option>
                    <option value="3m">Last 3 months</option>
                    <option value="1m">Last month</option>
                    <option value="1y">Last year</option>
                </select>
                <i class="ti ti-chevron-down" aria-hidden="true"></i>
            </div>
        </div>

        <canvas id="trendChart" height="260"></canvas>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Recent Activity</h2>
            <a href="#">See All</a>
        </div>

        <?php foreach ($activities as $a): ?>
            <div class="activity">
                <span>✓</span>
                <div>
                    <b><?= htmlspecialchars($a['type']) ?></b>
                    <p><?= htmlspecialchars($a['student_name'] . ' - ' . $a['content']) ?></p>
                    <small><?= htmlspecialchars($a['created_at']) ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<!-- Popular Services Table -->
<section class="panel table-panel">
    <div class="panel-head">
        <h2>Popular Services</h2>
        <div>
            <button onclick="exportTable('popularTable')" class="btn light">Export CSV</button>
            <a class="btn primary" href="index.php?route=services">Add New Service</a>
        </div>
    </div>

    <table id="popularTable">
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Category</th>
                <th>Enrollments</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (array_slice($services, 0, 3) as $s): ?>
                <tr>
                    <td><b><?= htmlspecialchars($s['name']) ?></b></td>
                    <td><?= htmlspecialchars($s['category']) ?></td>
                    <td><?= rand(120, 2410) ?></td>
                    <td><span class="badge active"><?= htmlspecialchars($s['status']) ?></span></td>
                    <td>⋮</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>