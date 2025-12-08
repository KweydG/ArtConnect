<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Database\Seeder;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $categories = Category::all();

        $tutorials = [
            [
                'title' => 'Getting Started with Watercolors',
                'description' => 'Learn the basics of watercolor painting, from choosing supplies to basic techniques.',
                'content' => "# Introduction to Watercolors\n\nWatercolor painting is a beautiful and expressive medium that has been used by artists for centuries.\n\n## Materials Needed\n- Watercolor paints\n- Watercolor paper\n- Brushes (round and flat)\n- Palette\n- Water containers\n\n## Basic Techniques\n\n### Wet on Wet\nApply wet paint to wet paper for soft, diffused edges.\n\n### Wet on Dry\nApply wet paint to dry paper for more control and defined edges.\n\n### Layering\nBuild up colors gradually by layering transparent washes.",
                'duration' => 15,
                'difficulty' => 'beginner',
            ],
            [
                'title' => 'Digital Art for Beginners',
                'description' => 'Start your digital art journey with essential tips and software recommendations.',
                'content' => "# Digital Art Basics\n\nDigital art opens up endless possibilities for creative expression.\n\n## Recommended Software\n- Adobe Photoshop\n- Procreate\n- Clip Studio Paint\n- Krita (free)\n\n## Essential Tools\n\n### Drawing Tablet\nA pressure-sensitive tablet is essential for natural brush strokes.\n\n### Layers\nLearn to use layers effectively to organize your work.\n\n### Brushes\nExperiment with different brush settings to find your style.",
                'duration' => 20,
                'difficulty' => 'beginner',
            ],
            [
                'title' => 'Mastering Portrait Drawing',
                'description' => 'Learn the fundamentals of drawing realistic portraits.',
                'content' => "# Portrait Drawing Fundamentals\n\nDrawing portraits is one of the most rewarding skills an artist can develop.\n\n## Face Proportions\n- Eyes are at the midpoint of the head\n- Nose is halfway between eyes and chin\n- Mouth is one-third down from nose to chin\n\n## Key Features\n\n### Eyes\nThe eyes are the window to the soul. Focus on getting them right.\n\n### Nose\nStudy the planes and shadows of the nose.\n\n### Lips\nPay attention to the subtle variations in tone.",
                'duration' => 30,
                'difficulty' => 'intermediate',
            ],
            [
                'title' => 'Advanced Color Theory',
                'description' => 'Deep dive into color harmonies and their application in art.',
                'content' => "# Advanced Color Theory\n\nUnderstanding color is crucial for creating impactful artwork.\n\n## Color Harmonies\n- Complementary colors\n- Analogous colors\n- Triadic colors\n- Split-complementary\n\n## Color Temperature\nWarm and cool colors create depth and mood.\n\n## Color Psychology\nColors evoke emotions and can set the tone of your artwork.",
                'duration' => 25,
                'difficulty' => 'advanced',
            ],
            [
                'title' => 'Photography Composition Tips',
                'description' => 'Master the art of composition to take stunning photographs.',
                'content' => "# Photography Composition\n\nGreat photography is about seeing and composing.\n\n## Rule of Thirds\nDivide your frame into a 3x3 grid and place subjects on the intersections.\n\n## Leading Lines\nUse natural lines to guide the viewer's eye through the image.\n\n## Framing\nUse elements in the scene to frame your subject.\n\n## Negative Space\nDon't be afraid of empty space - it can be powerful.",
                'duration' => 15,
                'difficulty' => 'beginner',
            ],
        ];

        foreach ($tutorials as $tutorialData) {
            Tutorial::create([
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'title' => $tutorialData['title'],
                'description' => $tutorialData['description'],
                'content' => $tutorialData['content'],
                'image' => null,
                'duration' => $tutorialData['duration'],
                'difficulty' => $tutorialData['difficulty'],
                'views' => rand(50, 2000),
            ]);
        }
    }
}
