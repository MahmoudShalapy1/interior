import json
import re

# Load all extracted keys
with open('extracted_keys.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

print(f"Loaded {len(data)} keys.")
