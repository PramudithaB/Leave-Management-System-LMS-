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
                    <a href="{{route('admindashboard')}}" style="
                        text-decoration: none; 
                        color: white; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                    ">🏠 Dashboard</a>
                </li>
                <li style="margin-bottom: 10px;">
                    <a href="{{route('admin.allusers')}}" style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                                                background-color: #3498db; /* Active Link */

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
        <h1 style="margin: 0; font-size: 24px; color: #333;">All Users</h1>
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

        

          
        </div> <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined On</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->usertype) }}</td>
                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>