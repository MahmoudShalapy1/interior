import json
import re

with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    ar_data = json.load(f)

english_pattern = re.compile(r'[a-zA-Z]')
ar_with_english = {}

for k, v in ar_data.items():
    text = v.get('ar', '')
    if english_pattern.search(text):
        ar_with_english[k] = {
            'text': text,
            'file': v.get('file')
        }

with open('ar_english_issues.json', 'w', encoding='utf-8') as f:
    json.dump(ar_with_english, f, ensure_ascii=False, indent=2)

print(f"Found {len(ar_with_english)} AR keys with English letters.")
