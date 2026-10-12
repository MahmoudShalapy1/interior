import os
import re
import json

theme_dir = r"c:\Users\HP\Local Sites\interior\app\public\wp-content\themes\blockskit-child"
keys = {}

for root, dirs, files in os.walk(theme_dir):
    if ".git" in root or "vendor" in root:
        continue
    for f in files:
        if f.endswith((".php", ".html")):
            path = os.path.join(root, f)
            with open(path, "r", encoding="utf-8", errors="ignore") as fp:
                content = fp.read()
                # Find all data-i18n attributes
                # Note: tag can be multiline or have child tags
                # Let's extract tag content accurately
                for m in re.finditer(r'<([a-zA-Z0-9\-]+)[^>]*?data-i18n="([^"]+)"[^>]*>(.*?)</\1>', content, re.DOTALL):
                    tag = m.group(1)
                    k = m.group(2)
                    inner_html = m.group(3).strip()
                    # Strip tags if needed, or keep text
                    clean_text = re.sub(r'<[^>]+>', ' ', inner_html).strip()
                    clean_text = ' '.join(clean_text.split())
                    if k not in keys:
                        keys[k] = {
                            "ar": clean_text,
                            "raw": inner_html,
                            "file": os.path.relpath(path, theme_dir)
                        }

                # Also find data-i18n-placeholder
                for m in re.finditer(r'data-i18n-placeholder="([^"]+)"[^>]*?placeholder="([^"]*)"', content):
                    k = m.group(1)
                    val = m.group(2).strip()
                    if k not in keys:
                        keys[k] = {
                            "ar": val,
                            "raw": val,
                            "file": os.path.relpath(path, theme_dir),
                            "attr": "placeholder"
                        }

                # Also find self-closing or simple data-i18n
                for m in re.finditer(r'data-i18n="([^"]+)"', content):
                    k = m.group(1)
                    if k not in keys:
                        keys[k] = {
                            "ar": "",
                            "raw": "",
                            "file": os.path.relpath(path, theme_dir)
                        }

output_path = os.path.join(theme_dir, "extracted_keys.json")
with open(output_path, "w", encoding="utf-8") as out:
    json.dump(keys, out, ensure_ascii=False, indent=2)

print(f"Extracted {len(keys)} keys into {output_path}")
