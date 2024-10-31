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
                <label for="category">القسم</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="معالجات">معالجات</option>
                    <option value="بطاقات رسومية">بطاقات رسومية</option>
                    <option value="ذواكر RAM">ذواكر RAM</option>
                    <option value="لوحات أم">لوحات أم</option>
                    <option value="أقراص تخزين">أقراص تخزين</option>
                    <option value="مزودات طاقة">مزودات طاقة</option>
                    <option value="صناديق حاسوب">صناديق حاسوب</option>
                    <option value="مبردات">مبردات</option>
                    <option value="ماوس">ماوس</option>
                    <option value="كيبورد">كيبورد</option>
                </select>
            </div>

            <div class="form-group">
                <label for="discount_percentage">نسبة التخفيض (%)</label>
                <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" min="0" max="100">
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