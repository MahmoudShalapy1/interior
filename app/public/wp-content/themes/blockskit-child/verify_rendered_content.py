import urllib.request
import urllib.error
import re
import json
from html.parser import HTMLParser

with open('en_dictionary.json', 'r', encoding='utf-8') as f:
    en_dict = json.load(f)

pages = [
    ('/', 'Home'),
    ('/about', 'About'),
    ('/services', 'Services'),
    ('/approach', 'Approach'),
    ('/projects', 'Projects'),
    ('/contact', 'Contact'),
    ('/non-existent-404', '404')
]

arabic_char_re = re.compile(r'[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]')
english_word_re = re.compile(r'\b[A-Za-z]{2,}\b')

# Exceptions for technical IDs, vendor credits, or HTML artifacts if any
ALLOWED_EN_WORDS_IN_AR = {
    # e.g., if any system strings are allowed, but our rule is 0
}

class VisibleTextExtractor(HTMLParser):
    def __init__(self):
        super().__init__()
        self.in_script = False
        self.in_style = False
        self.texts = []

    def handle_starttag(self, tag, attrs):
        if tag in ('script', 'style', 'svg'):
            # for svg, we only ignore non-text
            if tag in ('script', 'style'):
                self.in_script = True

    def handle_endtag(self, tag):
        if tag in ('script', 'style'):
            self.in_script = False

    def handle_data(self, data):
        if not self.in_script and not self.in_style:
            clean = data.strip()
            if clean:
                self.texts.append(clean)

log_lines = []
log_lines.append("=" * 60)
log_lines.append("AUDITING ALL RENDERED PAGES FOR ZERO-LEAK BILINGUAL PURITY")
log_lines.append("=" * 60)

for path, name in pages:
    url = f"http://interior.local{path}"
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req) as resp:
            html = resp.read().decode('utf-8', errors='ignore')
    except urllib.error.HTTPError as e:
        html = e.read().decode('utf-8', errors='ignore')

    # 1. Audit Default Arabic Page
    parser = VisibleTextExtractor()
    parser.feed(html)
    
    english_findings = []
    for t in parser.texts:
        t_clean = re.sub(r'&[a-zA-Z]+;', ' ', t)
        words = english_word_re.findall(t_clean)
        for w in words:
            if w.upper() not in ALLOWED_EN_WORDS_IN_AR and w.lower() not in ('svg', 'xml', 'xmlns'):
                english_findings.append((w, t))

    # 2. Audit English Translated Simulation
    def replacer(match):
        k = match.group(1)
        if k in en_dict:
            return f'data-i18n="{k}">{en_dict[k]}<'
        return match.group(0)

    simulated_en_html = re.sub(r'data-i18n="([^"]+)"[^>]*>([^<]*)<', replacer, html)
    parser_en = VisibleTextExtractor()
    parser_en.feed(simulated_en_html)

    arabic_findings = []
    for t in parser_en.texts:
        if arabic_char_re.search(t):
            arabic_findings.append(t)

    log_lines.append(f"\n--- Page: {name} ({path}) ---")
    log_lines.append(f"  [AR Mode] English words detected: {len(english_findings)}")
    if english_findings:
        for w, text in english_findings[:10]:
            log_lines.append(f"    ! English word: '{w}' in snippet: '{text[:80]}'")
            
    log_lines.append(f"  [EN Mode] Arabic text fragments remaining: {len(arabic_findings)}")
    if arabic_findings:
        for t in arabic_findings[:10]:
            log_lines.append(f"    ! Arabic text: '{t[:80]}'")

log_lines.append("\n" + "=" * 60)
log_lines.append("AUDIT COMPLETED")
log_lines.append("=" * 60)

with open('audit_log.txt', 'w', encoding='utf-8') as out:
    out.write('\n'.join(log_lines))

print("Audit written to audit_log.txt")
