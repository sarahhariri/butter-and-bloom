<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\Faq;
use App\Models\Flavour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $flavours = [];

        foreach ([
            'Chocolate',
            'Strawberry',
            'Pistachio',
            'Lemon',
            'Vanilla',
        ] as $index => $name) {
            $flavours[$name] = Flavour::firstOrCreate(
                ['name' => $name],
                [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $cakes = [
            [
                'name' => 'Chocolate Bliss',
                'tagline' => 'Rich & Chocolatey',
                'description' => 'A rich chocolate cake with smooth chocolate buttercream and a glossy chocolate drip.',
                'file' => 'chocolate-cake.png',
                'flavour' => 'Chocolate',
            ],
            [
                'name' => 'Strawberry Bloom',
                'tagline' => 'Fresh & Fruity',
                'description' => 'A lovely strawberry cake with soft pink piping and fresh berries, made for your sweetest celebrations.',
                'file' => 'strawberry-cake.png',
                'flavour' => 'Strawberry',
            ],
            [
                'name' => 'Pistachio Delight',
                'tagline' => 'Nutty & Delicate',
                'description' => 'A delicate pistachio cake with silky buttercream and a generous sprinkle of pistachios.',
                'file' => 'pistachio-cake.png',
                'flavour' => 'Pistachio',
            ],
            [
                'name' => 'Lemon Sunshine',
                'tagline' => 'Bright & Zesty',
                'description' => 'A soft lemon cake with silky buttercream and a fresh citrus finish, made to brighten your celebration.',
                'file' => 'lemon-cake.png',
                'flavour' => 'Lemon',
            ],
            [
                'name' => 'Sweetheart',
                'tagline' => 'Made with Love',
                'description' => 'A charming heart-shaped cake with delicate piping, made for someone special.',
                'file' => 'heart-cake.png',
                'flavour' => 'Vanilla',
            ],
            [
                'name' => 'Bloom Celebration',
                'tagline' => 'For Special Moments',
                'description' => "An elegant two-tier cake with delicate floral touches, made for life's special celebrations.",
                'file' => 'celebration-cake.png',
                'flavour' => 'Vanilla',
            ],
        ];

        foreach ($cakes as $index => $cake) {
            if (Cake::where('name', $cake['name'])->exists()) {
                continue;
            }

            $source = public_path('assets/images/' . $cake['file']);
            $destination = 'cakes/demo/' . $cake['file'];

            if (!is_file($source)) {
                throw new \RuntimeException(
                    'Missing demo image: ' . $cake['file']
                );
            }

            $stored = Storage::disk('public')->put(
                $destination,
                file_get_contents($source)
            );

            if (!$stored) {
                throw new \RuntimeException(
                    'Could not copy demo image: ' . $cake['file']
                );
            }

            Cake::create([
                'name' => $cake['name'],
                'tagline' => $cake['tagline'],
                'description' => $cake['description'],
                'image' => $destination,
                'flavour_id' => $flavours[$cake['flavour']]->id,
                'sort_order' => $index + 1,
                'is_active' => true,
                'is_featured' => $index < 3,
            ]);
        }

        $faqs = [
            [
                'question' => 'How is my custom cake priced?',
                'answer' => 'The final price depends on the size, flavour and design. We review your request and agree on the price with you before confirming your order.',
            ],
            [
                'question' => 'Can I share a cake inspiration photo?',
                'answer' => 'Yes! Upload an inspiration photo with your request. We’ll review the design and discuss what we can create for your celebration.',
            ],
            [
                'question' => 'Do you offer delivery?',
                'answer' => 'We currently offer pickup only. We’ll arrange the pickup details with you when confirming your order.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                [
                    'answer' => $faq['answer'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
