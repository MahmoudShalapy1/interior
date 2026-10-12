import urllib.request
import re

base_url = "http://interior.local"

def test_url(path, headers=None):
    url = base_url + path
    req = urllib.request.Request(url, headers=headers or {})
    try:
        with urllib.request.urlopen(req, timeout=10) as resp:
            content = resp.read().decode('utf-8', errors='ignore')
            return resp.status, content
    except Exception as e:
        return 500, str(e)

print("=== 1. Testing Default Arabic Homepage ===")
status, html = test_url('/')
print(f"Status: {status}")
html_tag = re.search(r'<html[^>]*>', html)
print(f"HTML tag: {html_tag.group(0) if html_tag else 'Not found'}")
has_switcher = 'luxe-lang-switcher' in html
print(f"Has Language Switcher: {has_switcher}")

print("\n=== 2. Testing English Mode (?lang=en) ===")
status_en, html_en = test_url('/?lang=en')
print(f"Status: {status_en}")
html_tag_en = re.search(r'<html[^>]*>', html_en)
print(f"HTML tag (EN): {html_tag_en.group(0) if html_tag_en else 'Not found'}")

print("\n=== 3. Testing Subpages ===")
subpages = ['/about', '/services', '/approach', '/projects', '/contact', '/404']
for sp in subpages:
    st, page_html = test_url(sp)
    sw = 'luxe-lang-switcher' in page_html
    print(f"Page {sp}: Status {st}, Switcher: {sw}")
