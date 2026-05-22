<?php $config = require __DIR__ . '/../../../config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduManager</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#0f172a,#1e293b,#2563eb);
            overflow:hidden;
            position:relative;
        }

        /* Animated circles */

        body::before,
        body::after{
            content:'';
            position:absolute;
            border-radius:50%;
            filter:blur(80px);
            opacity:0.5;
        }

        body::before{
            width:300px;
            height:300px;
            background:#3b82f6;
            top:-100px;
            left:-100px;
        }

        body::after{
            width:350px;
            height:350px;
            background:#9333ea;
            bottom:-120px;
            right:-120px;
        }

        .login-wrap{
            width:100%;
            max-width:420px;
            padding:20px;
            z-index:2;
        }

        .login-card{
            background:rgba(255,255,255,0.08);
            backdrop-filter:blur(15px);
            border:1px solid rgba(255,255,255,0.1);
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 40px rgba(0,0,0,0.3);
            animation:fadeIn 1s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(30px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .login-brand{
            text-align:center;
            margin-bottom:30px;
            color:white;
        }

        .login-logo{
            width:75px;
            height:75px;
            margin:auto;
            border-radius:20px;
            background:linear-gradient(135deg,#3b82f6,#9333ea);
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:32px;
            font-weight:bold;
            margin-bottom:15px;
            box-shadow:0 8px 25px rgba(0,0,0,0.3);
        }

        .login-brand h1{
            font-size:32px;
            font-weight:700;
        }

        .login-brand p{
            opacity:0.8;
            margin-top:5px;
        }

        .login-card h2{
            color:white;
            margin-bottom:10px;
            font-size:28px;
        }

        .login-card p{
            color:#cbd5e1;
            margin-bottom:25px;
            font-size:14px;
        }

        label{
            display:block;
            color:#e2e8f0;
            margin-bottom:8px;
            margin-top:15px;
            font-size:14px;
        }

        .input-icon{
            display:flex;
            align-items:center;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.1);
            border-radius:14px;
            padding:0 15px;
            transition:0.3s;
        }

        .input-icon:focus-within{
            border-color:#60a5fa;
            box-shadow:0 0 15px rgba(96,165,250,0.5);
        }

        .input-icon span{
            color:#cbd5e1;
        }

        .input-icon input{
            width:100%;
            padding:15px;
            border:none;
            background:transparent;
            color:white;
            outline:none;
            font-size:15px;
        }

        .input-icon button{
            background:none;
            border:none;
            color:white;
            cursor:pointer;
            font-size:18px;
        }

        .check{
            display:flex;
            align-items:center;
            gap:10px;
            margin-top:18px;
            color:#cbd5e1;
            font-size:14px;
        }

        .btn{
            width:100%;
            margin-top:25px;
            padding:15px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg,#3b82f6,#2563eb);
            color:white;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 20px rgba(59,130,246,0.4);
        }

        .alert{
            background:rgba(239,68,68,0.2);
            border:1px solid rgba(239,68,68,0.5);
            color:#fecaca;
            padding:12px;
            border-radius:12px;
            margin-bottom:20px;
        }

        .secure{
            margin-top:20px;
            text-align:center;
            font-size:13px;
            color:#cbd5e1;
        }

        .help{
            text-align:center;
            margin-top:20px;
            color:white;
            opacity:0.8;
        }

        .help b{
            color:#93c5fd;
        }

        a{
            color:#93c5fd;
            text-decoration:none;
            float:right;
            font-size:13px;
        }

        @media(max-width:480px){

            .login-card{
                padding:30px 25px;
            }

            .login-brand h1{
                font-size:26px;
            }

            .login-card h2{
                font-size:24px;
            }

        }

    </style>

</head>

<body>

    <div class="login-wrap">

        <!-- Branding -->
        <div class="login-brand">
            <div class="login-logo">🎓</div>
            <h1>EduManager</h1>
            <p>Institutional Administration Portal</p>
        </div>

        <!-- Login Form -->
        <form method="post" action="index.php?route=login" class="login-card">

            <h2>Welcome Back</h2>
            <p>Sign in to access your administrative dashboard.</p>

            <?php if (!empty($error)): ?>
                <div class="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <label>Institutional Email</label>

            <div class="input-icon">
                <span>✉</span>
                <input
                    type="email"
                    name="email"
                    value="admin@edu-manager.com"
                    required
                >
            </div>

            <label>
                Access Password
                <a href="#">Forgot password?</a>
            </label>

            <div class="input-icon">
                <span>🔒</span>

                <input
                    type="password"
                    name="password"
                    value="admin123"
                    id="password"
                    required
                >

                <button type="button" onclick="togglePassword()">
                    👁
                </button>
            </div>

            <label class="check">
                <input type="checkbox">
                Stay signed in for 30 days
            </label>

            <button class="btn">
                ↪ Sign In to Portal
            </button>

            <div class="secure">
                🛡 256-bit Encryption • Authorized Access Only
            </div>

        </form>

        <p class="help">
            Technical issues?
            <b>Contact IT Support</b>
        </p>

    </div>

    <script>

        // Toggle password visibility

        function togglePassword(){

            const password = document.getElementById('password');

            if(password.type === 'password'){
                password.type = 'text';
            }else{
                password.type = 'password';
            }

        }

        // Simple form animation

        const inputs = document.querySelectorAll('input');

        inputs.forEach(input => {

            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'scale(1)';
            });

        });

    </script>

</body>
</html>
