function openModal(id) {
    document.getElementById(id)?.classList.add('show');
}

function closeModal(id) {
    document.getElementById(id)?.classList.remove('show');
}

function togglePassword() {
    const p = document.getElementById('password');

    if (p) {
        p.type = p.type === 'password' ? 'text' : 'password';
    }
}

function exportTable(id) {
    const table = document.getElementById(id);

    if (!table) {
        return;
    }

    let csv = [...table.querySelectorAll('tr')]
        .map(r =>
            [...r.children]
                .map(c => '"' + c.innerText.replaceAll('"', '""') + '"')
                .join(',')
        )
        .join('\n');

    const a = document.createElement('a');

    a.href = URL.createObjectURL(new Blob([csv], {
        type: 'text/csv'
    }));

    a.download = id + '.csv';
    a.click();
}

function editStudent(s) {
    openModal('studentModal');

    document.querySelector('#studentModal form').action = 'index.php?route=students.update';
    document.getElementById('studentModalTitle').innerText = 'Edit Student';

    [
        'id',
        'student_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'class_name',
        'status'
    ].forEach(k => {
        let el = document.getElementById(k === 'id' ? 'student_id' : k);

        if (el) {
            el.value = s[k] ?? '';
        }
    });
}

function drawBars(canvasId, values, labels) {
    const c = document.getElementById(canvasId);

    if (!c) {
        return;
    }

    const ctx = c.getContext('2d');
    const w = c.width = c.offsetWidth;
    const h = c.height = c.getAttribute('height') || 220;

    ctx.clearRect(0, 0, w, h);

    const max = Math.max(...values);
    const gap = w / (values.length * 1.6);

    values.forEach((v, i) => {
        let bh = (v / max) * (h - 50);
        let x = 30 + i * gap * 1.5;

        ctx.fillStyle = i === values.length - 2 ? '#123fb3' : '#b9c8ea';
        ctx.fillRect(x, h - bh - 25, gap, bh);

        ctx.fillStyle = '#445';
        ctx.fillText(labels[i], x, h - 8);
    });
}

function drawTrend() {
    const c = document.getElementById('trendChart');

    if (!c) {
        return;
    }

    const ctx = c.getContext('2d');
    const w = c.width = c.offsetWidth;
    const h = c.height = 260;

    const vals = [300, 410, 520, 680, 620, 740];
    const labels = ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb'];

    drawBars('trendChart', vals, labels);

    ctx.strokeStyle = '#9db0d6';
    ctx.lineWidth = 6;
    ctx.beginPath();

    vals.forEach((v, i) => {
        let x = 50 + i * (w - 100) / (vals.length - 1);
        let y = h - 35 - (v / 800) * (h - 70);

        if (i) {
            ctx.lineTo(x, y);
        } else {
            ctx.moveTo(x, y);
        }
    });

    ctx.stroke();
}

document.addEventListener('DOMContentLoaded', () => {
    drawTrend();

    drawBars(
        'barChart',
        [220, 350, 280, 520, 550, 700, 520, 350],
        ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr']
    );
});