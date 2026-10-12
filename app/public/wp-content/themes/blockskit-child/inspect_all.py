import json

with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

# Sort by file and key
by_file = {}
for k, v in data.items():
    fn = v['file']
    if fn not in by_file:
        by_file[fn] = []
    by_file[fn].append((k, v['ar'], v.get('raw', '')))

with open('keys_by_file.txt', 'w', encoding='utf-8') as out:
    for fn, items in sorted(by_file.items()):
        out.write(f"\n======================================================\nFILE: {fn} ({len(items)} keys)\n======================================================\n")
        for k, ar, raw in sorted(items):
            out.write(f"'{k}': r'''{ar}''',\n")

print("Written to keys_by_file.txt")
