import json
import re

with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    ar_data = json.load(f)

found = {}
for k, v in ar_data.items():
    t = v.get('ar', '')
    t = t.replace('&bull;', '•').replace('&copy;', '©')
    m = re.findall(r'[a-zA-Z]+', t)
    if m:
        found[k] = (m, t, v.get('file'))

with open('remaining_en_in_ar.json', 'w', encoding='utf-8') as f:
    json.dump(found, f, ensure_ascii=False, indent=2)

print(f"Found {len(found)} keys with English words in AR.")
for k, (m, t, fn) in found.items():
    print(f"{k} ({fn}): {m}")
