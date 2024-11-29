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
                <label for="category">القسم الرئيسي</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Laptops" {{ $product->category == 'Laptops' ? 'selected' : '' }}>Laptops</option>
                    <option value="PC Components" {{ $product->category == 'PC Components' ? 'selected' : '' }}>PC Components</option>
                    <option value="Mouses" {{ $product->category == 'Mouses' ? 'selected' : '' }}>Mouses</option>
                    <option value="Keyboards" {{ $product->category == 'Keyboards' ? 'selected' : '' }}>Keyboards</option>
         
                </select>
            </div>
            
            <div class="form-group">
                <label for="subcategory">القسم الفرعي</label>
                <input type="text" name="subcategory" id="subcategory" class="form-control" value="{{ $product->subcategory }}" placeholder="اكتب القسم الفرعي هنا">
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