<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        .info-group {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 3px solid #007bff;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
            font-size: 16px;
        }
        .btn-group {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            flex: 1;
            text-align: center;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👤 Chi tiết sinh viên</h1>
        
        @if($student)
            <div class="info-group">
                <div class="info-label">ID:</div>
                <div class="info-value">{{ $student->id }}</div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Tên:</div>
                <div class="info-value">{{ $student->name }}</div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Ngành học:</div>
                <div class="info-value">{{ $student->major }}</div>
            </div>
            
            <div class="btn-group">
                <a href="/students" class="btn btn-back">← Quay lại</a>
            </div>
        @else
            <p style="text-align: center; color: #999;">Không tìm thấy sinh viên.</p>
            <div class="btn-group">
                <a href="/students" class="btn btn-back">← Quay lại</a>
            </div>
        @endif
    </div>
</body>
</html>
