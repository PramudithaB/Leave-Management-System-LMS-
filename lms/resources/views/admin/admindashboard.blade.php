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
            <h3 style="margin: 0;">Admin Dashboard</h3>
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
                    <a href="{{route('admin.allusers')}}" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                    " onmouseover="this.style.backgroundColor='#34495e'" onmouseout="this.style.backgroundColor='transparent'">👤 All Users</a>
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
                    <a href="{{route('admin.leave.stats')}}" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px;
                    " onmouseover="this.style.backgroundColor='#34495e'" onmouseout="this.style.backgroundColor='transparent'">Reports</a>
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
<!-- Manager Assignment Section -->
<!-- Manager Assignment Section -->
@if(!session('success'))
<div style="
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    margin-top: 30px;
">
    <h2 style="margin-top:0; color:#2c3e50;">Assign Manager to Users</h2>

    @if(session('error'))
        <p style="color:red; font-weight:bold;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('admin.assign.manager') }}" method="POST">
        @csrf
        <label for="manager_id" style="font-weight:bold;">Select Manager:</label><br>
        <select name="manager_id" required style="padding:8px; width:250px; border-radius:5px; margin:8px 0;">
            <option value="">-- Choose Manager --</option>
            @foreach($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }} ({{ $manager->email }})</option>
            @endforeach
        </select>

        <h3 style="margin-top:15px; color:#2c3e50;">Select Users to Assign</h3>
        <table style="width:100%; border-collapse:collapse; margin-top:10px;">
            <thead>
                <tr style="background:#3498db; color:white;">
                    <th style="padding:10px;">Select</th>
                    <th style="padding:10px;">User Name</th>
                    <th style="padding:10px;">Email</th>
                    <th style="padding:10px;">Current Manager</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="text-align:center;">
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                        </td>
                        <td style="padding:8px;">{{ $user->name }}</td>
                        <td style="padding:8px;">{{ $user->email }}</td>
                        <td style="padding:8px;">{{ $user->manager ? $user->manager->name : 'None' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" style="
            background:#27ae60;
            color:white;
            border:none;
            border-radius:5px;
            padding:10px 20px;
            margin-top:15px;
            cursor:pointer;
        ">Assign Manager</button>
    </form>
</div>
@endif

<!-- Manager Summary Section -->
<!-- Manager Summary Section -->
<div style="
    background-color:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    margin-top:30px;
">
    <h2 style="margin-top:0; color:#2c3e50;">Manager → Team Summary</h2>

    @if(session('success'))
        <p style="color:green; font-weight:bold;">{{ session('success') }}</p>
    @endif

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead>
            <tr style="background:#2c3e50; color:white;">
                <th style="padding:10px;">Manager Name</th>
                <th style="padding:10px;">Team Members</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $manager->name }}</td>
                    <td style="padding:10px;">
                        @php
                            $team = $users->where('manager_id', $manager->id);
                        @endphp
                        @if($team->isEmpty())
                            <span style="color:gray;">No team members assigned</span>
                        @else
                            {{ $team->pluck('name')->implode(', ') }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        

          
        </div>