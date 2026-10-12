import json

with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

# Let's inspect sections 1-5
files = [
    'parts\\header.html',
    'template-parts\\header-luxury.php',
    'patterns\\hero-reveal.php',
    'patterns\\statement-manifesto.php',
    'patterns\\line-to-living.php',
    'patterns\\stats-scale.php',
    'patterns\\confidential-vault.php'
]

for target in files:
    print(f"=== {target} ===")
    for k, v in data.items():
        if target in v['file']:
            print(f"  '{k}': '{v['ar']}',")
