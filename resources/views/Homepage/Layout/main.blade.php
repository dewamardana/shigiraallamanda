<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" />
</head>

<body class="bg-gray-200">
  @include('Homepage.Layout.header')
  @yield('content')
  @include('Homepage.Layout.footer')

  @yield('script')
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script>
    feather.replace();
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const localeMap = {
        en: {
          flag: 'us',
        },
        id: {
          flag: 'id',
        },
        ja: {
          flag: 'jp',
        },
        km: {
          flag: 'kh',
        },
        my: {
          flag: 'mm',
        },
        vi: {
          flag: 'vn',
        },
      };

      const toggleBtn = document.getElementById("language-toggle-btn");
      const currentLocale = toggleBtn.dataset.locale || 'en';
      const lang = localeMap[currentLocale] || localeMap['en'];

      const flagIcon = toggleBtn.querySelector(".fi");
      const labelSpan = document.getElementById("language-label");

      flagIcon.className = `fi fi-${lang.flag}`;
      labelSpan.textContent = lang.label;

      // Optional: Tandai pilihan aktif di dropdown
      document.querySelectorAll('[data-locale-option]').forEach(btn => {
        if (btn.dataset.localeOption === currentLocale) {
          btn.classList.add('font-bold', 'bg-teal-1000');
        }
      });
    });

    function changeLanguage(locale) {
      window.location.href = '/lang/' + locale;
    }
  </script>
</body>

</html>
