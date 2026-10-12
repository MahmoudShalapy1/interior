import urllib.request
import re
from html.parser import HTMLParser
import json

with open('en_dictionary.json', 'r', encoding='utf-8') as f:
    en_dict = json.load(f)

arabic_char_re = re.compile(r'[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]')

class AccurateI18nAuditor(HTMLParser):
    def __init__(self):
        super().__init__()
        self.tag_stack = []
        self.i18n_depth = 0
        self.in_script_style = False
        self.untranslated_arabic = []

    def handle_starttag(self, tag, attrs):
        attr_dict = dict(attrs)
        if tag in ('script', 'style'):
            self.in_script_style = True
            return

        has_i18n = 'data-i18n' in attr_dict
        if has_i18n:
            self.i18n_depth += 1

        self.tag_stack.append((tag, has_i18n))

    def handle_endtag(self, tag):
        if tag in ('script', 'style'):
            self.in_script_style = False
            return

        if self.tag_stack:
            t, has_i18n = self.tag_stack.pop()
            if has_i18n:
                self.i18n_depth -= 1

    def handle_data(self, data):
        if self.in_script_style:
            return

        clean = data.strip()
        if not clean:
            return

        # If we are NOT inside a data-i18n element, check if text has Arabic
        if self.i18n_depth == 0:
            if arabic_char_re.search(clean):
                self.untranslated_arabic.append(clean)

pages = [
    ('/', 'Home'),
    ('/about', 'About'),
    ('/services', 'Services'),
    ('/approach', 'Approach'),
    ('/projects', 'Projects'),
    ('/contact', 'Contact'),
]

results = []
for path, name in pages:
    url = f"http://interior.local{path}"
    with urllib.request.urlopen(url) as resp:
        html = resp.read().decode('utf-8', errors='ignore')

    auditor = AccurateI18nAuditor()
    auditor.feed(html)
    results.append(f"\nPage: {name} ({path})")
    results.append(f"  Untranslated Arabic text nodes (outside data-i18n): {len(auditor.untranslated_arabic)}")
    if auditor.untranslated_arabic:
        for ut in auditor.untranslated_arabic[:10]:
            results.append(f"    ! '{ut[:80]}'")

with open('dom_audit_results.txt', 'w', encoding='utf-8') as out:
    out.write('\n'.join(results))

print("Audit written to dom_audit_results.txt")
