<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المنتجات</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
            
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .product-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .input-group {
            max-width: 600px; 
            margin: auto; 
        }
        .form-control {
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }
        .btn-primary {
            
            border-radius: 20px; 
            background-color: #007bff; 
            transition: background-color 0.3s; 
        }
        .btn-primary:hover {
            background-color: #0056b3; 
        }
          .btn-primary {
            height: 38px;
            border-radius: 20px; 
            background-color: #007bff; 
            transition: background-color 0.3s; 
        }
  
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between mb-4">
            <h1>قائمة المنتجات</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">إضافة منتج جديد</a>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="ابحث عن منتج بواسطة الاسم" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">بحث</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered shadow-sm">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>صورة المنتج</th>
                    <th>اسم المنتج</th>
                    <th class="text-center">السعر</th>
                    <th class="text-center">القسم</th>
                    <th class="text-center">القسم الفرعي</th>
                    <th class="text-center">نسبة التخفيض</th>
                    <th class="text-center">متوفر</th>
                    <th class="text-center">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td class="text-center">
                            @if($product->image_path)
                                <img src="{{ asset($product->image_path) }}" alt="صورة المنتج" class="product-image">
                            @else
                                <span>لا توجد صورة</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ number_format($product->price) }} دينار عراقي</td>
                        <td class="text-center">{{ $product->category ?? 'غير محدد' }}</td>
                        <td class="text-center">{{ $product->subcategory ?? 'غير محدد' }}</td>
                        <td class="text-center">{{ $product->discount_percentage ? $product->discount_percentage . '%' : 'لا يوجد' }}</td>
                        <td class="text-center">{{ $product->available ? 'نعم' : 'لا' }}</td>
                        <td class="text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف المنتج؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </body>
    </html>