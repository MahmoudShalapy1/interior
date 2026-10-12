import urllib.request
import urllib.error

base_url = "http://interior.local/non-existent-page-slug-404"
try:
    urllib.request.urlopen(base_url)
except urllib.error.HTTPError as e:
    print(f"HTTP Status: {e.code}")
    body = e.read().decode('utf-8', errors='ignore')
    print("Has Language Switcher:", "luxe-lang-switcher" in body)
    print("Has 404 Content:", "٤٠٤" in body or "404" in body)
