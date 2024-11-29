<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
        }
        .btn-custom:hover {
            background-color: #e0a800;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container my-5 p-4 bg-white rounded shadow-sm">
        <h2 class="mb-4">إضافة منتج جديد</h2>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">اسم المنتج</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div

 class="form-group">
                <label for="price">السعر</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="detail">الوصف</label>
                <textarea name="detail" id="detail" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="category">القسم الرئيسي</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Laptops">Laptops</option>
                    <option value="PC Components">PC Components</option>
                    <option value="Mouses">Mouses</option>
                    <option value="Keyboards">Keyboards</option>
                   
                    
                </select>
            </div>
            
           
            <div class="form-group">
                <label for="subcategory">القسم الفرعي</label>
                <input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="اكتب القسم الفرعي هنا">
            </div>
                </select>
            </div>
            <input type="hidden" name="available" value="1">

            <div class="form-group">
                <label for="image_path">صورة المنتج</label>
                <input type="file" name="image_path" id="image_path" class="form-control-file" required>
            </div>

            <button type="submit" class="btn btn-custom">إضافة المنتج</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</body>
</html>