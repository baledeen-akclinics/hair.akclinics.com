<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | AK Clinics</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="<?= esc(base_url('favicon.ico')) ?>">
    <style>
        :root { --ak-orange: #fd7e14; --ak-dark: #1f2937; --ak-muted: #6b7280; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Georgia, 'Times New Roman', serif;
            background: linear-gradient(180deg, #fff7ed 0%, #ffffff 45%, #f8fafc 100%);
            color: var(--ak-dark);
            min-height: 100vh;
        }
        .hero {
            background: linear-gradient(135deg, #ea580c 0%, #fd7e14 55%, #fb923c 100%);
            color: #fff;
            text-align: center;
            padding: 72px 20px 110px;
        }
        .hero h1 {
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 700;
            letter-spacing: 0.02em;
            position: relative;
            display: inline-block;
        }
        .hero h1::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 120px;
            height: 2px;
            background: #fff;
        }
        .card {
            width: min(920px, calc(100% - 32px));
            margin: -80px auto 48px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
            padding: 28px 24px 36px;
            text-align: center;
        }
        .card img {
            width: min(420px, 100%);
            height: auto;
            display: block;
            margin: 0 auto 18px;
        }
        .card p {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            font-size: 1.05rem;
            line-height: 1.6;
            color: var(--ak-muted);
            max-width: 560px;
            margin: 0 auto 22px;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: var(--ak-orange);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn:hover { filter: brightness(0.95); }
        .social {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 22px;
            flex-wrap: wrap;
        }
        .social a {
            color: var(--ak-orange);
            text-decoration: none;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
        }
    </style>
    <?php if (! empty($gtag_id)): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= esc($gtag_id, 'attr') ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', <?= json_encode($gtag_id) ?>);
    </script>
    <?php endif; ?>
</head>
<body>
    <header class="hero">
        <h1>Thank You!</h1>
    </header>

    <main class="card">
        <img src="<?= esc(base_url('img/thankyou.png')) ?>" alt="Thank you for contacting AK Clinics">
        <p>Your request has been submitted successfully. Our team will contact you shortly.</p>
        <a class="btn" href="<?= esc($back_url) ?>">Back To Home</a>
        <div class="social">
            <a href="https://www.facebook.com/AKClinics" target="_blank" rel="noopener">Facebook</a>
            <a href="https://www.instagram.com/ak.clinics/" target="_blank" rel="noopener">Instagram</a>
            <a href="https://twitter.com/AKClinics" target="_blank" rel="noopener">Twitter</a>
            <a href="https://www.linkedin.com/company/ak-clinics/" target="_blank" rel="noopener">LinkedIn</a>
            <a href="https://www.youtube.com/user/TheFuehairtransplant" target="_blank" rel="noopener">YouTube</a>
        </div>
    </main>
</body>
</html>
