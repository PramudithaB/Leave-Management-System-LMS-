<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leave Application Form</title>
</head>

<body>
    <div
        style="
    display: flex; 
    min-height: 100vh; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    background-color: #f4f7f9;
">

        <aside
            style="
        width: 250px; 
        background-color: #2c3e50; 
        color: white; 
        padding: 20px; 
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    ">
            <div
                style="
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
                        <a href="{{ route('userdashboard') }}"
                            style="
                        text-decoration: none; 
                        color: white; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                        background-color: #3498db; /* Active Link */
                    ">🏠
                            Dashboard</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="#"
                            style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px; 
                    "
                            onmouseover="this.style.backgroundColor='#34495e'"
                            onmouseout="this.style.backgroundColor='transparent'">👤 Profile</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="#"
                            style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px;
                    "
                            onmouseover="this.style.backgroundColor='#34495e'"
                            onmouseout="this.style.backgroundColor='transparent'">⚙️ Settings</a>
                    </li>
                    <li style="margin-bottom: 10px;">
                        <a href="{{ route('user.createleave') }}"
                            style="
                        text-decoration: none; 
                        color: #bdc3c7; 
                        display: block; 
                        padding: 10px 15px; 
                        border-radius: 4px;
                    "
                            onmouseover="this.style.backgroundColor='#34495e'"
                            onmouseout="this.style.backgroundColor='transparent'">✉️ Apply Leaves</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main style="
        flex-grow: 1; 
        padding: 30px;
    ">
            <header
                style="
            background-color: white; 
            padding: 15px 20px; 
            border-radius: 8px; 
            margin-bottom: 30px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
        ">
                <h1 style="margin: 0; font-size: 24px; color: #333;">Welcome Back, John Doe!</h1>
                <div style="font-weight: bold; color: #7f8c8d;">
                    <a href="#" style="text-decoration: none; color: #3498db;">Logout</a>
                </div>
            </header>
            <div
                style="
    width: 400px; 
    margin: 50px auto; 
    padding: 20px; 
    border: 1px solid #ccc; 
    border-radius: 8px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    font-family: Arial, sans-serif;
">

                <h2 style="
        text-align: center; 
        color: #333; 
        margin-bottom: 20px;
    ">Leave
                    Application</h2>

                <form action="{{ route('user.storeleave') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label for="leave_type"
                            style="
                display: block; 
                margin-bottom: 5px; 
                font-weight: bold; 
                color: #555;
            ">Select
                            Leave Type:</label>
                        <select id="leave_type" name="leave_type" required
                            style="
                width: 100%; 
                padding: 10px; 
                border: 1px solid #ddd; 
                border-radius: 4px; 
                box-sizing: border-box; 
                background-color: #f9f9f9;
            ">
                            <option value="" disabled selected>-- Choose Type --</option>
                            <option value="annual">Annual Leave</option>
                            <option value="sick">Sick Leave</option>
                            <option value="casual">Casual Leave</option>
                            <option value="paternity">Paternity Leave</option>
                            <option value="maternity">Maternity Leave</option>
                            <option value="unpaid">Unpaid Leave</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="from_date"
                            style="
                display: block; 
                margin-bottom: 5px; 
                font-weight: bold; 
                color: #555;
            ">From
                            Date:</label>
                        <input type="date" id="from_date" name="from_date" required
                            style="
                width: 100%; 
                padding: 10px; 
                border: 1px solid #ddd; 
                border-radius: 4px; 
                box-sizing: border-box;
            ">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="to_date"
                            style="
                display: block; 
                margin-bottom: 5px; 
                font-weight: bold; 
                color: #555;
            ">To
                            Date:</label>
                        <input type="date" id="to_date" name="to_date" required
                            style="
                width: 100%; 
                padding: 10px; 
                border: 1px solid #ddd; 
                border-radius: 4px; 
                box-sizing: border-box;
            ">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="reason"
                            style="
                display: block; 
                margin-bottom: 5px; 
                font-weight: bold; 
                color: #555;
            ">Reason
                            for Leave:</label>
                        <textarea id="reason" name="reason" rows="4" required
                            style="
                width: 100%; 
                padding: 10px; 
                border: 1px solid #ddd; 
                border-radius: 4px; 
                box-sizing: border-box; 
                resize: vertical;
            "
                            placeholder="Briefly describe the reason for your leave..."></textarea>
                    </div>

                    <button type="submit"
                        style="
            width: 100%; 
            padding: 10px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            font-size: 16px; 
            cursor: pointer; 
            transition: background-color 0.3s;
        "
                        onmouseover="this.style.backgroundColor='#0056b3'"
                        onmouseout="this.style.backgroundColor='#007bff'">
                        Submit Application
                    </button>

                </form>
            </div>

</body>

</html>
