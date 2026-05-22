<?php // Inline styles scoped to this view only ?>
<style>
    .chart-small {
        max-width: 100%;
        margin-top: 24px;
    }

    .main {
        width: calc(100% - 270px);
        max-width: 100%;
    }

    .content {
        padding: 36px 42px;
        max-width: 100%;
        box-sizing: border-box;
    }

    .panel.table-panel {
        width: 100%;
        overflow-x: auto;
    }

    .panel.table-panel table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
    }

    .panel.table-panel th,
    .panel.table-panel td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .panel.table-panel th:nth-child(1),
    .panel.table-panel td:nth-child(1) { width: 18%; }

    .panel.table-panel th:nth-child(2),
    .panel.table-panel td:nth-child(2) { width: 18%; }

    .panel.table-panel th:nth-child(3),
    .panel.table-panel td:nth-child(3) { width: 13%; }

    .panel.table-panel th:nth-child(4),
    .panel.table-panel td:nth-child(4) { width: 16%; }

    .panel.table-panel th:nth-child(5),
    .panel.table-panel td:nth-child(5) { width: 25%; }

    .panel.table-panel th:nth-child(6),
    .panel.table-panel td:nth-child(6) { width: 10%; }

    .panel.table-panel td select {
        appearance: none;
        -webkit-appearance: none;
        background: #f5f7fc;
        border: 1px solid #d7dce8;
        border-radius: 8px;
        color: #0f1b2d;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 10px;
        outline: none;
        width: 100%;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .panel.table-panel td select:focus {
        border-color: #123fb3;
        box-shadow: 0 0 0 3px rgba(18, 63, 179, 0.1);
    }
</style>

<!-- Page Header -->
<div class="page-head">
    <div>
        <h1>Bookings</h1>
        <p>Manage reservations and service orders.</p>
    </div>
    <button class="btn primary" onclick="openModal('bookingModal')">＋ New Booking</button>
</div>

<!-- Bookings Table -->
<section class="panel table-panel">
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['student_name']) ?></td>
                    <td><?= htmlspecialchars($b['service_name']) ?></td>
                    <td><?= htmlspecialchars($b['booking_date']) ?></td>
                    <td>
                        <form method="post" action="index.php?route=bookings.status">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option <?= $b['status'] === 'Pending'   ? 'selected' : '' ?>>Pending</option>
                                <option <?= $b['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option <?= $b['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                <option <?= $b['status'] === 'Done'      ? 'selected' : '' ?>>Done</option>
                            </select>
                        </form>
                    </td>
                    <td><?= htmlspecialchars($b['comment']) ?></td>
                    <td>
                        <a class="link red"
                           href="index.php?route=bookings.delete&id=<?= $b['id'] ?>"
                           onclick="return confirm('Delete booking?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- New Booking Modal -->
<div class="modal" id="bookingModal">
    <form class="modal-card" method="post" action="index.php?route=bookings.store">
        <h2>New Booking</h2>

        <select name="student_id" required>
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['id'] ?>">
                    <?= htmlspecialchars($s['first_name'] . ' ' . $s['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="service_id" required>
            <?php foreach ($services as $s): ?>
                <option value="<?= $s['id'] ?>">
                    <?= htmlspecialchars($s['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="date" name="booking_date" required>

        <select name="status">
            <option>Pending</option>
            <option>Confirmed</option>
        </select>

        <textarea name="comment" placeholder="Comment"></textarea>

        <button class="btn primary">Save</button>
    </form>
</div>