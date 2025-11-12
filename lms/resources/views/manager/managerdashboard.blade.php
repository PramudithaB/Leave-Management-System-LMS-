<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    </head>
<body>
   
</body>
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
            <h3 style="margin: 0;">Manager Dashboard</h3>
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
                    <a href="" style="
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
    <main style="flex-grow: 1; padding: 20px;"> 
        <h2 style="color: #34495e; margin-top: 0; margin-bottom: 20px;">Leave Applications</h2>
        <table style="
            width: 100%; 
            border-collapse: collapse; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            background-color: white; 
            border-radius: 8px; 
            overflow: hidden; /* Important for border-radius on table */
        ">
            <thead style="background-color: #3498db; color: white;">
                <tr>
                    <th style="padding: 12px 15px; text-align: left;">Employee Name</th>
                    <th style="padding: 12px 15px; text-align: left;">Leave Type</th>
                    <th style="padding: 12px 15px; text-align: left;">From Date</th>
                    <th style="padding: 12px 15px; text-align: left;">To Date</th>
                    <th style="padding: 12px 15px; text-align: left;">Reason</th>
                    <th style="padding: 12px 15px; text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                    <tr style="border-bottom: 1px solid #ecf0f1;">
                        <td style="padding: 10px 15px;">{{ $leave->user ? $leave->user->name : 'Unknown User' }}</td>
                        <td style="padding: 10px 15px;">{{ ucfirst($leave->leave_type) }}</td>
                        <td style="padding: 10px 15px;">{{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}</td>
                        <td style="padding: 10px 15px;">{{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}</td>
                        <td style="padding: 10px 15px; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $leave->reason }}</td>
                        <td style="padding: 10px 15px; text-align: center;">
                            <span style="
                                display: inline-block; 
                                padding: 5px 10px; 
                                border-radius: 12px; 
                                font-size: 12px; 
                                font-weight: bold;
                                {{ $leave->status == 'approved' ? 'background-color: #2ecc71; color: white;' : '' }}
                                {{ $leave->status == 'pending' ? 'background-color: #f1c40f; color: #333;' : '' }}
                                {{ $leave->status == 'rejected' ? 'background-color: #e74c3c; color: white;' : '' }}
                                {{ $leave->status != 'approved' && $leave->status != 'pending' && $leave->status != 'rejected' ? 'background-color: #bdc3c7; color: #333;' : '' }}
                            ">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr style="border-bottom: 1px solid #ecf0f1; background-color: #f9f9f9;">
                    <td colspan="6" style="text-align: center; padding: 15px; color: #7f8c8d;">
                        No more leaves to display.
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</div>
</html>