<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FreelanceFeed</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            background: #eeeeee;
        }

        .installation {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .logo {
            color: #1976d2;
            text-shadow: #1976d2 0px 0px 1px;
            filter: drop-shadow(#1976d2 0px 0px 10px);
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
        }

        .form-container label {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-container input {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
        }

        .form-container button {
            margin-top: 1rem;
            background-color: #1976d2;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #1565c0;
        }

        .error {
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="installation">
        <img src="https://i.gyazo.com/04045c5640fa9c3a86170136f554b51a.png" width="150" class="logo">
        <h2 class="text-center">Installation</h2>
        @if (!$isWritable)
            <p class="error">The .env file is not writable. Please check the file permissions.</p>
            @if ($permissionRecommendation)
                <p>{!! $permissionRecommendation !!}</p>
            @endif
        @endif
        @if (count($missingExtensions) > 0)
            <p>The following PHP extensions are requireduired but not installed:
                {{ implode(', ', $missingExtensions) }}</p>
        @endif
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($isWritable && count($missingExtensions) == 0)
            <form action="{{ route('install.process') }}" method="post" class="form-container">
                @csrf
                <div>
                    <label>App Name</label>
                    <input name="app_name" type="text" required placeholder="My name Portfolio">
                </div>
                <div>
                    <label>App url (frontend)</label>
                    <input name="app_spa_url" type="text" required placeholder="My name Portfolio">
                </div>
                <div>
                    <label>DB Host</label>
                    <input name="db_host" type="text" required placeholder="0.0.0.0">
                </div>
                <div>
                    <label>DB Port</label>
                    <input name="db_port" type="text" required placeholder="3306">
                </div>
                <div>
                    <label for="db_database">DB Database</label>
                    <input name="db_database" type="text" required placeholder="myportfolio">
                </div>
                <div>
                    <label for="db_username">DB Username</label>
                    <input name="db_username" type="text" required placeholder="root">
                </div>
                <div>
                    <label>DB Password</label>
                    <input name="db_password" required>
                </div>
                <div style="padding-top: 40px">
                    <label>Admin Name</label>
                    <input name="admin_name" required>
                </div>
                <div>
                    <label>Admin Password</label>
                    <input name="admin_password" required>
                </div>
                <div>
                    <label>Admin Email</label>
                    <input name="admin_email" required type="email">
                </div>
                <button type="submit">Install</button>
            </form>
        @endif
    </div>
</body>

</html>
