<?php // Inline styles scoped to this view only ?>
<style>
    .page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .cards.four {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        width: 100%;
    }

    .panel.table-panel,
    .panel.chart-small {
        width: 100%;
    }

    .chart-small {
            max-width: 100%;
            margin-top: 24px;
        }

    #studentsTable {
        width: 100%;
        table-layout: auto;
    }

    #studentsTable th,
    #studentsTable td {
        white-space: nowrap;
    }

    #studentsTable td:nth-child(1) { width: 22%; }
    #studentsTable td:nth-child(2) { width: 22%; }
    #studentsTable td:nth-child(3) { width: 22%; }
    #studentsTable td:nth-child(4) { width: 14%; }
    #studentsTable td:nth-child(5) { width: 10%; }

    .person {
        display: flex;
        align-items: center;
        gap: 0.65rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .modal-card {
        width: 100%;
        max-width: 520px;
    }
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

        #studentsTable {
            width: 100%;
            table-layout: fixed;
        }

        #studentsTable th,
        #studentsTable td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #studentsTable th:nth-child(1),
        #studentsTable td:nth-child(1) { width: 25%; }

        #studentsTable th:nth-child(2),
        #studentsTable td:nth-child(2) { width: 25%; }

        #studentsTable th:nth-child(3),
        #studentsTable td:nth-child(3) { width: 25%; }

        #studentsTable th:nth-child(4),
        #studentsTable td:nth-child(4) { width: 13%; }

        #studentsTable th:nth-child(5),
        #studentsTable td:nth-child(5) { width: 12%; }
</style>

<!-- Page Header -->
<div class="page-head">
    <div>
        <h1>Student Records</h1>
        <p>Manage academic information and enrollment status.</p>
    </div>
    <button class="btn primary" onclick="openModal('studentModal')">👥 Add New Student</button>
</div>

<!-- Stats Cards -->
<div class="cards four">
    <div class="stat">
        <span class="icon">☻</span>
        <small>Total Students</small>
        <h2><?= $counts['total'] ?></h2>
    </div>
    <div class="stat">
        <span class="icon">✓</span>
        <small>Active</small>
        <h2><?= $counts['active'] ?></h2>
    </div>
    <div class="stat">
        <span class="icon">…</span>
        <small>Pending Enrollment</small>
        <h2><?= $counts['pending'] ?></h2>
    </div>
    <div class="stat danger">
        <span class="icon">!</span>
        <small>At Risk</small>
        <h2><?= $counts['risk'] ?></h2>
    </div>
</div>

<!-- Enrollment Table -->
<section class="panel table-panel">
    <div class="panel-head">
        <h2>Enrollment List</h2>
        <div>
            <button onclick="exportTable('studentsTable')" class="icon-btn">⇩</button>
        </div>
    </div>

    <table id="studentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $st): ?>
                <tr>
                    <td>
                        <div class="person">
                            <div class="avatar">
                                <?= strtoupper(substr($st['first_name'], 0, 1) . substr($st['last_name'], 0, 1)) ?>
                            </div>
                            <div>
                                <b><?= htmlspecialchars($st['first_name'] . ' ' . $st['last_name']) ?></b>
                                <small>ID: #<?= htmlspecialchars($st['student_code']) ?></small>
                            </div>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($st['email']) ?></td>
                    <td><?= htmlspecialchars($st['class_name']) ?></td>
                    <td>
                        <span class="badge <?= strtolower(str_replace(' ', '-', $st['status'])) ?>">
                            <?= htmlspecialchars($st['status']) ?>
                        </span>
                    </td>
                    <td>
                        <button class="link" onclick='editStudent(<?= json_encode($st) ?>)'>Edit</button>
                        <a class="link red" onclick="return confirm('Delete student?')" href="index.php?route=students.delete&id=<?= $st['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- Enrollment Trends Chart -->
<section class="panel chart-small">
    <h2>Enrollment Trends</h2>
    <canvas id="barChart" height="180"></canvas>
</section>

<!-- Add / Edit Student Modal -->
<div class="modal" id="studentModal">
    <form class="modal-card" method="post" enctype="multipart/form-data" action="index.php?route=students.store">

        <input type="hidden" name="id" id="student_id">
        <h2 id="studentModalTitle">Add Student</h2>

        <div class="form-grid">
            <input name="student_code" id="student_code" placeholder="Student code">
            <input name="first_name"   id="first_name"   placeholder="First name" required>
            <input name="last_name"    id="last_name"    placeholder="Last name"  required>
            <input name="email"        id="email"        type="email" placeholder="Email">
            <input name="phone"        id="phone"        placeholder="Phone">
            <input name="class_name"   id="class_name"   placeholder="Class">
            <select name="status" id="status">
                <option>Active</option>
                <option>Pending</option>
                <option>Suspended</option>
                <option>At Risk</option>
            </select>
            <input type="file" name="avatar">
        </div>

        <div class="modal-actions">
            <button type="button" class="btn light" onclick="closeModal('studentModal')">Cancel</button>
            <button class="btn primary">Save</button>
        </div>

    </form>
</div>