<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتج</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
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
        <h1 class="mb-4">تعديل المنتج: {{ $product->name }}</h1>
        
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">اسم المنتج</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="price">السعر</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="detail">الوصف</label>
                <textarea name="detail" id="detail" class="form-control" rows="3">{{ $product->detail }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">القسم</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="معالجات" {{ $product->category == 'معالجات' ? 'selected' : '' }}>معالجات</option>
                    <option value="بطاقات رسومية" {{ $product->category == 'بطاقات رسومية' ? 'selected' : '' }}>بطاقات رسومية</option>
                    <option value="ذواكر RAM" {{ $product->category == 'ذواكر RAM' ? 'selected' : '' }}>ذواكر RAM</option>
                    <option value="لوحات أم" {{ $product->category == 'لوحات أم' ? 'selected' : '' }}>لوحات أم</option>
                    <option value="أقراص تخزين" {{ $product->category == 'أقراص تخزين' ? 'selected' : '' }}>أقراص تخزين</option>
                    <option value="مزودات طاقة" {{ $product->category == 'مزودات طاقة' ? 'selected' : '' }}>مزودات طاقة</option>
                    <option value="صناديق حاسوب" {{ $product->category == 'صناديق حاسوب' ? 'selected' : '' }}>صناديق حاسوب</option>
                    <option value="مبردات" {{ $product->category == 'مبردات' ? 'selected' : '' }}>مبردات</option>
                    <option value="ماوس" {{ $product->category == 'ماوس' ? 'selected' : '' }}>ماوس</option>
                    <option value="كيبورد" {{ $product->category == 'كيبورد' ? 'selected' : '' }}>كيبورد</option>
                </select>
            </div>

            <div class="form-group">
                <label for="discount_percentage">نسبة التخفيض (%)</label>
                <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" value="{{ $product->discount_percentage }}" min="0" max="100">
            </div>

            <div class="form-group">
                <label for="available">متوفر</label>
                <select name="available" id="available" class="form-control" required>
                    <option value="1" {{ $product->available ? 'selected' : '' }}>نعم</option>
                    <option value="0" {{ !$product->available ? 'selected' : '' }}>لا</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image_path">صورة المنتج</label>
                <input type="file" name="image_path" id="image_path" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-custom">تحديث المنتج</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</body>
</html>