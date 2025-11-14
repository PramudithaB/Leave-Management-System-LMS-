<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' />
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js'></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #2c3e50;
        }

        header {
            background-color: white;
            padding: 15px 25px;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
            color: #2c3e50;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #3498db;
            font-weight: bold;
            cursor: pointer;
            text-decoration: underline;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        aside {
            width: 250px;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        aside h3 {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
            font-size: 20px;
        }

        aside a {
            text-decoration: none;
            display: block;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            transition: all 0.3s;
            color: #ecf0f1;
        }

        aside a:hover {
            background-color: #3b4b59;
        }

        aside a.active {
            background-color: #3498db;
            color: white;
            font-weight: 500;
        }

        main {
            flex: 1;
            padding: 30px 40px;
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table thead {
            background-color: #3498db;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        textarea {
            width: 100%;
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 5px;
            resize: vertical;
        }

        .approve-btn, .reject-btn {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-weight: 500;
            margin-right: 5px;
        }

        .approve-btn {
            background-color: #27ae60;
        }

        .reject-btn {
            background-color: #e74c3c;
        }

        #calendar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-top: 20px;
        }

        /* Toast Notification */
        #toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #27ae60;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 12px;
            position: fixed;
            bottom: 30px;
            right: 30px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        #toast.show {
            visibility: visible;
            animation: fadeInOut 3s;
        }

        @keyframes fadeInOut {
            0% {opacity: 0;}
            10% {opacity: 1;}
            90% {opacity: 1;}
            100% {opacity: 0;}
        }

        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            aside {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                white-space: nowrap;
            }

            main {
                padding: 20px;
            }

            aside a {
                display: inline-block;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    @auth
        <h1>Welcome Back, {{ Auth::user()->name }}</h1>
    @else
        <h1>Welcome to the site!</h1>
    @endauth

    <div>
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" style="color:#3498db;font-weight:bold;">Login</a>
        @endauth
    </div>
</header>

<div class="layout">

    <!-- Sidebar -->
    <aside>
        <h3>Manager Dashboard</h3>
        <a href="#" class="active">Dashboard</a>
        <a href="{{route('manager.users')}}">All Users</a>
        <a href="{{route('profile.edit')}}">Settings</a>
        <a href="">Apply Leaves</a>
    </aside>

    <!-- Main Section -->
    <main>
        <h2>Employee Leave Requests</h2>

        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->user->name ?? 'Unknown' }}</td>
                    <td>{{ ucfirst($leave->leave_type) }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->from_date)->format('d M, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->to_date)->format('d M, Y') }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>
                        @if($leave->status == 'approved')
                            <span style="color:green;font-weight:bold;">Approved</span>
                        @elseif($leave->status == 'rejected')
                            <span style="color:red;font-weight:bold;">Rejected</span>
                        @else
                            <span style="color:orange;">Pending</span>
                        @endif
                    </td>
                    <td>{{ $leave->remarks ?? '—' }}</td>
                    <td>
                        <form action="{{ route('manager.leave.update', $leave->id) }}" method="POST">
                            @csrf
                            <textarea name="remarks" rows="2" placeholder="Enter remarks..."></textarea><br>
                            <button type="submit" name="status" value="approved" class="approve-btn">Approve</button>
                            <button type="submit" name="status" value="rejected" class="reject-btn">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Calendar -->
        <h2>📅 Team Leave Calendar</h2>
        <div id="calendar"></div>

        <!-- Team Members -->
        <h2 style="margin-top:40px;">Your Assigned Members</h2>

        @if($teamMembers->isEmpty())
            <p style="color:gray;">No members assigned to you yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Email</th>
                        <th>Joined On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamMembers as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->created_at->format('d M, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
</div>

<!-- Toast -->
<div id="toast">{{ session('success') }}</div>

<script>
@if(session('success'))
    var toast = document.getElementById("toast");
    toast.className = "show";
    setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
@endif

// FullCalendar setup
document.addEventListener('DOMContentLoaded', function() {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        height: 600,
        events: '{{ route('manager.team.leaves') }}',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }
    });
    calendar.render();
});
</script>

</body>
</html>
