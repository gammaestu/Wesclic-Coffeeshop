<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Seeder untuk menyalin gambar menu dari folder "Input Png & Jpg" ke public/images/logos/
 * Design Pattern: Single Responsibility - hanya menangani copy file gambar
 */
class MenuImageSeeder extends Seeder
{
    /**
     * Mapping nama file gambar ke nama menu
     * Format: 'nama_file.jpeg' => 'Nama Menu'
     */
    private const IMAGE_MAPPING = [
        'almondcros.jpeg' => 'Almond Croissant',
        'americano.jpeg' => 'Americano',
        'applepie.jpeg' => 'Apple Pie',
        'blacktea.jpeg' => 'Black Tea',
        'bluberry.jpeg' => 'Blueberry Muffin',
        'cappuccino.jpeg' => 'Cappuccino',
        'chailatte.jpeg' => 'Chai Latte',
        'chesecake.jpeg' => 'Cheesecake',
        'chococake.jpeg' => 'Chocolate Cake',
        'chococookie.jpeg' => 'Chocolate Chip Cookie',
        'cinnamon.jpeg' => 'Cinnamon Roll',
        'coldbrew.jpeg' => 'Cold Brew',
        'croisant.jpeg' => 'Croissant',
        'earlgrey.jpeg' => 'Earl Grey',
        'espresso.jpeg' => 'Espresso',
        'flatwhite.jpeg' => 'Flat White',
        'greentea.jpeg' => 'Green Tea',
        'herbal tea.jpeg' => 'Herbal Tea',
        'latte.jpeg' => 'Latte',
        'macchiato.jpeg' => 'Macchiato',
        'mocha.jpeg' => 'Mocha',
        'tiramisu.jpeg' => 'Tiramisu',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceDir = base_path('Input Png & Jpg');
        $targetDir = public_path('images/logos');

        // Buat direktori target jika belum ada
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $copied = 0;
        $skipped = 0;
        $errors = [];

        foreach (self::IMAGE_MAPPING as $sourceFile => $menuName) {
            $sourcePath = $sourceDir . DIRECTORY_SEPARATOR . $sourceFile;
            $targetFileName = 'menu-' . strtolower(str_replace(' ', '-', $menuName)) . '.jpeg';
            $targetPath = $targetDir . DIRECTORY_SEPARATOR . $targetFileName;

            // Cek apakah file sumber ada
            if (!File::exists($sourcePath)) {
                $errors[] = "File tidak ditemukan: {$sourceFile}";
                continue;
            }

            // Skip jika file target sudah ada
            if (File::exists($targetPath)) {
                $skipped++;
                continue;
            }

            // Copy file
            try {
                File::copy($sourcePath, $targetPath);
                $copied++;
                $this->command->info("✓ Copied: {$sourceFile} → {$targetFileName}");
            } catch (\Exception $e) {
                $errors[] = "Error copying {$sourceFile}: " . $e->getMessage();
            }
        }

        // Tampilkan summary
        $this->command->info("\n=== Menu Image Seeder Summary ===");
        $this->command->info("Copied: {$copied} files");
        $this->command->info("Skipped (already exists): {$skipped} files");

        if (!empty($errors)) {
            $this->command->warn("\nErrors:");
            foreach ($errors as $error) {
                $this->command->warn("  - {$error}");
            }
        }
    }
}
