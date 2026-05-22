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
    .panel.table-panel td:nth-child(1) { width: 28%; }

    .panel.table-panel th:nth-child(2),
    .panel.table-panel td:nth-child(2) { width: 16%; }

    .panel.table-panel th:nth-child(3),
    .panel.table-panel td:nth-child(3) { width: 14%; }

    .panel.table-panel th:nth-child(4),
    .panel.table-panel td:nth-child(4) { width: 32%; }

    .panel.table-panel th:nth-child(5),
    .panel.table-panel td:nth-child(5) { width: 10%; }
</style>

<!-- Page Header -->
<div class="page-head">
    <div>
        <h1>Presence</h1>
        <p>Track student attendance, absences, and delays.</p>
    </div>
    <button class="btn primary" onclick="openModal('presenceModal')">＋ Mark Presence</button>
</div>

<!-- Presence Table -->
<section class="panel table-panel">
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Date</th>
                <th>Status</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presences as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['student_name']) ?></td>
                    <td><?= htmlspecialchars($p['presence_date']) ?></td>
                    <td>
                        <span class="badge <?= strtolower($p['status']) ?>">
                            <?= htmlspecialchars($p['status']) ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($p['note']) ?></td>
                    <td>
                        <a class="link red"
                           onclick="return confirm('Delete?')"
                           href="index.php?route=presence.delete&id=<?= $p['id'] ?>">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- Mark Presence Modal -->
<div class="modal" id="presenceModal">
    <form class="modal-card" method="post" action="index.php?route=presence.store">
        <h2>Mark Presence</h2>

        <select name="student_id" required>
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['id'] ?>">
                    <?= htmlspecialchars($s['first_name'] . ' ' . $s['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="date" name="presence_date" required>

        <select name="status">
            <option>Present</option>
            <option>Absent</option>
            <option>Late</option>
        </select>

        <textarea name="note" placeholder="Note"></textarea>

        <button class="btn primary">Save</button>
    </form>
</div>