<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .header-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .search-box {
            flex: 1;
            min-width: 200px;
            display: flex;
            gap: 10px;
        }
        .search-box input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
        }
        .search-box button {
            padding: 10px 20px;
            background-color: #17a2b8;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-add {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            display: inline-block;
        }
        .alert-success {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #007bff;
            color: white;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-edit {
            background-color: #ffc107;
            color: black;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .pagination {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
            align-items: center;
        }
        .pagination a, .pagination span {
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-decoration: none;
            color: #007bff;
            font-size: 13px;
            min-width: auto;
            display: inline-block;
        }
        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
        .pagination .active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination .disabled span {
            color: #999;
            cursor: not-allowed;
            border-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Danh sách sinh viên</h1>
        
        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        
        <div class="header-actions">
            <a href="/students/create" class="btn-add">+ Tạo sinh viên mới</a>
            <form method="GET" action="/students" class="search-box">
                <input type="text" name="search" placeholder="Tìm theo tên hoặc ngành học..." value="{{ $search ?? '' }}">
                <button type="submit">🔍 Tìm kiếm</button>
                @if($search)
                    <a href="/students" style="padding: 10px 15px; background-color: #6c757d; color: white; border-radius: 3px; text-decoration: none;">✕ Xóa</a>
                @endif
            </form>
        </div>
        
        @if($students->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Ngành học</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->major }}</td>
                            <td>
                                <div class="actions">
                                    <a href="/students/{{ $student->id }}" class="btn btn-primary">Xem</a>
                                    <a href="/students/{{ $student->id }}/edit" class="btn btn-edit">Sửa</a>
                                    <form method="POST" action="/students/{{ $student->id }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="pagination">
                {{ $students->links() }}
            </div>
        @else
            <div class="no-data">
                <p>Không có sinh viên nào trong danh sách.</p>
            </div>
        @endif
    </div>
</body>
</html>
    </div>
</body>
</html>
