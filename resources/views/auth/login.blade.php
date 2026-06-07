<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تسجيل الدخول | لوحة تحكم Bio-Graphene</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="login-wrap">
  <div class="login-card">
    <img src="{{ asset('images/logo-full.png') }}" alt="Bio-Graphene" class="login-logo">
    <p class="cap">لوحة التحكم — تسجيل الدخول</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <label for="email">البريد الإلكتروني</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="admin@biographene.local" required autofocus>
        @error('email')<div class="err">{{ $message }}</div>@enderror
      </div>
      <div class="field">
        <label for="password">كلمة المرور</label>
        <input id="password" name="password" type="password" placeholder="••••••••" required>
      </div>
      <label class="check" style="margin-bottom:20px">
        <input type="checkbox" name="remember"> تذكّرني
      </label>
      <button class="btn btn-grad" style="width:100%;justify-content:center" type="submit">دخول</button>
    </form>
  </div>
</div>
</body>
</html>
