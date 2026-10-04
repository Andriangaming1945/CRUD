<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Manajemen Akun</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --blue: #3D5AFE;
            --blue-dark: #2A41D1;
            --violet: #6C4DFF;
            --text: #161A3F;
            --muted: #737797;
            --line: #E1E3F0;
            --soft: #F5F6FC;
            --danger: #D8344C;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--text);
            background: #F1F2FA;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(520px circle at var(--bx, 50%) var(--by, 28%), rgba(61, 90, 254, 0.16), transparent 70%),
                radial-gradient(420px circle at calc(100% - var(--bx, 50%)) calc(100% - var(--by, 28%)), rgba(108, 77, 255, 0.12), transparent 70%);
        }

        .card-login {
            position: relative;
            z-index: 1;
            width: min(26rem, 100%);
            padding: 2.4rem 2.2rem 2.2rem;
            border: 1.5px solid transparent;
            border-radius: 22px;
            background:
                linear-gradient(#fff, #fff) padding-box,
                radial-gradient(260px circle at var(--mx, -999px) var(--my, -999px), var(--blue), transparent 70%) border-box,
                linear-gradient(var(--line), var(--line)) border-box;
            box-shadow: 0 30px 70px rgba(30, 38, 120, 0.14);
            animation: rise 0.7s cubic-bezier(0.2, 0.8, 0.2, 1) both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(24px) scale(0.98); }
            to { opacity: 1; transform: none; }
        }

        .head {
            text-align: center;
            margin-bottom: 1.9rem;
        }

        .badge-icon {
            position: relative;
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1.1rem;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--blue), var(--violet));
            box-shadow: 0 14px 28px rgba(61, 90, 254, 0.35);
        }

        .badge-icon::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 18px;
            border: 2px solid var(--blue);
            opacity: 0;
            animation: ping 1.3s 0.6s ease-out 1 both;
        }

        @keyframes ping {
            0% { opacity: 0.7; transform: scale(1); }
            100% { opacity: 0; transform: scale(1.5); }
        }

        .badge-icon svg {
            width: 1.9rem;
            height: 1.9rem;
            overflow: visible;
        }

        .shield {
            stroke-dasharray: 80;
            stroke-dashoffset: 80;
            animation: draw 0.9s 0.35s ease forwards;
        }

        .keyhole {
            opacity: 0;
            transform-origin: 12px 11px;
            animation: pop 0.4s 1.05s cubic-bezier(0.3, 1.6, 0.5, 1) forwards;
            transition: transform 0.3s ease;
        }

        @keyframes draw {
            to { stroke-dashoffset: 0; }
        }

        @keyframes pop {
            from { opacity: 0; transform: scale(0.2); }
            to { opacity: 1; transform: scale(1); }
        }

        .badge-icon.guard .keyhole {
            animation: none;
            opacity: 1;
            transform: scale(1.25);
        }

        .title {
            font-weight: 800;
            font-size: 1.7rem;
            letter-spacing: -0.03em;
            line-height: 1.15;
            margin: 0 0 0.4rem;
        }

        .sub {
            margin: 0;
            font-size: 0.93rem;
            color: var(--muted);
        }

        .field {
            margin-bottom: 1.1rem;
        }

        .field label {
            display: block;
            font-size: 0.86rem;
            font-weight: 600;
            margin-bottom: 0.45rem;
        }

        .control {
            position: relative;
        }

        .control input {
            width: 100%;
            height: 3.2rem;
            padding: 0 1rem;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            background: var(--soft);
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .control input.has-toggle {
            padding-right: 3rem;
        }

        .control input:focus {
            background: #fff;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(61, 90, 254, 0.13);
        }

        .control input.is-invalid {
            border-color: var(--danger);
            background: #fff;
        }

        .toggle-pass {
            position: absolute;
            right: 0.45rem;
            top: 50%;
            transform: translateY(-50%);
            width: 2.3rem;
            height: 2.3rem;
            display: grid;
            place-items: center;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #9A9EBB;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .toggle-pass:hover {
            background: rgba(61, 90, 254, 0.09);
            color: var(--blue);
        }

        .toggle-pass svg {
            width: 1.15rem;
            height: 1.15rem;
        }

        .toggle-pass .icon-hide {
            display: none;
        }

        .toggle-pass.showing .icon-show {
            display: none;
        }

        .toggle-pass.showing .icon-hide {
            display: block;
        }

        .toggle-pass:focus-visible,
        .btn-login:focus-visible {
            outline: 3px solid rgba(61, 90, 254, 0.45);
            outline-offset: 2px;
        }

        .hint {
            margin-top: 0.4rem;
            font-size: 0.82rem;
        }

        .hint-error {
            color: var(--danger);
        }

        .hint-caps {
            display: none;
            color: #9A6200;
        }

        .hint-caps.on {
            display: block;
        }

        .btn-login {
            width: 100%;
            height: 3.25rem;
            margin-top: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            border: 0;
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            font-size: 0.98rem;
            background-image: linear-gradient(90deg, var(--blue-dark) 50%, var(--blue) 50%);
            background-size: 200% 100%;
            background-position: right center;
            box-shadow: 0 12px 24px rgba(61, 90, 254, 0.3);
            transition: background-position 0.45s cubic-bezier(0.2, 0.7, 0.2, 1), transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            color: #fff;
            background-position: left center;
            transform: translateY(-2px);
            box-shadow: 0 16px 28px rgba(61, 90, 254, 0.4);
        }

        .btn-login:active {
            transform: translateY(0) scale(0.985);
        }

        .btn-login:disabled {
            opacity: 1;
            color: #fff;
        }

        .btn-login .go {
            width: 1.15rem;
            height: 1.15rem;
            transition: transform 0.3s ease;
        }

        .btn-login:hover .go {
            transform: translateX(3px);
        }

        .btn-login .spinner-border {
            display: none;
            width: 1.15rem;
            height: 1.15rem;
            border-width: 0.18em;
        }

        .btn-login.loading .label,
        .btn-login.loading .go {
            display: none;
        }

        .btn-login.loading .spinner-border {
            display: inline-block;
        }

        .shake {
            animation: shake 0.45s cubic-bezier(0.36, 0.07, 0.19, 0.97);
        }

        @keyframes shake {
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(4px); }
            30%, 50%, 70% { transform: translateX(-7px); }
            40%, 60% { transform: translateX(7px); }
        }

        @media (max-width: 575.98px) {
            .card-login {
                padding: 2rem 1.4rem 1.8rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .card-login, .shield, .keyhole, .badge-icon::after, .shake {
                animation: none;
            }
            .shield {
                stroke-dashoffset: 0;
            }
            .keyhole {
                opacity: 1;
            }
            .btn-login, .btn-login .go {
                transition: none;
            }
        }
    </style>
</head>
<body>
    <main class="card-login" id="card">
        <div class="head">
            <div class="badge-icon" id="badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path class="shield" d="M12 3l7.5 2.6v5.6c0 4.7-3.1 8.3-7.5 9.8-4.4-1.5-7.5-5.1-7.5-9.8V5.6L12 3z"/>
                    <g class="keyhole">
                        <circle cx="12" cy="10.6" r="1.5" fill="#fff" stroke="none"/>
                        <path d="M12 12.2v2.8" stroke-width="1.8"/>
                    </g>
                </svg>
            </div>
            <h1 class="title">Manajemen Akun</h1>
            <p class="sub">Masuk pakai email dan password kamu.</p>
        </div>

        <form action="/login" method="POST" id="loginForm">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <div class="control">
                    <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required autofocus>
                </div>
                @error('email')
                    <div class="hint hint-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="control">
                    <input type="password" id="password" name="password" class="has-toggle @error('password') is-invalid @enderror" placeholder="Masukkan password" autocomplete="current-password" required>
                    <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan password">
                        <svg class="icon-show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="icon-hide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.1 10.1 0 0 1 12 19c-6.4 0-10-7-10-7a17.8 17.8 0 0 1 4.1-5"/><path d="M9.9 5.2A9.8 9.8 0 0 1 12 5c6.4 0 10 7 10 7a17.7 17.7 0 0 1-2.2 3.2"/><path d="M14.1 14.1A3 3 0 0 1 9.9 9.9"/><path d="M2 2l20 20"/></svg>
                    </button>
                </div>
                <div class="hint hint-caps" id="capsHint">Caps Lock sedang aktif.</div>
                @error('password')
                    <div class="hint hint-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login" id="submitBtn">
                <svg class="go" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>
                <span class="label">Login</span>
                <span class="spinner-border" role="status" aria-hidden="true"></span>
            </button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            var card = document.getElementById('card');
            var form = document.getElementById('loginForm');
            var pass = document.getElementById('password');
            var toggle = document.getElementById('togglePass');
            var caps = document.getElementById('capsHint');
            var btn = document.getElementById('submitBtn');
            var badge = document.getElementById('badge');

            function shake() {
                card.classList.remove('shake');
                void card.offsetWidth;
                card.classList.add('shake');
            }

            toggle.addEventListener('click', function () {
                var show = pass.type === 'password';
                pass.type = show ? 'text' : 'password';
                toggle.classList.toggle('showing', show);
                toggle.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                pass.focus();
            });

            pass.addEventListener('focus', function () {
                badge.classList.add('guard');
            });

            pass.addEventListener('blur', function () {
                badge.classList.remove('guard');
                caps.classList.remove('on');
            });

            function checkCaps(e) {
                if (e.getModifierState) {
                    caps.classList.toggle('on', e.getModifierState('CapsLock'));
                }
            }

            pass.addEventListener('keydown', checkCaps);
            pass.addEventListener('keyup', checkCaps);

            form.addEventListener('invalid', shake, true);

            form.addEventListener('submit', function () {
                btn.classList.add('loading');
                setTimeout(function () {
                    btn.disabled = true;
                }, 0);
            });

            window.addEventListener('pageshow', function () {
                btn.classList.remove('loading');
                btn.disabled = false;
            });

            @if ($errors->any())
                shake();
            @endif

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            var root = document.body;
            var target = { x: window.innerWidth / 2, y: window.innerHeight * 0.28 };
            var current = { x: target.x, y: target.y };
            var running = false;

            function loop() {
                current.x += (target.x - current.x) * 0.07;
                current.y += (target.y - current.y) * 0.07;
                root.style.setProperty('--bx', current.x + 'px');
                root.style.setProperty('--by', current.y + 'px');

                if (Math.abs(target.x - current.x) > 0.5 || Math.abs(target.y - current.y) > 0.5) {
                    requestAnimationFrame(loop);
                } else {
                    running = false;
                }
            }

            window.addEventListener('mousemove', function (e) {
                target.x = e.clientX;
                target.y = e.clientY;

                var r = card.getBoundingClientRect();
                card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
                card.style.setProperty('--my', (e.clientY - r.top) + 'px');

                if (!running) {
                    running = true;
                    requestAnimationFrame(loop);
                }
            });

            document.addEventListener('mouseleave', function () {
                card.style.setProperty('--mx', '-999px');
                card.style.setProperty('--my', '-999px');
            });
        })();
    </script>
</body>
</html>