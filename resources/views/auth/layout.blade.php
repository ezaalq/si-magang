<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI Magang IKP</title>

    {{-- Import Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            font-family: "Inter", sans-serif;
        }

        /* Modern Typography Enhancements */
        .btn {
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
            background-color: #1d4ed8;
        }

        .form-control {
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
        }

        .form-control:hover {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        /* Enhanced Form Label Styling */
        label {
            font-family: "Inter", sans-serif;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            margin-bottom: 8px;
            display: block;
            letter-spacing: 0.3px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: color 0.2s ease;
        }

        label:hover {
            color: #1f2937;
        }

        a {
            transition: color 0.2s ease;
        }

        a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #4682b4, #b0c4de, #ffffff, #add8e6);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .auth-container {
            width: 420px;
            background: #ffffff;
            padding: 32px;
            border-radius: 22px;
            box-shadow: 0px 8px 32px rgba(0, 0, 0, 0.12), 0px 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .auth-container:hover {
            transform: scale(1.02);
            box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.15), 0px 4px 12px rgba(0, 0, 0, 0.08);
        }

        .app-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .app-logo {
            font-size: 48px;
            color: #2563eb;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            /* Biru */
        }

        .app-title {
            font-family: "Poppins", sans-serif;
            font-size: 24px;
            font-weight: 700;
            margin-top: 8px;
            color: #1e3a8a;
            letter-spacing: 0.8px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
        }

        .app-subtitle {
            font-size: 14px;
            font-weight: 500;
            margin-top: -4px;
            color: #64748b;
            letter-spacing: 0.4px;
            font-style: italic;
        }






        @keyframes gradientShift {
            0% {
                background-position: 0% 0%;
            }

            25% {
                background-position: 100% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            75% {
                background-position: 0% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">

        {{-- Header Logo + Nama Aplikasi --}}
        <div class="app-header">
            <i class="bi bi-journal-bookmark app-logo"></i>
            <div class="app-title">SI Magang IKP</div>
            <div class="app-subtitle">Magang Berdampak, Pelayanan Terbaik</div>
        </div>

        {{-- Halaman dinamis masuk ke sini --}}
        @yield('content')

    </div>
</body>

</html>
