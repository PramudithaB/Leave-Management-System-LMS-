<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>

<div style="
    display: flex; 
    min-height: 100vh; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    background-color: #f4f7f9;
">

    <aside style="
        width: 250px; 
        background-color: #2c3e50; 
        color: white; 
        padding: 20px; 
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    ">
        <div style="
            text-align: center; 
            margin-bottom: 30px; 
            padding-bottom: 15px; 
            border-bottom: 1px solid #34495e;
        ">
            <h3 style="margin: 0;">User Dashboard</h3>
        </div>
        <nav>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 10px;">
                    <a href="#" style="
                        text-decoration: none; 
                        color: white; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                        background-color: #3498db; /* Active Link */
                    ">🏠 Dashboard</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="#" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                    " onmouseover="this.style.backgroundColor='#34495e'" onmouseout="this.style.backgroundColor='transparent'">👤 Profile</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="#" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px;
                    " onmouseover="this.style.backgroundColor='#34495e'" onmouseout="this.style.backgroundColor='transparent'">⚙️ Settings</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="{{route('user.createleave')}}" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px;
                    " onmouseover="this.style.backgroundColor='#34495e'" onmouseout="this.style.backgroundColor='transparent'">✉️ Apply Leaves</a>
                </li>
            </ul>
        </nav>
    </aside>

    <main style="
        flex-grow: 1; 
        padding: 30px;
    ">
    <header style="
    background-color: white; 
    padding: 15px 20px; 
    border-radius: 8px; 
    margin-bottom: 30px; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); 
    display: flex; 
    justify-content: space-between; 
    align-items: center;
">
    @auth
        <h1 style="margin: 0; font-size: 24px; color: #333;">Welcome Back, {{ Auth::user()->name }}</h1>
    @else
        <h1 style="margin: 0; font-size: 24px; color: #333;">Welcome to the site!</h1>
    @endauth
    <div style="font-weight: bold; color: #7f8c8d;">
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;padding:0;margin:0;color:#3498db;cursor:pointer;text-decoration:underline;font: inherit;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="text-decoration: none; color: #3498db;">Login</a>
        @endauth
    </div>
</header>


        <div style="
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 20px;
        ">

            <div style="
                background-color: white; 
                padding: 20px; 
                border-radius: 8px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                border-left: 5px solid #e74c3c;
            ">
                <h3 style="margin-top: 0; color: #e74c3c;">Pending Tasks</h3>
                <p style="font-size: 32px; font-weight: bold; margin: 5px 0 10px; color: #333;">5</p>
                <p style="color: #7f8c8d;">Action required today</p>
            </div>

            <div style="
                background-color: white; 
                padding: 20px; 
                border-radius: 8px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                border-left: 5px solid #f39c12;
            ">
                <h3 style="margin-top: 0; color: #f39c12;">New Messages</h3>
                <p style="font-size: 32px; font-weight: bold; margin: 5px 0 10px; color: #333;">3</p>
                <p style="color: #7f8c8d;">Unread in your inbox</p>
            </div>

            <div style="
                background-color: white; 
                padding: 20px; 
                border-radius: 8px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
                border-left: 5px solid #2ecc71;
            ">
                <h3 style="margin-top: 0; color: #2ecc71;">Project Progress</h3>
                <p style="font-size: 32px; font-weight: bold; margin: 5px 0 10px; color: #333;">85%</p>
                <p style="color: #7f8c8d;">Target completion</p>
            </div>
        </div>

 <table style="
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 20px;
">
    <thead>
        <tr style="background-color: #3498db; color: white; text-align: left;">
            <th style="padding: 10px; border: 1px solid #ddd;">Leave Type</th>
            <th style="padding: 10px; border: 1px solid #ddd;">From Date</th>
            <th style="padding: 10px; border: 1px solid #ddd;">To Date</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Reason</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Status</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Actions</th> <!-- Added Actions column -->
        </tr>
    </thead>
    <tbody>
        @foreach($leave as $leave)
        <tr style="background-color: #fff; border-bottom: 1px solid #ddd;">
            <td style="padding: 10px; border: 1px solid #ddd;">{{ ucfirst($leave->leave_type) }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $leave->reason }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                <!-- Display buttons with different colors based on the status -->
                @if($leave->status == 'approved')
                    <button style="
                        padding: 5px 10px;
                        background-color: green;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 14px;
                    ">
                        Approved
                    </button>
                @elseif($leave->status == 'rejected')
                    <button style="
                        padding: 5px 10px;
                        background-color: red;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 14px;
                    ">
                        Rejected
                    </button>
                @elseif($leave->status == 'pending')
                    <button style="
                        padding: 5px 10px;
                        background-color: yellow;
                        color: black;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 14px;
                    ">
                        Pending
                    </button>
                @endif
            </td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                <!-- Add delete button here, as we discussed before -->
                <form action="{{ route('user.leave.delete', $leave->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="
                        padding: 5px 10px;
                        background-color: #e74c3c;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 14px;
                    " onmouseover="this.style.backgroundColor='#c0392b'" onmouseout="this.style.backgroundColor='#e74c3c'">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


    </main>
</div>

</body>
</html>