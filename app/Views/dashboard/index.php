<?php
// Inline styles scoped to this view only
?>
<style>
     .select-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 7px 10px 7px 34px;
            min-width: 155px;
            cursor: pointer;
            user-select: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .select-wrapper:hover {
            border-color: #94a3b8;
            background: #f8fafc;
        }

        .select-wrapper.open {
            border-color: #3b5bdb;
            box-shadow: 0 0 0 3px rgba(59, 91, 219, 0.12);
        }

        .select-icon-left {
            position: absolute;
            left: 10px;
            pointer-events: none;
            color: #64748b;
            display: flex;
            align-items: center;
        }

        .select-label {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            flex: 1;
            white-space: nowrap;
        }

        .select-chevron {
            display: flex;
            align-items: center;
            color: #64748b;
            transition: transform 0.2s, color 0.2s;
            margin-left: auto;
        }

        .select-wrapper.open .select-chevron {
            transform: rotate(180deg);
            color: #3b5bdb;
        }

        .select-wrapper:hover .select-chevron {
            color: #3b5bdb;
        }

        .select-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 27, 45, 0.1);
            padding: 5px;
            margin: 0;
            list-style: none;
            min-width: 100%;
            z-index: 50;
            animation: dropIn 0.15s ease;
        }

        .select-wrapper.open .select-dropdown {
            display: block;
        }

        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .select-option {
            padding: 9px 12px;
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
            border-radius: 7px;
            cursor: pointer;
            transition: background 0.15s;
            white-space: nowrap;
        }

        .select-option:hover {
            background: #f1f5f9;
            color: #3b5bdb;
        }

        .select-option.active {
            background: #eff3ff;
            color: #3b5bdb;
            font-weight: 700;
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

          <div class="select-wrapper" id="timeDropdown">
              <span class="select-icon-left">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <rect x="3" y="4" width="18" height="18" rx="3"/>
                      <line x1="16" y1="2" x2="16" y2="6"/>
                      <line x1="8" y1="2" x2="8" y2="6"/>
                      <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
              </span>
              <span class="select-label" id="timeLabel">Last 6 months</span>
              <span class="select-chevron">
                  <svg width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                      <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              </span>
              <ul class="select-dropdown" id="timeOptions">
                  <li class="select-option active" data-value="6m">Last 6 months</li>
                  <li class="select-option" data-value="3m">Last 3 months</li>
                  <li class="select-option" data-value="1m">Last month</li>
                  <li class="select-option" data-value="1y">Last year</li>
              </ul>
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
<script>
    (function () {
        const wrapper  = document.getElementById('timeDropdown');
        const label    = document.getElementById('timeLabel');
        const options  = document.querySelectorAll('#timeOptions .select-option');

        wrapper.addEventListener('click', function (e) {
            wrapper.classList.toggle('open');
            e.stopPropagation();
        });

        options.forEach(function (opt) {
            opt.addEventListener('click', function (e) {
                options.forEach(o => o.classList.remove('active'));
                opt.classList.add('active');
                label.textContent = opt.textContent;
                wrapper.classList.remove('open');
                e.stopPropagation();

                // Déclenche la mise à jour du graphique si besoin
                const event = new CustomEvent('timeRangeChange', { detail: opt.dataset.value });
                document.dispatchEvent(event);
            });
        });

        document.addEventListener('click', function () {
            wrapper.classList.remove('open');
        });
    })();
</script>
