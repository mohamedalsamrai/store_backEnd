<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إضافة منتج جديد</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f9fc;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

/* Container styling */
.container {
    width: 100%;
    max-width: 500px;
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #007bff;
    font-size: 1.8rem;
}

/* Form styling */
.form-group {
    margin-bottom: 1rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="file"],
textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

button {
    width: 100%;
    padding: 0.8rem;
    border: none;
    background-color: #007bff;
    color: #fff;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Placeholder styling for file input */
input[type="file"]::file-selector-button {
    padding: 0.5rem 1rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="file"]::file-selector-button:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>
<div class="container">
    <h2>إضافة منتج جديد</h2>
    <form action="{{ route('products.store') }}"method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">اسم المنتج:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">السعر:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">الوصف:</label>
            <input type="text" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="image">صورة المنتج:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <button type="submit">إضافة المنتج</button>
    </form>
</div>
</body>
</html>