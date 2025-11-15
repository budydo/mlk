from PIL import Image, ImageDraw, ImageFont
import os

# Create directory if not exists
os.makedirs('public/images/services', exist_ok=True)

services = [
    {'slug': 'ukl-upl', 'title': 'UKL-UPL', 'color': (34, 197, 94)},
    {'slug': 'amdal-kajian-dampak', 'title': 'AMDAL', 'color': (59, 130, 246)},
    {'slug': 'pemberdayaan-komunitas', 'title': 'Pemberdayaan', 'color': (139, 92, 246)},
    {'slug': 'restorasi-lahan', 'title': 'Restorasi', 'color': (16, 185, 129)},
    {'slug': 'transportasi-manajemen-lalu-lintas', 'title': 'Transportasi', 'color': (245, 158, 11)},
    {'slug': 'lingkungan-hidup-berkelanjutan', 'title': 'Lingkungan', 'color': (6, 182, 212)},
    {'slug': 'konsultasi-lingkungan', 'title': 'Konsultasi', 'color': (236, 72, 153)},
    {'slug': 'pemantauan-dampak', 'title': 'Pemantauan', 'color': (20, 184, 166)},
    {'slug': 'riset-dan-pengembangan', 'title': 'Riset', 'color': (99, 102, 241)},
    {'slug': 'pelatihan-kapasitas', 'title': 'Pelatihan', 'color': (249, 115, 22)},
]

for service in services:
    # Create image
    img = Image.new('RGB', (800, 500), service['color'])
    draw = ImageDraw.Draw(img)
    
    # Try to use a nice font, fall back to default if not available
    try:
        font = ImageFont.truetype("arial.ttf", 80)
    except:
        font = ImageFont.load_default()
    
    # Get text bounding box and center it
    text = service['title']
    bbox = draw.textbbox((0, 0), text, font=font)
    text_width = bbox[2] - bbox[0]
    text_height = bbox[3] - bbox[1]
    
    x = (800 - text_width) // 2
    y = (500 - text_height) // 2
    
    # Draw text in white
    draw.text((x, y), text, fill=(255, 255, 255), font=font)
    
    # Save image
    filepath = f'public/images/services/{service["slug"]}.jpg'
    img.save(filepath, 'JPEG', quality=90)
    print(f'Generated: {filepath}')

print('All images generated successfully!')
