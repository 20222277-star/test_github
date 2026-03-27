<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
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
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
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
        .btn-submit {
            background-color: #007bff;
            color: white;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Chỉnh sửa sinh viên</h1>
        
        @if($student)
            <form method="POST" action="/students/{{ $student->id }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Tên sinh viên:</label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $student->name) }}" placeholder="Nhập tên sinh viên">
                    @if($errors->has('name'))
                        <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                            ❌ {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="major">Ngành học:</label>
                    <input type="text" id="major" name="major" required value="{{ old('major', $student->major) }}" placeholder="Nhập ngành học">
                    @if($errors->has('major'))
                        <div style="color: #dc3545; font-size: 13px; margin-top: 5px;">
                            ❌ {{ $errors->first('major') }}
                        </div>
                    @endif
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-submit">✓ Cập nhật</button>
                    <a href="/students" class="btn btn-cancel">✕ Hủy</a>
                </div>
            </form>
        @else
            <p style="text-align: center; color: #999;">Không tìm thấy sinh viên.</p>
            <div class="btn-group">
                <a href="/students" class="btn btn-cancel">← Quay lại</a>
            </div>
        @endif
    </div>
</body>
</html>
