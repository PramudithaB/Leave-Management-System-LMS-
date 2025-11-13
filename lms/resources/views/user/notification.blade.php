<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body style="
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7f9;
    color: #2c3e50;
">

<div style="display: flex; min-height: 100vh;">

    <!-- Sidebar -->
    <aside style="
        width: 250px;
        background: linear-gradient(180deg, #2c3e50, #34495e);
        color: white;
        padding: 20px;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    ">
        <div style="
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        ">
            <h2 style="margin: 0; font-size: 22px;">User Dashboard</h2>
        </div>

        <nav style="flex: 1;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 10px;">
                    <a href="{{route('userdashboard')}}" style="
                        text-decoration: none;
                        color: white;
                        display: block;
                        padding: 12px 15px;
                        border-radius: 6px;
                        background-color: #3498db;
                        font-weight: 500;
                        transition: all 0.3s;
                    ">Dashboard</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href='{{route("user.notifications")}}' style="
                        text-decoration: none;
                        color: #ecf0f1;
                        display: block;
                        padding: 12px 15px;
                        border-radius: 6px;
                        transition: all 0.3s;
                    " onmouseover="this.style.backgroundColor='#3b4b59'" onmouseout="this.style.backgroundColor='transparent'">Notifications</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="{{route('profile.edit')}}" style="
                        text-decoration: none;
                        color: #ecf0f1;
                        display: block;
                        padding: 12px 15px;
                        border-radius: 6px;
                        transition: all 0.3s;
                    " onmouseover="this.style.backgroundColor='#3b4b59'" onmouseout="this.style.backgroundColor='transparent'">Settings</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href='{{route("user.createleave")}}' style="
                        text-decoration: none;
                        color: #ecf0f1;
                        display: block;
                        padding: 12px 15px;
                        border-radius: 6px;
                        transition: all 0.3s;
                    " onmouseover="this.style.backgroundColor='#3b4b59'" onmouseout="this.style.backgroundColor='transparent'">Apply Leaves</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main style="flex: 1; padding: 40px;">
        <h2 style="font-size: 28px; margin-bottom: 20px;">Your Leave Notifications</h2>

        @if($notifications->isEmpty())
            <div style="
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                text-align: center;
                color: #7f8c8d;
            ">
                <p>No leave updates yet.</p>
            </div>
        @else
            <div style="
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                overflow-x: auto;
            ">
                <table style="
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 15px;
                ">
                    <thead>
                        <tr style="background-color: #3498db; color: white; text-align: left;">
                            <th style="padding: 12px;">Title</th>
                            <th style="padding: 12px;">Message</th>
                            <th style="padding: 12px;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $note)
                            <tr style="border-bottom: 1px solid #ecf0f1;">
                                <td style="padding: 10px;">{{ $note->title }}</td>
                                <td style="padding: 10px;">{{ $note->message }}</td>
                                <td style="padding: 10px; color: #7f8c8d;">{{ $note->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

</div>
</body>
</html>
